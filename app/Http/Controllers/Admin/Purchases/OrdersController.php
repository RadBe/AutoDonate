<?php

namespace App\Http\Controllers\Admin\Purchases;

use App\Handlers\Admin\Purchases\OrdersHandler;
use App\NavMenu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function render(Request $request, OrdersHandler $handler, ?string $player = null)
    {
        NavMenu::$active = 'admin.purchases';

        $page = $request->get('page', 1);
        if($page < 1) {
            $page = 1;
        }

        $payments = $handler->handle($page, $player);

        if($payments->lastPage() < $page) {
            return redirect()->route('admin.purchases.orders', ['player' => $player]);
        }

        return view('admin.purchases.orders', [
            'payments' => $payments
        ]);
    }
}
