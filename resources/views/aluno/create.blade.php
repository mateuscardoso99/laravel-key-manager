@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{route('aluno.store')}}" method="post">
            	@csrf

                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" class="form-control" placeholder="Nome" id="nome" required>
                </div>

                <div class="form-group">
                    <label for="curso">Curso</label>
                    <input type="text" name="curso" class="form-control" placeholder="Curso" id="curso" required>
                </div>

                <div class="form-group">
                    <label for="sel_professores">Professor responsável</label>
                    <select class="form-control" name="sel_professores" id="sel_professores" required>
                      @foreach($profs as $prof)
                        <option value="{{$prof->id}}">{{$prof->nome}}</option>
                      @endforeach
                    </select>
                </div>

            	<button class="btn btn-primary" type="submit">Salvar</button>
            </form>
        </div>
    </div>
</div>
@endsection