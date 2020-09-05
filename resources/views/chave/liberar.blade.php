@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{route('chave.iniciar',$chave->id)}}" method="post">
            	@csrf


                <div class="form-group">
                    <label for="sala">Sala</label>
                    <input type="text" name="sala" class="form-control" value="{{$chave->sala}}" placeholder="Sala" id="sala" readonly required>
                </div>

                <div class="form-group">
                    <label for="data">Data</label>
                    <input type="text" name="data" class="form-control" placeholder="d/m/y" id="data" required>
                </div>

                <div class="form-group">
                    <label for="sel_professores">Professor responsável</label>
                    <select class="form-control" name="sel_professores" id="sel_professores">
                      <option value="">Nenhum</option>
                      @foreach($professores as $prof)
                        <option value="{{$prof->id}}">{{$prof->nome}}</option>
                      @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="sel_alunos">Aluno responsável</label>
                    <select class="form-control" name="sel_alunos" id="sel_alunos">
                      <option value="">Nenhum</option>
                      @foreach($alunos as $al)
                        <option value="{{$al->id}}">{{$al->nome}}</option>
                      @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="sel_porteiros">Porteiro responsável</label>
                    <select class="form-control" name="sel_porteiros" id="sel_porteiros" required>
                      <option value="">Nenhum</option>
                      @foreach($porteiros as $pt)
                        <option value="{{$pt->id}}">{{$pt->nome}}</option>
                      @endforeach
                    </select>
                </div>

            	<button class="btn btn-primary" type="submit">Iniciar aula</button>
            </form>
        </div>
    </div>
</div>
@endsection