<?php


namespace App\Handlers\Index\Payment;


use App\DataObjects\Payment\OrderDataObject;
use App\DataObjects\Payment\OrderPipelineObject;
use App\Entity\Product;
use App\Entity\Purchase;
use App\Exceptions\Product\ProductNotFoundException;
use App\Exceptions\RuntimeException;
use App\Repository\Product\ProductRepository;
use App\Repository\Purchase\PurchaseRepository;
use App\Services\Purchasing\Payers\Payer;
use App\Services\Purchasing\Payers\Pool;
use Illuminate\Pipeline\Pipeline;

class OrderHandler
{
    private $purchaseRepository;

    private $productRepository;

    private $pool;

    public function __construct(
        PurchaseRepository $purchaseRepository,
        ProductRepository $productRepository,
        Pool $pool)
    {
        $this->purchaseRepository = $purchaseRepository;
        $this->productRepository = $productRepository;
        $this->pool = $pool;
    }

    private function getPayer(string $method): Payer
    {
        $payer = $this->pool->retrieveByName($method);
        if(is_null($payer)) {
            throw new RuntimeException("Метод #$method не найден!");
        }

        return $payer;
    }

    private function getProduct(int $id): Product
    {
        $product = $this->productRepository->find($id);
        if(is_null($product)) {
            throw new ProductNotFoundException($id);
        }

        return $product;
    }

    public function handle(OrderDataObject $order, string $ip)
    {
        $payer = $this->getPayer($order->getMethod());

        $product = $this->getProduct($order->getProductId());

        /* @var OrderPipelineObject $result */
        $result = app(Pipeline::class)
            ->send(new OrderPipelineObject(
                new Purchase($product, $order->getName(), $product->getPrice(), $order->getPromo(), $ip)
            ))
            ->through([
                \App\Services\Purchasing\Pipeline\Order\Surcharge::class,
                \App\Services\Purchasing\Pipeline\Order\Promo::class,
            ])
            ->then(function ($order) {
                return $order;
            });

        $this->purchaseRepository->create($result->getPurchase());

        return $payer->paymentURL($result->getPurchase(), $result->isSurcharge());
    }
}