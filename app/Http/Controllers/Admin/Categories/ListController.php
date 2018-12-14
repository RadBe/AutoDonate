<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Exceptions\Category\CategoryNotFoundException;
use App\Handlers\Admin\Categories\DeleteHandler;
use App\Handlers\Admin\Categories\ListHandler;
use App\NavMenu;
use App\Http\Controllers\Controller;

class ListController extends Controller
{
    public function render(ListHandler $handler)
    {
        NavMenu::$active = 'admin.categories';

        return view('admin.categories.list', [
            'categories' => $handler->getCategories()
        ]);
    }

    public function delete(DeleteHandler $handler, int $id)
    {
        try {
            $category = $handler->getCategory($id);

            $handler->handle($category);

            return redirect()->route('admin.categories')
                ->with('success_message', "Категория #{$category->getName()} была удалена!");
        } catch (CategoryNotFoundException $exception) {
            return redirect()->route('admin.categories')->withErrors($exception->getMessage());
        }
    }
}
