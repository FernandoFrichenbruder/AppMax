@extends('layouts.app')

@section('content')
    <a href="{{route('admin.products.create')}}" class="btn btn-lg btn-success">Criar Produto</a>
    <table class="table table-striped index">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>SKU</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th style="text-align: center; width: 315px;">Movimentar Estoque</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->skus->sku}}</td>
                    <td>{{$product->skus->price}}</td>
                    <td>{{$product->skus->stock}}</td>
                    <td class="amount">
                        <form action="{{route('admin.skus.add')}}" method="post" class="addItems">
                            @csrf
                            <input type="number" name="quantity" max="{{$product->skus->stock}}" class="form-control quantity" />
                            <input type="hidden" name="sku_id" value="{{$product->skus->id}}">
                            <input type="hidden" name="route" value="admin.products.index">
                            <button type="submit" class="btn btn-sm btn-success addItem">+</button>
                        </form>

                        <form action="{{route('admin.skus.deduct')}}" method="post" class="addItems">
                            @csrf
                            <input type="number" name="quantity" max="{{$product->skus->stock}}" class="form-control quantity" />
                            <input type="hidden" name="sku_id" value="{{$product->skus->id}}">
                            <input type="hidden" name="route" value="admin.products.index">
                            <button type="submit" class="btn btn-sm btn-danger addItem">-</button>
                        </form>
                    </td>
                    <td class="actions">
                        <div class="btn-group">
                            <a href="{{route('admin.products.edit', ['product' => $product->id])}}" class="btn btn-sm btn-primary">Editar</a>
                            <form action="{{route('admin.products.destroy', ['product' => $product->id])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Remover</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{$products->links()}}
@endsection
