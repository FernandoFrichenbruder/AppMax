@extends('layouts.app')


@section('content')

    <a href="{{route('admin.orders.create')}}" class="btn btn-lg btn-success">Gerar Pedido</a>

    <table class="table table-striped index">
        <thead>
        <tr>
            <th>#</th>
            <th>Quantidade de Produtos</th>
            <th>Ativo</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->items->count()}}</td>
                <td>{{$order->active}}</td>
                <td class="actions">
                    <div class="btn-group">
                        <a href="{{route('admin.orders.populate', ['order' => $order->id])}}" class="btn btn-sm btn-primary">EDITAR</a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
