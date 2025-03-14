<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    /**
     * Личный кабинет главная страница
     * 
     * @return Illuminate\View\View
     */
    public function home(): View
    {
        return view('home');
    }

    /**
     * История заказов
     * 
     * @return Illuminate\View\View
     */   
    public function orders(): View
    {
        return view('orders');
    }

    /**
     * Уведомления
     * 
     * @return Illuminate\View\View
     */   
    public function notifications(): View
    {
        return view('notifications');
    }

    /**
     * База знаний
     * 
     * @return Illuminate\View\View
     */   
    public function knowledge_base(): View
    {
        return view('knowledge-base');
    }

    /**
     * Поддержка
     * 
     * @return Illuminate\View\View
     */   
    public function support(): View
    {
        return view('support');
    }
}
