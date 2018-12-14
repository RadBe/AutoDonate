@extends('layouts.admin')

@section('admin-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-deck">
                <div class="card-body">

                    @include('admin.errors')
                    @include('admin.success')

                    <div class="form-group">
                        <a href="{{route('admin.promocodes.create')}}" class="btn btn-info w-100">Создать промо-код</a>
                    </div>

                    <table class="table table-responsive-xl table-hover table-vertical-align-middle">
                        <thead>
                        <tr>
                            <th>Код</th>
                            <th>Скидка</th>
                            <th>Количество</th>
                            <th>До</th>
                            <th></th>
                        </tr>
                        </thead>
                        <?php /* @var \App\Entity\PromoCode[] $promos */ ?>
                        @forelse($promos as $promo)
                            <tr>
                                <td>{{$promo->getCode()}}</td>
                                <td>{{$promo->getDiscount()}}</td>
                                <td>{{$promo->getAmount() ?: '-'}}</td>
                                <td>{{!is_null($promo->getActiveBefore()) ? $promo->getActiveBefore()->format('d.m.Y H:i') : '-'}}</td>
                                <td>
                                    <form action="{{route('admin.promocodes.delete', ['id' => $promo->getId()])}}"
                                          method="post"
                                          onsubmit="return confirm('Вы действительно хотите удалить промо-код {{$promo->getCode()}}?')"
                                    >
                                        @csrf
                                        <button type="submit" rel="tooltip" class="btn btn-outline-danger rounded-circle" data-original-title="" title="Удалить" style="padding: 4px;">
                                            <i class="fa fa-fw fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Нет кодов...</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection