@extends('layouts.admin')

@section('admin-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-deck">
                <div class="card-body">

                    @include('admin.errors')
                    @include('admin.success')

                    <div class="form-group">
                        <a href="{{route('admin.servers.create')}}" class="btn btn-info w-100">Создать сервер</a>
                    </div>

                    <table class="table table-responsive-xl table-hover table-vertical-align-middle">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>Видимость</th>
                            <th></th>
                        </tr>
                        </thead>
                        <?php /* @var \App\Entity\Server[] $servers */ ?>
                        @forelse($servers as $server)
                            <tr>
                                <td>{{$server->getName()}}</td>
                                <td>{{$server->isEnabled() ? 'Видим' : 'Скрыт'}}</td>
                                <td>
                                    <a href="{{route('admin.servers.edit', ['id' => $server->getId()])}}" rel="tooltip" class="btn btn-outline-success rounded-circle" data-original-title="" title="Редактировать" style="padding: 4px;">
                                        <i class="fa fa-fw fa-edit" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Нет серверов...</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection