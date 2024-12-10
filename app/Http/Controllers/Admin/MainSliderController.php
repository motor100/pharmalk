<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MainSlider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MainSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // LIFO
        $sliders = MainSlider::orderby('id', 'desc')->get();

        return view('dashboard.main-slider', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('dashboard.main-slider-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|min:4|max:255',
            'link' => 'required|min:4|max:255',
            'input-main-file' => [
                                'required',
                                \Illuminate\Validation\Rules\File::types(['jpg', 'png'])
                                                                    ->min(50)
                                                                    ->max(5 * 1024)
            ]
        ]);

        $path = Storage::putFile('public/uploads/slider', $validated["input-main-file"]);

        // Позиция вхождения подстроки
        $start = strripos($validated["link"], "/catalog");

        MainSlider::create([
            'title' => $validated["title"],
            'image' => $path,
            'link' => mb_substr($validated["link"], $start)
        ]);

        return redirect('/admin/main-slider');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $slide = MainSlider::findOrFail($id);

        return view('dashboard.main-slider-show', compact('slide'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $slide = MainSlider::findOrFail($id);

        return view('dashboard.main-slider-edit', compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id' => 'required|numeric',
            'title' => 'required|min:4|max:255',
            'link' => 'required|min:4|max:255',
            'input-main-file' => [
                                'nullable',
                                \Illuminate\Validation\Rules\File::types(['jpg', 'png'])
                                                                    ->min(50)
                                                                    ->max(5 * 1024)
            ],
        ]);

        $slide = MainSlider::findOrFail($validated["id"]);

        if ($request->has('input-main-file')) {
            if (Storage::exists($slide->image)) {
                Storage::delete($slide->image);
            }

            $path = Storage::putFile('public/uploads/slider', $validated["input-main-file"]);
        } else {
            $path = $slide->image;
        }

        // Позиция вхождения подстроки
        $start = strripos($validated["link"], "/catalog");

        $slide->update([
            'title' => $validated["title"],
            'image' => $path,
            'link' => mb_substr($validated["link"], $start)
        ]);

        return redirect('/admin/main-slider');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $slide = MainSlider::find($id);

        // Удаление файла
        if (Storage::exists($slide->image)) {
            Storage::delete($slide->image);
        }

        $slide->delete();

        return redirect('/admin/main-slider');
    }
}
