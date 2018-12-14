@extends('layouts.admin')

@section('admin-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-deck">
                <div class="card-body">

                    @include('admin.errors')
                    @include('admin.success')

                    <div class="row">
                        <div class="col-md-6">
                            {{--<div class="card card-deck">
                                <div class="card-body">

                                </div>
                            </div>--}}
                        </div>
                        <div class="col-md-6">
                            <div class="card card-deck">
                                <div class="card-body">
                                    <form action="{{route('admin.clear_cache')}}" method="post" class="text-center">
                                        @csrf
                                        <input type="submit" class="btn btn-danger" value="Очистить кэш">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection