@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{route('professor.update',$prof->id)}}" method="post">
                @method('put')
                @csrf

                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" class="form-control" value="{{$prof->nome}}" placeholder="Nome" id="nome" required>
                </div>

                <div class="form-group">
                    <label for="graduacao">Graduação</label>
                    <input type="text" name="graduacao" class="form-control" value="{{$prof->graduacao}}" placeholder="Graduação" id="graduacao" required>
                </div>

                <button class="btn btn-primary" type="submit">Salvar</button>
            </form>
        </div>
    </div>
</div>
@endsection