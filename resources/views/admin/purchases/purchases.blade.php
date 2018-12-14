@extends('layouts.admin')

@section('admin-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-deck">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-6">
                            <a href="{{route('admin.purchases.payments')}}" class="btn btn-success">Оплаченые</a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{route('admin.purchases.orders')}}" class="btn btn-danger">Неоплаченые</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection