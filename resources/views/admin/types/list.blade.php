@extends('layouts.admin')

@section('admin-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-deck">
                <div class="card-body">

                    @include('admin.errors')
                    @include('admin.success')

                    <div class="form-group">
                        <a href="{{route('admin.types.create')}}" class="btn btn-info w-100">Создать тип</a>
                    </div>

                    <table class="table table-responsive-xl table-hover table-vertical-align-middle">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>Доплата</th>
                            <th>Дистрибьютор</th>
                            <th></th>
                        </tr>
                        </thead>
                        <?php /* @var \App\Entity\ProductType[] $types */ ?>
                        @forelse($types as $type)
                            <tr>
                                <td>{{$type->getName()}}</td>
                                <td>{{$type->isSurcharge() ? 'Включена' : 'Отключена'}}</td>
                                <td>{{$type->getDistributor()}}</td>
                                <td>
                                    <a href="{{route('admin.types.edit', ['id' => $type->getType()])}}" rel="tooltip" class="btn btn-outline-success rounded-circle" data-original-title="" title="Редактировать" style="padding: 4px;">
                                        <i class="fa fa-fw fa-edit" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Нет типов...</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection