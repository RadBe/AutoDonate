<?php

namespace App\Http\Controllers\Admin\Products;

use App\Exceptions\Product\ProductNotFoundException;
use App\Handlers\Admin\Products\DeleteHandler;
use App\Handlers\Admin\Products\ListHandler;
use App\NavMenu;
use App\Http\Controllers\Controller;

class ListController extends Controller
{
    public function render(ListHandler $handler)
    {
        NavMenu::$active = 'admin.products';

        return view('admin.products.list', [
            'products' => $handler->getProducts()
        ]);
    }

    public function delete(DeleteHandler $handler, int $id)
    {
        try {
            $product = $handler->getProduct($id);

            $handler->handle($product);

            return redirect()->route('admin.products')
                ->with('success_message', "Товар #{$product->getName()} был удален");
        } catch (ProductNotFoundException $exception) {
            return redirect()->route('admin.products')->withErrors($exception->getMessage());
        }
    }
}
