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

                    <form action="{{route('admin.products.delete', ['id' => $product->getId()])}}" method="post" onsubmit="return confirm('Вы действительно хотите удалить товар #{{$product->getName()}}')">
                        @csrf
                        <div class="form-group">
                            <input type="submit" class="btn btn-danger w-100" value="Удалить">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection