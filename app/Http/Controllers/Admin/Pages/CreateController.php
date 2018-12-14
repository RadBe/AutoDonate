<?php

namespace App\Http\Controllers\Admin\Pages;

use App\DataObjects\Page\SaveDataObject;
use App\Handlers\Admin\Pages\CreateHandler;
use App\Http\Request\Admin\PageSaveRequest;
use App\Http\Controllers\Controller;
use App\NavMenu;
use Illuminate\Validation\ValidationException;

class CreateController extends Controller
{
    public function render()
    {
        NavMenu::$active = 'admin.pages';

        return view('admin.pages.create');
    }

    public function create(PageSaveRequest $request, CreateHandler $handler)
    {
        try {
            $handler->handle(new SaveDataObject(
                $request->get('slug'),
                $request->get('title'),
                $request->get('content')
            ));

            return redirect()->route('admin.pages')->with('success_message', 'Страница была успешно создана');
        } catch (ValidationException $exception) {
            return redirect()->route('admin.pages.create')->withErrors($exception->getMessage());
        }
    }
}
