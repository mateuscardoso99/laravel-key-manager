@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{route('porteiro.update',$porteiro->id)}}" method="post">
            	@method('put')
            	@csrf
            	<input class="form-control" type="text" name="nome" value="{{$porteiro->nome}}" required>
            	<button class="btn btn-primary" type="submit">Salvar</button>
            </form>
        </div>
    </div>
</div>
@endsection