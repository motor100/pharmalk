<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $orders = Order::orderBy('id', 'desc')
                        ->limit(200)
                        ->get();

        // Paginator with limit
        $orders = (new \App\Services\Paginator($orders, 50))->custom_paginator();

        return view('dashboard.orders', compact('orders'));
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
    public function show(string $id): View
    {
        $order = Order::findOrFail($id);

        // Получение товаров для заказа
        $order_products = OrderProduct::where('order_id', $order->id)->get();

        $products = [];

        // Медленный способ
        // Количество запросов к БД = количество товаров
        foreach($order_products as $product) {
            $item = Product::where('product_id', $product->product_id)->first();
            $item['quantity'] = $product->quantity;
            $products[] = $item;
        }

        // Телефон из числа в строку
        $order->phone = (new \App\Services\Phone())->int_to_phone($order->phone);

        return view('dashboard.order-show', compact('order', 'products'));
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
            'status' => 'required',
            'comment' => 'nullable'
        ]);

        Order::where('id', $id)
                ->update([
                    'status' => $validated['status'],
                    'comment' => $validated['comment'],
                ]);

        return redirect('/admin/orders');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
