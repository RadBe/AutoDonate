<?php

/**
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
* @var \Illuminate\Routing\Router $router
*/


$router->group(['namespace' => 'Index'], function (\Illuminate\Routing\Router $router) {
    $router->get('/', 'HomeController@render');

    $router->get('page/{slug}', 'PageController@render')->name('page')
        ->where('slug', '[a-z0-9_]+');

    $router->post('order', 'Payment\OrderController@order')->name('order');

    $router->get('payment/{method}', 'Payment\PaymentController@pay')
        ->where('method', '[a-z0-9]+');
});

$router->get('admin/login', 'Admin\LoginController@render');
$router->post('admin/login', 'Admin\LoginController@login');


$router->group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth:admin'], function (\Illuminate\Routing\Router $router) {
    $router->get('/', 'HomeController@render')->name('admin');

    $router->post('clear_cache', 'HomeController@clearCache')->name('admin.clear_cache');

    $router->group(['prefix' => 'products', 'namespace' => 'Products'], function (\Illuminate\Routing\Router $router) {
        $router->get('/', 'ListController@render')->name('admin.products');

        $router->get('create', 'CreateController@render')->name('admin.products.create');
        $router->post('create', 'CreateController@create');

        $router->get('edit/{id}', 'EditController@render')->where('id', '[0-9]+')
            ->name('admin.products.edit');
        $router->post('edit/{id}', 'EditController@edit')->where('id', '[0-9]+');

        $router->post('delete/{id}', 'ListController@delete')->where('id', '[0-9]+')
            ->name('admin.products.delete');
    });

    $router->group(['prefix' => 'servers', 'namespace' => 'Servers'], function (\Illuminate\Routing\Router $router) {
        $router->get('/', 'ListController@render')->name('admin.servers');

        $router->get('create', 'CreateController@render')->name('admin.servers.create');
        $router->post('create', 'CreateController@create');

        $router->get('edit/{id}', 'EditController@render')->where('id', '[0-9]+')
            ->name('admin.servers.edit');
        $router->post('edit/{id}', 'EditController@edit')->where('id', '[0-9]+');

        $router->post('delete/{id}', 'ListController@delete')->where('id', '[0-9]+')
            ->name('admin.servers.delete');
    });

    $router->group(['prefix' => 'categories', 'namespace' => 'Categories'], function (\Illuminate\Routing\Router $router) {
        $router->get('/', 'ListController@render')->name('admin.categories');

        $router->get('create', 'CreateController@render')->name('admin.categories.create');
        $router->post('create', 'CreateController@create');

        $router->get('edit/{id}', 'EditController@render')->where('id', '[0-9]+')
            ->name('admin.categories.edit');
        $router->post('edit/{id}', 'EditController@edit')->where('id', '[0-9]+');

        $router->post('delete/{id}', 'ListController@delete')->where('id', '[0-9]+')
            ->name('admin.categories.delete');
    });

    $router->group(['prefix' => 'types', 'namespace' => 'ProductTypes'], function (\Illuminate\Routing\Router $router) {
        $router->get('/', 'ListController@render')->name('admin.types');

        $router->get('create', 'CreateController@render')->name('admin.types.create');
        $router->post('create', 'CreateController@create');

        $router->get('edit/{id}', 'EditController@render')->where('id', '[a-z0-9]+')
            ->name('admin.types.edit');
        $router->post('edit/{id}', 'EditController@edit')->where('id', '[a-z0-9]+');

        $router->post('delete/{id}', 'ListController@delete')->where('id', '[a-z0-9]+')
            ->name('admin.types.delete');
    });

    $router->group(['prefix' => 'pages', 'namespace' => 'Pages'], function (\Illuminate\Routing\Router $router) {
        $router->get('/', 'ListController@render')->name('admin.pages');

        $router->get('create', 'CreateController@render')->name('admin.pages.create');
        $router->post('create', 'CreateController@create');

        $router->get('edit/{slug}', 'EditController@render')->where('slug', '[a-z0-9_]+')
            ->name('admin.pages.edit');
        $router->post('edit/{slug}', 'EditController@edit')->where('slug', '[a-z0-9_]+');

        $router->post('delete/{slug}', 'ListController@delete')->where('slug', '[a-z0-9_]+')
            ->name('admin.pages.delete');
    });

    $router->group(['prefix' => 'promocodes', 'namespace' => 'PromoCodes'], function (\Illuminate\Routing\Router $router) {
        $router->get('/', 'ListController@render')->name('admin.promocodes');

        $router->get('create', 'CreateController@render')->name('admin.promocodes.create');
        $router->post('create', 'CreateController@create');

        $router->post('delete/{id}', 'ListController@delete')->where('id', '[0-9]+')
            ->name('admin.promocodes.delete');
    });

    $router->group(['prefix' => 'purchases', 'namespace' => 'Purchases'], function (\Illuminate\Routing\Router $router) {
        $router->get('/', 'PurchasesController@render')->name('admin.purchases');

        $router->get('/payments/{player?}', 'PaymentsController@render')->name('admin.purchases.payments')
            ->where('player', '[A-Za-z0-9_]+');

        $router->get('/orders/{player?}', 'OrdersController@render')->name('admin.purchases.orders')
            ->where('player', '[A-Za-z0-9_]+');
    });
});