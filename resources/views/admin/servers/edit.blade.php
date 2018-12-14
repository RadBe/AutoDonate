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
                        @include('admin.servers.partials.form')
                    </form>

                    <form action="{{route('admin.servers.delete', ['id' => $server->getId()])}}"
                          method="post"
                          onsubmit="return confirm('Вы действительно хотите удалить сервер #{{$server->getName()}}? Все товары и категории связаные с ним также будут удалены!')">
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