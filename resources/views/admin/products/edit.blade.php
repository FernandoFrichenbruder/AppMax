@extends('layouts.app')


@section('content')
    <h1>Atualizar Produto</h1>

    <form action="{{route('admin.products.update', ['product' => $product->id])}}" method="post">
        @csrf
        @method("PUT")

        <div class="form-group">
            <label>Nome Produto</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$product->name}}">

            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{$product->description}}">

            @error('description')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Imagem</label>
            <input type="text" name="image" class="form-control @error('image') is-invalid @enderror" value="{{$product->image}}">

            @error('image')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>


        <div class="form-group">
            <label>Preço</label>
            <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" value="{{$product->skus->price}}">

            @error('price')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Estoque</label>
            <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{$product->skus->stock}}">

            @error('stock')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="categories">Categorias</label>
            <select name="categories[]" multiple class="form-control">
                @foreach($categories as $category)
                    <option value="{{$category->id}}" @if($product->categories->contains($category)) selected @endif>{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control" value="{{$product->slug}}">
        </div>

        <div>
            <button type="submit" class="btn btn-lg btn-success">Atualizar Produto</button>
        </div>
    </form>
@endsection