<?php

namespace App\Http\Controllers\Admin\Products;

use App\DataObjects\Product\SaveDataObject;
use App\Exceptions\Category\CategoryNotFoundException;
use App\Handlers\Admin\Products\CreateHandler;
use App\Http\Request\Admin\ProductSaveRequest;
use App\NavMenu;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class CreateController extends Controller
{
    public function render(CreateHandler $handler)
    {
        NavMenu::$active = 'admin.products';

        $categories = $handler->getCategories();

        $jsonTypes = [];
        /* @var \App\Entity\Category[] $categories */
        foreach ($categories as $category)
        {
            $jsonTypes[$category->getId()] = $category->getType()->getJsonData();
        }

        return view('admin.products.create', [
            'categories' => $categories,
            'jsonTypes' => $jsonTypes
        ]);
    }

    public function create(ProductSaveRequest $request, CreateHandler $handler)
    {
        try {
            $category = $handler->getCategory((int) $request->get('category'));

            $inputs = [];

            if(is_array($category->getType()->getJsonData())) {
                $rules = [];
                foreach ($category->getType()->getJsonData() as $input => $name)
                {
                    $rules[$input] = 'required';
                    $inputs[$input] = $request->get($input);
                }

                $this->validate($request, $rules);
            }

            $handler->handle(new SaveDataObject(
                $category->getId(),
                $request->get('name'),
                (int) $request->get('price'),
                $inputs
            ), $category);

            return redirect()->route('admin.products')
                ->with('success_message', 'Товар был успешно создан');
        } catch (ValidationException | CategoryNotFoundException $exception) {
            return redirect()->route('admin.products.create')->withErrors($exception->getMessage());
        }
    }
}
