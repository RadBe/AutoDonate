<?php

namespace App\Http\Controllers\Index\Payment;

use App\Handlers\Index\Payment\PaymentHandler;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class PaymentController extends Controller
{
    public function pay(Request $request, PaymentHandler $handler, string $method)
    {
        try {
            return new Response($handler->handle($method, $request->all(), $request->ip()));
        } catch (\Exception $exception) {
            return new Response($exception->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }
}
