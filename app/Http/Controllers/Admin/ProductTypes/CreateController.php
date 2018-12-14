<?php

namespace App\Http\Controllers\Admin\ProductTypes;

use App\DataObjects\ProductType\SaveDataObject;
use App\Handlers\Admin\ProductTypes\CreateHandler;
use App\Http\Request\Admin\ProductTypeSaveRequest;
use App\NavMenu;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class CreateController extends Controller
{
    public function render()
    {
        NavMenu::$active = 'admin.types';

        return view('admin.types.create', [
            'distributors' => config('site.purchasing.distributors')
        ]);
    }

    public function create(ProductTypeSaveRequest $request, CreateHandler $handler)
    {
        try {
            $handler->handle(new SaveDataObject(
                $request->get('type'),
                $request->get('name'),
                $request->get('surcharge'),
                $request->get('distributor'),
                $request->get('data')
            ));

            return redirect()->route('admin.types')
                ->with('success_message', 'Тип товара был успешно создан');
        } catch (ValidationException $exception) {
            return redirect()->route('admin.types.create')->withErrors($exception->getMessage());
        }
    }
}
