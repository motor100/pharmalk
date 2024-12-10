<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $testimonials = \App\Models\Testimonial::whereNull('publicated_at')
                                                ->orderBy('created_at', 'desc')
                                                ->get();

        return view('dashboard.testimonials', compact('testimonials'));
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|min:3|max:50',
            'text' => 'required|min:3|max:500',
        ]);

        $testimonial = \App\Models\Testimonial::findOrFail($id);

        $testimonial->update([
                        'name' => $validated["name"],
                        'email' => $validated["email"],
                        'text' => $validated["text"],
                        'publicated_at' => now(),
                    ]);

        return redirect('/admin/testimonials');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $testimonial = \App\Models\Testimonial::findOrFail($id);

        $testimonial->delete();

        return redirect('/admin/testimonials');
    }
}
