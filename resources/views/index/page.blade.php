@extends('layouts.index')

@section('content')

    @include('admin.errors')
    @include('admin.success')

    <h2 class="h2">{{$page->getTitle()}}</h2>
    <hr>

    {!! $page->getContent() !!}

@endsection