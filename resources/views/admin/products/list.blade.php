@extends('layouts.admin')

@section('admin-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-deck">
                <div class="card-body">

                    @include('admin.errors')
                    @include('admin.success')

                    <div class="form-group">
                        <a href="{{route('admin.products.create')}}" class="btn btn-info w-100">Создать товар</a>
                    </div>

                    <table class="table table-responsive-xl table-hover table-vertical-align-middle">
                        <thead>
                        <tr>
                            <th>Сервер</th>
                            <th>Название</th>
                            <th>Категория</th>
                            <th>Цена</th>
                            <th></th>
                        </tr>
                        </thead>
                        <?php /* @var \App\Entity\Product[] $products */ ?>
                        @forelse($products as $product)
                            <tr>
                                <td>{{$product->getCategory()->getServer()->getName()}}</td>
                                <td>{{$product->getName()}}</td>
                                <td>{{$product->getCategory()->getName()}}</td>
                                <td>{{$product->getPrice()}}</td>
                                <td>
                                    <a href="{{route('admin.products.edit', ['id' => $product->getId()])}}" rel="tooltip" class="btn btn-outline-success rounded-circle" data-original-title="" title="Редактировать" style="padding: 4px;">
                                        <i class="fa fa-fw fa-edit" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Нет товаров для продажи...</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection