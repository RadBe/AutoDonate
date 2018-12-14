<?php

namespace App\Http\Controllers\Index;

use App\Handlers\Index\HomeHandler;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function render(HomeHandler $handler)
    {
        return view('index.home', [
            'products' => $handler->getProducts()
        ]);
    }
}
