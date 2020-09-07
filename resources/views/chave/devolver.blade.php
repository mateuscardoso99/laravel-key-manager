@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{route('chave.encerrar',$chave->id)}}" method="post">
            	@csrf

                <div class="form-group">
                    <label for="sala">Sala</label>
                    <input type="text" name="sala" class="form-control" value="{{$chave->sala}}" placeholder="Sala" id="sala" readonly required>
                </div>

                <div class="form-group">
                    <label for="data">Data</label>
                    <input type="text" name="data" class="form-control" placeholder="d/m/y" id="data" required>
                </div>

            	<button class="btn btn-primary" type="submit">Encerrar aula</button>
            </form>

            @foreach($errors->all() as $message)
                <div class="alert alert-danger text-center mt-3" role="alert">
                    <strong>{{$message}}</strong>
                </div>
             @endforeach
             
        </div>
    </div>
</div>
@endsection