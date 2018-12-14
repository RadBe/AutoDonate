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

                    <form action="{{route('admin.pages.delete', ['slug' => $page->getSlug()])}}"
                          method="post"
                          onsubmit="return confirm('Вы действительно хотите удалить страницу #{{$page->getSlug()}}?')">
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