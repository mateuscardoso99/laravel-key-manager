@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{route('porteiro.store')}}" method="post">
            	@csrf
            	<input class="form-control" type="text" name="nome" required>
            	<button class="btn btn-primary" type="submit">Salvar</button>
            </form>
        </div>
    </div>
</div>
@endsection