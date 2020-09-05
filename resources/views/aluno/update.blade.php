@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{route('aluno.update',$aluno->id)}}" method="post">
                @method('put')
                @csrf

                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" class="form-control" value="{{$aluno->nome}}" placeholder="Nome" id="nome" required>
                </div>

                <div class="form-group">
                    <label for="curso">Curso</label>
                    <input type="text" name="curso" class="form-control" value="{{$aluno->curso}}" placeholder="Curso" id="curso" required>
                </div>

                <div class="form-group">
                    <label for="sel_professores">Professor responsável</label>
                    <select class="form-control" name="sel_professores" id="sel_professores" required>
                      @foreach($profs as $prof)
                        @if($prof->id === $aluno->id_professor)
                            <option value="{{$prof->id}}" selected>{{$prof->nome}}</option>
                        @else
                            <option value="{{$prof->id}}">{{$prof->nome}}</option>
                        @endif
                      @endforeach
                    </select>
                </div>

                <button class="btn btn-primary" type="submit">Salvar</button>
            </form>
        </div>
    </div>
</div>
@endsection