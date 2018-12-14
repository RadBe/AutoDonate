@extends('layouts.admin')

@section('admin-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-deck">
                <div class="card-body">

                    @include('admin.errors')
                    @include('admin.success')

                    <form action="" method="post">
                        @csrf
                        @include('admin.categories.partials.form')
                    </form>

                    <form action="{{route('admin.categories.delete', ['id' => $category->getId()])}}"
                          method="post"
                          onsubmit="return confirm('Вы действительно хотите удалить категорию #{{$category->getName()}}? Все товары находящиеся в ней будут удалены!')">
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