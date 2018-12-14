<?php

namespace App\Http\Controllers\Admin\Categories;

use App\DataObjects\Category\SaveDataObject;
use App\Exceptions\Category\CategoryNotFoundException;
use App\Exceptions\ProductType\ProductTypeNotFoundException;
use App\Exceptions\Server\ServerNotFoundException;
use App\Handlers\Admin\Categories\EditHandler;
use App\Http\Controllers\Controller;
use App\Http\Request\Admin\CategorySaveRequest;
use App\NavMenu;
use Illuminate\Validation\ValidationException;

class EditController extends Controller
{
    public function render(EditHandler $handler, int $id)
    {
        NavMenu::$active = 'admin.categories';

        try {
            $category = $handler->getCategory($id);

            return view('admin.categories.edit', [
                'servers' => $handler->getServers(),
                'types' => $handler->getTypes(),
                'category' => $category
            ]);
        } catch (CategoryNotFoundException $exception) {
            return redirect()->route('admin.categories')->withErrors($exception->getMessage());
        }
    }

    public function edit(CategorySaveRequest $request, EditHandler $handler, int $id)
    {
        try {
            $category = $handler->getCategory($id);

            $handler->handle(new SaveDataObject(
                (int) $request->get('server'),
                $request->get('type'),
                $request->get('name'),
                (int) $request->get('weight')
            ), $category);

            return redirect()->route('admin.categories.edit', ['id' => $category->getId()])
                ->with('success_message', "Категория #{$category->getName()} успешно изменена");
        } catch (CategoryNotFoundException $exception) {
            return redirect()->route('admin.categories')->withErrors($exception->getMessage());
        } catch (ValidationException | ServerNotFoundException | ProductTypeNotFoundException $exception) {
            return redirect()->route('admin.categories.edit', ['id' => $category->getId()])
                ->withErrors($exception->getMessage());
        }
    }
}
