<?php


namespace App\Handlers\Index\Payment;


use App\DataObjects\Payment\PaymentPipelineObject;
use App\Entity\Purchase;
use App\Exceptions\Payment\PayerNotFoundException;
use App\Exceptions\Purchase\PurchaseNotFoundException;
use App\Exceptions\Rcon\ConnectSocketException;
use App\Repository\Purchase\PurchaseRepository;
use App\Services\Purchasing\Payers\Payer;
use App\Services\Purchasing\Payers\Pool;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Log;

class PaymentHandler
{
    private $purchaseRepository;

    private $pool;

    public function __construct(
        PurchaseRepository $purchaseRepository,
        Pool $pool)
    {
        $this->purchaseRepository = $purchaseRepository;
        $this->pool = $pool;
    }

    private function getPayer(string $method): Payer
    {
        $payer = $this->pool->retrieveByName($method);
        if(is_null($payer)) {
            throw PayerNotFoundException::byName($method);
        }

        return $payer;
    }

    private function getPurchase(int $id): Purchase
    {
        $purchase = $this->purchaseRepository->find($id);
        if(is_null($purchase)) {
            throw new PurchaseNotFoundException($id);
        }

        return $purchase;
    }

    public function handle(string $method, array $data, string $ip): string
    {
        try {
            $payer = $this->getPayer($method);

            $purchase = $this->getPurchase($payer->purchaseId($data));

            if($purchase->isCompleted()) {
                return $payer->errorMessage("Платеж '{$purchase->getId()}' уже оплачен!");
            }

            app(Pipeline::class)
                ->send(new PaymentPipelineObject($payer, $purchase, $data, $ip))
                ->through([
                    \App\Services\Purchasing\Pipeline\Payment\Validate::class, //обязательно первый

                    \App\Services\Purchasing\Pipeline\Payment\Promo::class,

                    \App\Services\Purchasing\Pipeline\Payment\Complete::class, //обязательно последний
                ])
                ->then(function () {
                    //empty
                });

            return $payer->successMessage($purchase);
        } catch (PayerNotFoundException $exception) {
            throw $exception;
        } catch (ConnectSocketException $exception) {
            Log::error($exception);
            throw new \Exception($payer->errorMessage('Не удалось подключиться к rcon!'));
        } catch (\Exception $exception) {
            Log::error($exception);
            throw new \Exception($payer->errorMessage($exception->getMessage()));
        }
    }
}