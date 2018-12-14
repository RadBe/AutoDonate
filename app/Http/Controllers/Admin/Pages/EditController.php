<?php

namespace App\Http\Controllers\Admin\Pages;

use App\DataObjects\Page\SaveDataObject;
use App\Exceptions\Page\PageNotFoundException;
use App\Handlers\Admin\Pages\EditHandler;
use App\Http\Request\Admin\PageSaveRequest;
use App\NavMenu;
use Dotenv\Exception\ValidationException;
use App\Http\Controllers\Controller;

class EditController extends Controller
{
    public function render(EditHandler $handler, string $slug)
    {
        NavMenu::$active = 'admin.pages';

        try {
            return view('admin.pages.edit', [
                'page' => $handler->getPage($slug)
            ]);
        } catch (PageNotFoundException $exception) {
            return redirect()->route('admin.pages')->withErrors($exception->getMessage());
        }
    }

    public function edit(PageSaveRequest $request, EditHandler $handler, string $slug)
    {
        try {
            $page = $handler->getPage($slug);

            $handler->handle(new SaveDataObject(
                $request->get('slug'),
                $request->get('title'),
                $request->get('content')
            ), $page);

            return redirect()->route('admin.pages.edit', ['slug' => $slug])
                ->with('success_message', "Страница #{$page->getSlug()} была успешно изменена");
        } catch (PageNotFoundException $exception) {
            return redirect()->route('admin.pages')->withErrors($exception->getMessage());
        } catch (ValidationException $exception) {
            return redirect()->route('admin.pages.edit', ['slug' => $slug])->withErrors($exception->getMessage());
        }
    }
}
