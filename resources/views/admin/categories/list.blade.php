@extends('layouts.admin')

@section('admin-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-deck">
                <div class="card-body">

                    @include('admin.errors')
                    @include('admin.success')

                    <div class="form-group">
                        <a href="{{route('admin.categories.create')}}" class="btn btn-info w-100">Создать категорию</a>
                    </div>

                    <table class="table table-responsive-xl table-hover table-vertical-align-middle">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>Тип</th>
                            <th>Сервер</th>
                            <th>Видимость</th>
                            <th></th>
                        </tr>
                        </thead>
                        <?php /* @var \App\Entity\Category[] $categories */ ?>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{$category->getName()}}</td>
                                <td>{{$category->getType()->getName()}}</td>
                                <td>{{$category->getServer()->getName()}}</td>
                                <td>{{$category->getServer()->isEnabled() ? 'Видима' : 'Скрыта'}}</td>
                                <td>
                                    <a href="{{route('admin.categories.edit', ['id' => $category->getId()])}}" rel="tooltip" class="btn btn-outline-success rounded-circle" data-original-title="" title="Редактировать" style="padding: 4px;">
                                        <i class="fa fa-fw fa-edit" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Нет категорий...</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection