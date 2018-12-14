<?php


namespace App\Handlers\Admin;


use App\Repository\Product\ProductRepository;
use Illuminate\Support\Facades\Artisan;

class HomeHandler
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getProducts(): array
    {
        return $this->productRepository->getAll();
    }

    public function clearCache(): void
    {
        Artisan::call('config:cache');
        Artisan::call('cache:clear');
        Artisan::call('doctrine:clear:result:cache');
        Artisan::call('doctrine:clear:query:cache');
    }
}