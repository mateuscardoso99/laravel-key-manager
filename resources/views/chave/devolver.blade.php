@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{route('chave.encerrar',$chave->id)}}" method="post">
            	@csrf
            	<input class="form-control" type="text" name="sala" value="{{$chave->sala}}" readonly>

                <input class="form-control" type="text" name="data" required>

            	<button class="btn btn-primary" type="submit">Encerrar aula</button>
            </form>
        </div>
    </div>
</div>
@endsection