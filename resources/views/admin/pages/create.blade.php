@extends('layouts.admin')

@section('head')
    <script type="text/javascript" src="{{asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function(event) {
            CKEDITOR.replace( 'page-content' );
        })
    </script>
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
                        @include('admin.pages.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection