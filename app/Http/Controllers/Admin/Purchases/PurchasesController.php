<?php

namespace App\Http\Controllers\Admin\Purchases;


use App\NavMenu;
use App\Http\Controllers\Controller;

class PurchasesController extends Controller
{
    public function render()
    {
        NavMenu::$active = 'admin.purchases';

        return view('admin.purchases.purchases');
    }
}
