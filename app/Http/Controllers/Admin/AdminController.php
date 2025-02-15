<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function home(): View
    {
        // dd(\Illuminate\Support\Facades\Auth::user());
        
        // return view('dashboard.home'); // это админ панель
        return view('home');
    }
}
