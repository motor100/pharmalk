<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return Illuminate\View\View
     */
    public function index(): View
    {
        $table_posts = config("wp.wp_table_prefix") . "posts";

        $user = Auth::user();

        $user_id = $user->id + 10000;
        
        $coupon = DB::connection("mysql2")
                    ->table($table_posts)
                    ->where("post_author", $user_id)
                    ->select(["ID", "post_title", "post_excerpt"])
                    ->first();

        // Если есть купон, то получаю его meta
        if ($coupon) {
            $table_postmeta = config("wp.wp_table_prefix") . "postmeta";

            $coupon_metas = DB::connection("mysql2")
                            ->table($table_postmeta)
                            ->where("post_id", $coupon->ID)
                            ->select(["meta_key", "meta_value"])
                            ->get();

            foreach($coupon_metas as $meta) {
                $key = $meta->meta_key;
                $coupon->$key = $meta->meta_value;
            }
        }
        
        return view("coupon", compact("coupon"));
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return Illuminate\View\View
     */
    public function create(): View
    {
        $table_posts = config("wp.wp_table_prefix") . "posts";

        $user = Auth::user();

        $user_id = $user->id + 10000;
        
        $coupon = DB::connection("mysql2")
                    ->table($table_posts)
                    ->where("post_author", $user_id)
                    ->select(["ID", "post_title", "post_excerpt"])
                    ->first();
        
        return view("coupon-create", compact("coupon"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            "description" => "nullable|min:3|max:65535",
            "amount" => "required|integer|min:1|max:100",
            "stop_date" => "nullable",
        ]);

        $user = Auth::user();

        $user_id = $user->id + 10000;

        $table_posts = config("wp.wp_table_prefix") . "posts";
        $table_postmeta = config("wp.wp_table_prefix") . "postmeta";

        // Проверка, если уже есть купон, то удаляю его и его meta описание
        $coupon = DB::connection("mysql2")
                    ->table($table_posts)
                    ->where("post_author", $user_id)
                    ->select(["ID", "post_title", "post_excerpt"])
                    ->first();
        
        if ($coupon) {
            // Удаление meta описания таблица postmeta
            DB::connection("mysql2")
                ->table($table_postmeta)
                ->where("post_id", $coupon->ID)
                ->delete();

            // Удаление купона таблица posts
            DB::connection("mysql2")
                ->table($table_posts)
                ->where("post_author", $user_id)
                ->delete();
        }

        // Вставка во внешнюю БД таблица posts
        $title = "k" . $user->id . "_" . date("Hi") . Str::random(3);

        $coupon_array = [
            "post_author" => $user_id,
            "post_date" => now(),
            "post_date_gmt" => now(),
            "post_content" => "",
            "post_title" => $title,
            "post_excerpt" => $validated["description"],
            "post_status" => "publish",
            "comment_status" => "closed",
            "ping_status" => "closed",
            "post_password" => "",
            "post_name" => $title,
            "to_ping" => "",
            "pinged" => "",
            "post_modified" => now(),
            "post_modified_gmt" => now(),
            "post_content_filtered" => "",
            "post_parent" => 0,
            "guid" => "",
            "menu_order" => 0,
            "post_type" => "shop_coupon",
            "post_mime_type" => "",
            "comment_count" => 0
        ];

        $post_id = DB::connection("mysql2")
                    ->table($table_posts)
                    ->insertGetId($coupon_array);

        // Вставка во внешнюю БД таблица postmeta
        $table_postmeta = config("wp.wp_table_prefix") . "postmeta";

        // Срок действия купона. Если его нет, то 31.12 текущего года
        if ($validated["stop_date"]) {
            $date = Carbon::createFromFormat('d.m.Y', $validated["stop_date"])->format('Y-m-d');
        } else {
            $current_year = date('Y');
            $date = $current_year . "-12-31";
        }

        $meta_array = [
            [
                "post_id" => $post_id,
                "meta_key" => "discount_type",
                "meta_value" => "percent"
            ],
            [
                "post_id" => $post_id,
                "meta_key" => "coupon_amount",
                "meta_value" => $validated["amount"],
            ],
            [
                "post_id" => $post_id,
                "meta_key" => "usage_limit",
                "meta_value" => "0"
            ],
            [
                "post_id" => $post_id,
                "meta_key" => "expiry_date",
                "meta_value" => $date,
            ],
            [
                "post_id" => $post_id,
                "meta_key" => "apply_before_tax",
                "meta_value" => "yes"
            ],
            [
                "post_id" => $post_id,
                "meta_key" => "exclude_sale_items",
                "meta_value" => "no"
            ],
            [
                "post_id" => $post_id,
                "meta_key" => "customer_email",
                "meta_value" => NULL
            ],
        ];

        DB::connection("mysql2")
            ->table($table_postmeta)
            ->insert($meta_array);
        
        return redirect()->route("coupon");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
