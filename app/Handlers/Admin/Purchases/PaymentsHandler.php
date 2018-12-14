<?php


namespace App\Handlers\Admin\Purchases;


use App\Repository\Purchase\PurchaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class PaymentsHandler
{
    private $purchaseRepository;

    public function __construct(PurchaseRepository $purchaseRepository)
    {
        $this->purchaseRepository = $purchaseRepository;
    }

    public function handle(int $page, ?string $player = null): LengthAwarePaginator
    {
        return $this->purchaseRepository->getAllPayed($page, $player);
    }
}