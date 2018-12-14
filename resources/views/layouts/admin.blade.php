<?php use App\NavMenu; ?>

@extends('layouts.index')

@section('head')
    <script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
@endsection

@section('content')
    <nav class="navbar navbar-expand-xl navbar-light" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="{{route('admin')}}">Админ-панель</a>
            <button class="navbar-toggler navbar-toggler-right text-uppercase rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto text-uppercase">
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link {{NavMenu::active_tab('admin.products')}}" href="{{route('admin.products')}}">Товары</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link {{NavMenu::active_tab('admin.servers')}}" href="{{route('admin.servers')}}">Серверы</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link {{NavMenu::active_tab('admin.categories')}}" href="{{route('admin.categories')}}">Категории</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link {{NavMenu::active_tab('admin.pages')}}" href="{{route('admin.pages')}}">Страницы</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link {{NavMenu::active_tab('admin.purchases')}}" href="{{route('admin.purchases')}}">Платежи</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link {{NavMenu::active_tab('admin.promocodes')}}" href="{{route('admin.promocodes')}}">Промо</a></li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('admin-content')
@endsection