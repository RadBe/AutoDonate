@extends('layouts.index')

@section('content')

    @include('admin.errors')
    @include('admin.success')

    <form id="permissionForm" action="{{route('order')}}" method="post" class="pt-3">
        @csrf
        <div class="form-group">
            <label class="font-weight-bold small" for="name">Введите никнейм</label>
            <input type="text" class="form-control" maxlength="32" id="name" name="name" placeholder="Введите никнейм">
        </div>

        <div class="form-group">
            <label class="font-weight-bold small" for="product">Выберите привилегию</label>
            <select name="product" id="product" class="form-control">
                <?php
                    $prevCategory = null;
                    $isFirst = true
                /* @var \App\Entity\Product[] $products */
                ?>
                    @foreach($products as $product)
                        @if($product->getCategory()->getId() !== $prevCategory)

                            <?php $prevCategory = $product->getCategory()->getId() ?>
                            @if(!$isFirst)</optgroup>@endif
                            <optgroup label="{{$product->getCategory()->getName()}}">
                                <option value="{{$product->getId()}}">{{$product->getName()}} - {{$product->getPrice()}} руб.</option>
                                <?php $isFirst = false ?>

                        @else
                            <option value="{{$product->getId()}}">{{$product->getName()}} - {{$product->getPrice()}} руб.</option>
                        @endif
                    @endforeach;
                    </optgroup>
            </select>
        </div>

        <div class="form-group">
            <label for="method">Выберите способ оплаты</label>
            <select name="method" id="method" class="form-control">
                <option value="unitpay">UnitPay</option>
            </select>
        </div>

        <div class="form-group">
            <label class="font-weight-bold small" for="promo">Введите промо-код (если есть)</label>
            <input type="text" class="form-control" maxlength="64" id="promo" name="promo" placeholder="Введите промо-код (если есть)">
        </div>

        <div class="text-center pt-3">

            <label class="text-center d-block small text-secondary pb-3">
                <input type="checkbox" checked="" style="position: relative; top: 2px;" name="accept" value="1" required="">
                Подтверждаю свое согласие со всеми <a href="/page/rules">правилами</a> проекта
            </label>

            <button type="submit" class="btn btn-success text-uppercase">Купить</button>

        </div>
    </form>

@endsection