@extends('layouts.app')


@section('content')
    <h1>Gerar Pedido</h1>
    
        @csrf
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
        
        
        <div class="addedItems">
            <h4>Produtos Adicionados</h4>
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
        
        <hr>

        <h1>Adicionar novos itens</h1>
        <table class="table table-striped index">
            <thead>
            <tr>
                <th>Produto</th>
                <th>SKU</th>
                <th>Estoque</th>
                <th>Preço</th>
                <th>Adicionar</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{$product->name}}</td>
                    <td>{{$product->skus->sku}}</td>
                    <td>{{$product->skus->stock}}</td>
                    <td>{{$product->skus->price}}</td>
                    <td>
                        <form action="{{route('admin.items.store')}}" method="post" class="addItems">
                            @csrf
                            <input type="number" name="quantity" max="{{$product->skus->stock}}" class="form-control quantity" />
                            <input type="hidden" name="sku_id" value="{{$product->skus->id}}">
                            <input type="hidden" name="order_id" value="{{$order->id}}" />
                            <input type="hidden" name="user_id" value="{{$order->user}}" />
                            <button type="submit" class="btn btn-sm btn-primary addItem">+</button>
                        </form>
                    </td>
    
                </tr>
            @endforeach
            </tbody>
        </table>
{{-- 
        <div>
            <button type="submit" class="btn btn-lg btn-success">Gerar Pedido</button>
        </div> --}}
    
@endsection
