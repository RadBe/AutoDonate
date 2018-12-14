<?php

namespace App\Http\Controllers\Admin\PromoCodes;

use App\DataObjects\PromoCode\SaveDataObject;
use App\Exceptions\RuntimeException;
use App\Handlers\Admin\PromoCodes\CreateHandler;
use App\Http\Request\Admin\PromoCodeSaveRequest;
use App\Http\Controllers\Controller;
use App\NavMenu;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class CreateController extends Controller
{
    public function render()
    {
        NavMenu::$active = 'admin.promocodes';

        return view('admin.promocodes.create');
    }

    public function create(PromoCodeSaveRequest $request, CreateHandler $handler)
    {
        try {
            $handler->handle(new SaveDataObject(
                $request->get('code'),
                (int) $request->get('discount'),
                $request->get('amount'),
                $request->get('date')
            ));

            return redirect()->route('admin.promocodes')
                ->with('success_message', 'Промо-код был успешно создан');
        } catch (RuntimeException $exception) {
            return redirect()->route('admin.promocodes.create')->withErrors('Неправильный формат даты!');
        } catch (UniqueConstraintViolationException $exception) {
            return redirect()->route('admin.promocodes.create')->withErrors('Такой код уже существует!');
        }
    }
}
