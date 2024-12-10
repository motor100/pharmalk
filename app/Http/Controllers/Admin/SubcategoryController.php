<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Category;
use App\Models\SubcategoryImage;
use Illuminate\Http\RedirectResponse;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $search_query = $request->input('search_query');

        $subcategories = collect();

        if($search_query) {
            $search_query = htmlspecialchars($search_query);
            $subcategories = Category::where('title', 'like', "%{$search_query}%")
                                        ->whereNotNull('parent_id') // только подкатегории 
                                        ->whereNotNull('parent_uuid') // только подкатегории 
                                        ->with('ancestors') // вместе с родительскими категориями
                                        ->paginate(20);
        } else {
            $subcategories = Category::whereNotNull('parent_id') // только подкатегории 
                                        ->whereNotNull('parent_uuid') // только подкатегории 
                                        ->with('ancestors') // вместе с родительскими категориями
                                        ->paginate(20);
        }

        return view('dashboard.subcategories', compact('subcategories'));
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
        $subcategory = Category::findOrFail($id);

        return view('dashboard.subcategories-edit', compact('subcategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|min:2|max:250',
            'input-main-file' => [
                                'nullable',
                                \Illuminate\Validation\Rules\File::types(['jpg', 'png'])
                                                                    ->min(5)
                                                                    ->max(100)
                                ],
        ]);

        $subcategory = Category::findOrFail($id);

        // Обновление-вставка изображения
        SubcategoryImage::upsert(
            [
                'image' => (new \App\Services\SubcategoryImage($subcategory, $validated))->image(),
                'category_id' => $subcategory->category_id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            ['category_id'],
            [
                'image',
                'updated_at'
            ]
        );

        return redirect('/admin/subcategories');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
