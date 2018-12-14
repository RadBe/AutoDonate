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
                        <div class="form-group">
                            <label for="token">Токен</label>
                            <input type="text" class="form-control" name="token" id="token">
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" class="btn btn-primary" value="Войти">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection