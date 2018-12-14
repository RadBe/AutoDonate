<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Exceptions\Page\PageNotFoundException;
use App\Handlers\Admin\Pages\DeleteHandler;
use App\Handlers\Admin\Pages\ListHandler;
use App\Http\Controllers\Controller;
use App\NavMenu;

class ListController extends Controller
{
    public function render(ListHandler $handler)
    {
        NavMenu::$active = 'admin.pages';

        return view('admin.pages.list', [
            'pages' => $handler->handle()
        ]);
    }

    public function delete(DeleteHandler $handler, string $slug)
    {
        try {
            $page = $handler->getPage($slug);

            $handler->handle($page);

            return redirect()->route('admin.pages')
                ->with('success_message', "Страница #{$page->getSlug()} была успешно удалена");
        } catch (PageNotFoundException $exception) {
            return redirect()->route('admin.pages.list')->withErrors($exception->getMessage());
        }
    }
}
