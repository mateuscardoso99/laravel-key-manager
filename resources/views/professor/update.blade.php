@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{route('professor.update',$prof->id)}}" method="post">
                @method('put')
                @csrf
                <input class="form-control" type="text" name="nome" value="{{$prof->nome}}" required>
                <input class="form-control" type="text" name="graduacao" value="{{$prof->graduacao}}" required>
                <button class="btn btn-primary" type="submit">Salvar</button>
            </form>
        </div>
    </div>
</div>
@endsection