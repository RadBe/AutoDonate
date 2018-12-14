<?php

namespace App\Http\Controllers\Admin\ProductTypes;

use App\DataObjects\ProductType\SaveDataObject;
use App\Exceptions\ProductType\ProductTypeNotFoundException;
use App\Handlers\Admin\ProductTypes\CreateHandler;
use App\Handlers\Admin\ProductTypes\EditHandler;
use App\Http\Request\Admin\ProductTypeSaveRequest;
use App\NavMenu;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class EditController extends Controller
{
    public function render(EditHandler $handler, string $id)
    {
        NavMenu::$active = 'admin.types';

        try {
            return view('admin.types.edit', [
                'type' => $handler->getType($id),
                'distributors' => config('site.purchasing.distributors')
            ]);
        } catch (ProductTypeNotFoundException $exception) {
            return redirect()->route('admin.types')->withErrors($exception->getMessage());
        }
    }

    public function edit(ProductTypeSaveRequest $request, EditHandler $handler, string $id)
    {
        try {
            $type = $handler->getType($id);

            $handler->handle(new SaveDataObject(
                '',
                $request->get('name'),
                $request->get('surcharge'),
                $request->get('distributor'),
                $request->get('data')
            ), $type);

            return redirect()->route('admin.types.edit', ['id' => $type->getType()])
                ->with('success_message', 'Тип товара был успешно отредактирован');
        } catch (ProductTypeNotFoundException $exception) {
            return redirect()->route('admin.types')->withErrors($exception->getMessage());
        } catch (ValidationException $exception) {
            return redirect()->route('admin.types.edit', ['id' => $type->getType()])->withErrors($exception->getMessage());
        }
    }
}
