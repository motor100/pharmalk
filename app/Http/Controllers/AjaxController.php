<?php

namespace App\Http\Controllers;

// use Illuminate\View\View;
use \Illuminate\Support\Facades\Cookie;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    /**
     * Добавление куки aside_nav
     * 
     * @return bool
     */
    public function aside_nav_set_active(): bool
    {
        // Записываю в куки через фасад Cookie метод queue
        Cookie::queue('aside_nav', 'active', 525600);

        return false;
    }

    /**
     * Удаление куки aside_nav
     * 
     * @return bool
     */
    public function aside_nav_remove_active(): bool
    {
        // Записываю в куки через фасад Cookie метод queue
        Cookie::queue(Cookie::forget('aside_nav'));

        return false;
    }

    /**
     * Расчет суммы всех заказов у которых был применен купон
     * 
     */
    // public function orders_summ_calc(Request $request): JsonResponse
    public function orders_summ_calc(Request $request)
    {
        $coupon = $request->input('coupon');

        if (!$coupon) {
            return response()->json(['error' => 'no coupon']);
        }

        $coupon = htmlspecialchars($coupon);

        $table_woocommerce_order_items = config("wp.wp_table_prefix") . "woocommerce_order_items";
        $table_wc_orders = config("wp.wp_table_prefix") . "wc_orders";

        $order_items = DB::connection("mysql2")
                        ->table($table_woocommerce_order_items)
                        ->where("order_item_name", $coupon)
                        ->where("order_item_type", "coupon")
                        // ->select("order_id")
                        // ->get();
                        ->pluck("order_id");

        $orders = DB::connection("mysql2")
                    ->table($table_wc_orders)
                    ->whereIn('id', $order_items)
                    ->pluck("total_amount");

        $summ = 0;

        foreach($orders as $order) {
            $summ += $order;
        }

        $summ = number_format($summ, 0, '.', ' ');

        return response($summ, 200)
                ->header('Content-Type', 'text/plain');
    }

}
