<?php


namespace App\Providers;


use App\Repository\Category\CategoryRepository;
use App\Repository\Category\DoctrineCategoryRepository;
use App\Repository\Page\DoctrinePageRepository;
use App\Repository\Page\PageRepository;
use App\Repository\Product\DoctrineProductRepository;
use App\Repository\Product\ProductRepository;
use App\Repository\ProductType\DoctrineProductTypeRepository;
use App\Repository\ProductType\ProductTypeRepository;
use App\Repository\PromoCode\DoctrinePromoCodeRepository;
use App\Repository\PromoCode\PromoCodeRepository;
use App\Repository\PromoUser\DoctrinePromoUserRepository;
use App\Repository\PromoUser\PromoUserRepository;
use App\Repository\Purchase\DoctrinePurchaseRepository;
use App\Repository\Purchase\PurchaseRepository;
use App\Repository\Server\DoctrineServerRepository;
use App\Repository\Server\ServerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        //
    }

    public function register(): void
    {
        foreach ([
                     ProductRepository::class => [
                         'concrete' => DoctrineProductRepository::class,
                         'entity' => \App\Entity\Product::class
                     ],
                     ServerRepository::class => [
                         'concrete' => DoctrineServerRepository::class,
                         'entity' => \App\Entity\Server::class
                     ],
                     CategoryRepository::class => [
                         'concrete' => DoctrineCategoryRepository::class,
                         'entity' => \App\Entity\Category::class
                     ],
                     ProductTypeRepository::class => [
                         'concrete' => DoctrineProductTypeRepository::class,
                         'entity' => \App\Entity\ProductType::class
                     ],
                     PurchaseRepository::class => [
                         'concrete' => DoctrinePurchaseRepository::class,
                         'entity' => \App\Entity\Purchase::class
                     ],
                     PageRepository::class => [
                         'concrete' => DoctrinePageRepository::class,
                         'entity' => \App\Entity\Page::class
                     ],
                     PromoCodeRepository::class => [
                         'concrete' => DoctrinePromoCodeRepository::class,
                         'entity' => \App\Entity\PromoCode::class
                     ],
                     PromoUserRepository::class => [
                         'concrete' => DoctrinePromoUserRepository::class,
                         'entity' => \App\Entity\PromoUser::class
                     ],
                 ]
                 as $interface => $data) {
            $this->app->when($data['concrete'])
                ->needs(EntityRepository::class)
                ->give(function () use ($data) {
                    return $this->buildEntityRepository($data['entity']);
                });

            $this->app->singleton($interface, $data['concrete']);
        }
    }

    private function buildEntityRepository(string $entity)
    {
        return new EntityRepository(
            $this->app->make(EntityManagerInterface::class),
            new ClassMetadata($entity)
        );
    }
}