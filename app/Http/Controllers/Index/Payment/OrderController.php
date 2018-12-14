<?php

namespace App\Http\Controllers\Index\Payment;

use App\DataObjects\Payment\OrderDataObject;
use App\Exceptions\RuntimeException;
use App\Handlers\Index\Payment\OrderHandler;
use App\Http\Request\Index\OrderRequest;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public function order(OrderRequest $request, OrderHandler $handler)
    {
        try {
            $url = $handler->handle(new OrderDataObject(
                $request->get('method'),
                $request->get('name'),
                (int) $request->get('product'),
                $request->get('promo', null)
            ), $request->ip());

            dd($url);

            return redirect($url);
        } catch (ValidationException | RuntimeException $exception) {
            return redirect('/')->withErrors($exception->getMessage());
        }
    }
}
