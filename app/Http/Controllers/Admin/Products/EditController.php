<?php

namespace App\Http\Controllers\Admin\Products;

use App\DataObjects\Product\SaveDataObject;
use App\Exceptions\Category\CategoryNotFoundException;
use App\Exceptions\Product\ProductNotFoundException;
use App\Handlers\Admin\Products\EditHandler;
use App\Http\Request\Admin\ProductSaveRequest;
use App\NavMenu;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class EditController extends Controller
{
    public function render(EditHandler $handler, int $id)
    {
        NavMenu::$active = 'admin.products';

        $categories = $handler->getCategories();

        try {
            $product = $handler->getProduct($id);

            $jsonTypes = [];
            /* @var \App\Entity\Category[] $categories */
            foreach ($categories as $category)
            {
                $jsonTypes[$category->getId()] = $category->getType()->getJsonData();
            }

            $inputs = [];
            if(is_array($product->getJsonData())) {
                foreach ($product->getJsonData() as $input => $data)
                {
                    $inputs[$input] = $data;
                }
            }

            return view('admin.products.edit', compact('product', 'categories', 'jsonTypes', 'inputs'));
        } catch (ProductNotFoundException $exception) {
            return redirect()->route('admin.products')->withErrors($exception->getMessage());
        }
    }

    public function edit(ProductSaveRequest $request, EditHandler $handler, int $id)
    {
        try {
            $product = $handler->getProduct($id);

            $inputs = [];

            if(is_array($product->getCategory()->getType()->getJsonData())) {
                $rules = [];
                foreach ($product->getCategory()->getType()->getJsonData() as $input => $name)
                {
                    $rules[$input] = 'required';
                    $inputs[$input] = $request->get($input);
                }

                $this->validate($request, $rules);
            }

            $handler->handle(new SaveDataObject(
                (int) $request->get('category'),
                $request->get('name'),
                (int) $request->get('price'),
                $inputs
            ), $product);

            return redirect()->route('admin.products.edit', ['id' => $id])
                ->with('success_message', 'Товар был успешно изменен');
        } catch (ProductNotFoundException $exception) {
            return redirect()->route('admin.products')->withErrors($exception->getMessage());
        } catch (ValidationException | CategoryNotFoundException $exception) {
            return redirect()->route('admin.products.edit', ['id' => $id])->withErrors($exception->getMessage());
        }
    }
}
