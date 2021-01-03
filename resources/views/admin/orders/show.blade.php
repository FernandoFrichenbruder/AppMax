@extends('layouts.app')


@section('content')

    <div class="row">
        <div class="col-8">
            <h1>Pedido - ID {{$order->id}}</h1>
            <h4>Quantidade de itens: {{$order->countItems}}</h4>
            <h4>Status {{$order->active ? 'Ativo' : 'Finalizado' }}</h4>
        </div>
        <div class="col-4">
            <h3>TOTAL DO PEDIDO: {{$order->totalPrice}}</h3>
        </div>
    </div>

    <h4>Itens</h4>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>SKU</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Total/Item</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order->items as $item)
            <tr>
                <td>{{$item['sku']}}</td>
                <td>{{$item['price']}}</td>
                <td>{{$item['quantity']}}</td>
                <td>{{$item['totalItemPrice']}}</td>

            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
