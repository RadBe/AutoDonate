@extends('layouts.admin')

@section('admin-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-deck">
                <div class="card-body">
                    <h5 class="card-title">Оплаченые заказы</h5>
                    <table class="table table-responsive-xl table-hover table-vertical-align-middle">
                        <thead>
                        <tr>
                            <th>Игрок</th>
                            <th>Товар</th>
                            <th>Цена</th>
                            <th>Дата</th>
                            <th>Метод</th>
                        </tr>
                        </thead>
                        <?php /* @var \App\Entity\Purchase[] $payments */ ?>
                        @forelse($payments->all() as $payment)
                            <tr>
                                <td>
                                    <a href="{{route('admin.purchases.payments', ['player' => $payment->getName()])}}">
                                        {{$payment->getName()}}
                                    </a>
                                </td>
                                <td>{{$payment->getProduct()->getName()}}</td>
                                <td>{{$payment->getPrice()}}</td>
                                <td>{{$payment->getCompletedAt()->format('d.m.Y H:i')}}</td>
                                <td>{{$payment->getVia()}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Нет покупок...</td>
                            </tr>
                        @endforelse
                        <tfoot>
                            <tr>
                                <td colspan="5">{{$payments->render()}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection