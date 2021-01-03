@extends('layouts.app')


@section('content')
    <h1>Gerar Pedido</h1>
    <form action="{{route('admin.orders.store')}}" method="post">
        @csrf

        <div class="form-group">
            <label for="categories">Cliente</label>
            <select name="user_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>
        
        <div>
            <button type="submit" class="btn btn-lg btn-success">Abrir Pedido</button>
        </div>
    </form>
@endsection
