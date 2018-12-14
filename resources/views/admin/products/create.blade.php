@extends('layouts.admin')

@section('head')
    @include('admin.products.partials.script')
@endsection

@section('admin-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-deck">
                <div class="card-body">

                    @include('admin.errors')
                    @include('admin.success')

                    <form action="" method="post">
                        @csrf
                        @include('admin.products.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection