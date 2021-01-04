@extends('layouts.app')


@section('content')

    <h1>Relatórios</h1>
    
    <hr>
    <h1 class="header">Novos Produtos Adicionados</h1>


            
            <table class="table table-striped index">
                <thead>
                <tr>
                    <th>Produto</th>
                    <th>SKU</th>
                    <th>Quantidade</th>
                    <th>Ação</th>
                    <th>Request</th>
                    <th>Data</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dataNew['products'] as $product)
                    <tr>
                        <td>{{$product->name}}</td>
                        <td>{{$product->sku}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->action}}</td>
                        <td>{{$product->trigger}}</td>
                        <td>{{$product->created_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div>
                @foreach($dataNew['total'] as $item)
                    <h5>Total Adicionado do SKU -   <b>{{$item->sku}}</b>: {{$item->sum}}</h5> 
                @endforeach
            </div>




    <hr>
    <h1 class="header">Adicionados no estoque</h1>
 

            
            <table class="table table-striped index">
                <thead>
                <tr>
                    <th>Produto</th>
                    <th>SKU</th>
                    <th>Quantidade</th>
                    <th>Ação</th>
                    <th>Request</th>
                    <th>Data</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dataAdded['products'] as $product)
                    <tr>
                        <td>{{$product->name}}</td>
                        <td>{{$product->sku}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->action}}</td>
                        <td>{{$product->trigger}}</td>
                        <td>{{$product->created_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div>
                @foreach($dataAdded['total'] as $item)
                    <h5>Total Adicionado do SKU -   <b>{{$item->sku}}</b>: {{$item->sum}}</h5> 
                @endforeach
            </div>


    <hr>
    <h1 class="header">Retirados do Estoque</h1>
            
            <table class="table table-striped index">
                <thead>
                <tr>
                    <th>Produto</th>
                    <th>SKU</th>
                    <th>Quantidade</th>
                    <th>Ação</th>
                    <th>Request</th>
                    <th>Data</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dataReducted['products'] as $product)
                    <tr>
                        <td>{{$product->name}}</td>
                        <td>{{$product->sku}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->action}}</td>
                        <td>{{$product->trigger}}</td>
                        <td>{{$product->created_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div>
                @foreach($dataReducted['total'] as $item)
                    <h5>Total Adicionado do SKU -   <b>{{$item->sku}}</b>: {{$item->sum}}</h5> 
                @endforeach
            </div>

    <h1 class="header">ESTOQUE BAIXO</h1>
    <div style="margin-bottom: 50px">
        @foreach($lowStock as $item)
            <h5>Item <b>{{$item->sku}}</b> está com estoque baixo. <b>Unidades: {{$item->stock}}</b></h5> 
        @endforeach
    </div>

@endsection
