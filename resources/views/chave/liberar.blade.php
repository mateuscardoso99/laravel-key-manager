@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{route('chave.iniciar',$chave->id)}}" method="post">
            	@csrf
            	<input class="form-control" type="text" name="sala" value="{{$chave->sala}}" readonly>

                <input class="form-control" type="text" name="data" required="">

                <select name="sel_professores">
                    <option value="">Nenhum</option>
                    @foreach($professores as $prof)
                        <option value="{{$prof->id}}">{{$prof->nome}}</option>
                    @endforeach
                </select>

                <select name="sel_alunos">
                    <option value="">Nenhum</option>
                    @foreach($alunos as $al)
                        <option value="{{$al->id}}">{{$al->nome}}</option>
                    @endforeach
                </select>

                <select name="sel_porteiros" required>
                    <option value="">Nenhum</option>
                    @foreach($porteiros as $pt)
                        <option value="{{$pt->id}}">{{$pt->nome}}</option>
                    @endforeach
                </select>

            	<button class="btn btn-primary" type="submit">Iniciar aula</button>
            </form>
        </div>
    </div>
</div>
@endsection