<?php


namespace App\Http\Controllers\Index;


use App\Exceptions\Page\PageNotFoundException;
use App\Handlers\Index\PageHandler;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function render(PageHandler $handler, string $slug)
    {
        try {
            return view('index.page', [
                'page' => $handler->getPage($slug)
            ]);
        } catch (PageNotFoundException $exception) {
            return redirect('/')->withErrors($exception->getMessage());
        }
    }
}