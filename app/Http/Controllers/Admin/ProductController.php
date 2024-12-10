<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\ProductContent;
use App\Models\ProductDocument;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $search_query = $request->input('search_query');

        $products = collect();

        if($search_query) {
            $search_query = htmlspecialchars($search_query);
            $products = Product::where('title', 'like', "%{$search_query}%")
                                ->where('category_id', '<>', '00000000-0000-0000-0000-000000000000')
                                ->paginate(50)
                                ->withQueryString()
                                ->onEachSide(1);
        } else {
            $products = Product::orderBy('id', 'desc')
                                ->where('category_id', '<>', '00000000-0000-0000-0000-000000000000')
                                ->paginate(50)
                                ->onEachSide(1);
        }

        return view('dashboard.products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id): View
    {
        $product = Product::findOrFail($id);

        return view('dashboard.products-edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|min:2|max:250',
            'text' => 'nullable|min:2|max:65000',
            'save-data' => 'nullable|min:2|max:65000',
            'input-main-file' => [
                                'nullable',
                                \Illuminate\Validation\Rules\File::types(['jpg', 'png'])
                                                                    ->min(10)
                                                                    ->max(308)
                                ],
            'input-gallery-file' => 'nullable|max:4',
            'input-gallery-file.*' => [
                                    \Illuminate\Validation\Rules\File::types(['jpg', 'png'])
                                                                        ->min(10)
                                                                        ->max(308)
                                    ],
            'input-pdf-file' => [
                                'nullable',
                                \Illuminate\Validation\Rules\File::types(['pdf'])
                                                                    ->min(10)
                                                                    ->max(3 * 1024)
                                ],
            'hit' => 'nullable',
            'special_offer' => 'nullable',
            'delete-gallery' => 'nullable|numeric',
        ]);

        $product = Product::findOrFail($id);

        // Если есть $validated['save-data'] то преобразование в html, иначе $validated['text']
        $html = isset($validated['save-data']) ? (new \App\Services\JsonToHtml($validated['save-data']))->render() : $validated['text'];

        // Обновление-вставка отметки хит, отметки специальное предложение и изображения
        ProductContent::upsert(
            [
                'product_id' => $product->product_id,
                'image' => (new \App\Services\ProductContent($product, $validated))->image(),
                'text_json' => isset($validated['save-data']) ? $validated['save-data'] : NULL,
                'text_html' => $html,
                'hit' => (new \App\Services\ProductContent($product, $validated))->hit(),
                'special_offer' => (new \App\Services\ProductContent($product, $validated))->special_offer(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            ['product_id'],
            [
                'image',
                'text_json',
                'text_html',
                'hit',
                'special_offer',
                'updated_at'
            ]
        );

        // Обновление галереи
        if (array_key_exists('input-gallery-file', $validated)) {
            $gallery_array = (new \App\Services\ProductGallery($product, $validated))->gallery_update();

            ProductGallery::insert($gallery_array);
        }

        // Удаление галереи
        if ($validated['delete-gallery']) {
            (new \App\Services\ProductGallery($product, $validated))->gallery_destroy();
        }

        // Обновление документа pdf
        if (array_key_exists('input-pdf-file', $validated)) {

            ProductDocument::upsert(
                [
                    'product_id' => $product->product_id,
                    'file' => (new \App\Services\ProductDocument($product, $validated))->file_update(),
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                ['product_id'],
                [
                    'file',
                    'updated_at'
                ]
            );
        }

        return redirect('/admin/products');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
