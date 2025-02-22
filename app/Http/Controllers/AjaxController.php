<?php

namespace App\Http\Controllers;

// use Illuminate\View\View;
use \Illuminate\Support\Facades\Cookie;

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

}
