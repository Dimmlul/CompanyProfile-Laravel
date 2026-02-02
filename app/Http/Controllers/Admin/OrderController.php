<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        abort_if(!Auth::user()?->isAdmin(), 403);

        $orders = Order::latest()->paginate(20);

        return view('pages.admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        abort_if(!Auth::user()?->isAdmin(), 403);

        return view('pages.admin.orders.show', compact('order'));
    }
}
