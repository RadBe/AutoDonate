@extends('layouts.admin')

@section('admin-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-deck">
                <div class="card-body">

                    @include('admin.errors')
                    @include('admin.success')

                    <div class="form-group">
                        <a href="{{route('admin.pages.create')}}" class="btn btn-info w-100">Создать страницу</a>
                    </div>

                    <table class="table table-responsive-xl table-hover table-vertical-align-middle">
                        <thead>
                        <tr>
                            <th>Ссылка</th>
                            <th>Описание</th>
                            <th></th>
                        </tr>
                        </thead>
                        <?php /* @var \App\Entity\Page[] $pages */ ?>
                        @forelse($pages as $page)
                            <tr>
                                <td>{{$page->getSlug()}}</td>
                                <td>{{$page->getTitle()}}</td>
                                <td>
                                    <a href="{{route('admin.pages.edit', ['slug' => $page->getSlug()])}}" rel="tooltip" class="btn btn-outline-success rounded-circle" data-original-title="" title="Редактировать" style="padding: 4px;">
                                        <i class="fa fa-fw fa-edit" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Нет страниц...</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection