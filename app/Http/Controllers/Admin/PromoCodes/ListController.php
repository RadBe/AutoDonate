<?php

namespace App\Http\Controllers\Admin\PromoCodes;

use App\Exceptions\PromoCode\PromoCodeNotFoundException;
use App\Handlers\Admin\PromoCodes\DeleteHandler;
use App\Handlers\Admin\PromoCodes\ListHandler;
use App\NavMenu;
use App\Http\Controllers\Controller;

class ListController extends Controller
{
    public function render(ListHandler $handler)
    {
        NavMenu::$active = 'admin.promocodes';

        return view('admin.promocodes.list', [
            'promos' => $handler->handle()
        ]);
    }

    public function delete(DeleteHandler $handler, int $id)
    {
        try {
            $promo = $handler->getPromo($id);

            $handler->handle($promo);

            return redirect()->route('admin.promocodes')
                ->with('success_message', "Промо-код #{$promo->getCode()} был успешно удален");
        } catch (PromoCodeNotFoundException $exception) {
            return redirect()->route('admin.promocodes')->withErrors($exception->getMessage());
        }
    }
}
