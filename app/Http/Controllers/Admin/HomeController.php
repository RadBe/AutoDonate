<?php

namespace App\Http\Controllers\Admin;

use App\Handlers\Admin\HomeHandler;
use App\NavMenu;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function render(HomeHandler $handler)
    {
        NavMenu::$active = 'admin.home';

        return view('admin.home', [
            'products' => $handler->getProducts()
        ]);
    }

    public function clearCache(HomeHandler $handler)
    {
        $handler->clearCache();

        return redirect()->back()->with('success_message', 'Кэш был успешно очищен');
    }
}
