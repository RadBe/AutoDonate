<?php

namespace App\Http\Controllers\Admin\ProductTypes;

use App\Exceptions\ProductType\ProductTypeNotFoundException;
use App\Handlers\Admin\ProductTypes\DeleteHandler;
use App\Handlers\Admin\ProductTypes\ListHandler;
use App\NavMenu;
use App\Http\Controllers\Controller;

class ListController extends Controller
{
    public function render(ListHandler $handler)
    {
        NavMenu::$active = 'admin.types';

        return view('admin.types.list', [
            'types' => $handler->getProductTypes()
        ]);
    }

    public function delete(DeleteHandler $handler, string $id)
    {
        try {
            $type = $handler->getType($id);

            $handler->handle($type);

            return redirect()->route('admin.types')
                ->with('success_message', "Тип товара #{$type->getName()} был удален!");
        } catch (ProductTypeNotFoundException $exception) {
            return redirect()->route('admin.types')->withErrors($exception->getMessage());
        }
    }
}
