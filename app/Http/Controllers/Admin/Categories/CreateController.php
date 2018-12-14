<?php

namespace App\Http\Controllers\Admin\Categories;

use App\DataObjects\Category\SaveDataObject;
use App\Exceptions\ProductType\ProductTypeNotFoundException;
use App\Exceptions\Server\ServerNotFoundException;
use App\Handlers\Admin\Categories\CreateHandler;
use App\Http\Request\Admin\CategorySaveRequest;
use App\NavMenu;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class CreateController extends Controller
{
    public function render(CreateHandler $handler)
    {
        NavMenu::$active = 'admin.categories';

        return view('admin.categories.create', [
            'servers' => $handler->getServers(),
            'types' => $handler->getTypes()
        ]);
    }

    public function create(CategorySaveRequest $request, CreateHandler $handler)
    {
        try {
            $handler->handle(new SaveDataObject(
                (int) $request->get('server'),
                $request->get('type'),
                $request->get('name'),
                (int) $request->get('weight')
            ));

            return redirect()->route('admin.categories')->with('success_message', 'Категория успешно создана');
        } catch (ValidationException | ServerNotFoundException | ProductTypeNotFoundException $exception) {
            return redirect()->route('admin.categories.create')->withErrors($exception->getMessage());
        }
    }
}
