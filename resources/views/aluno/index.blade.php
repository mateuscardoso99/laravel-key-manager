@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        	<table class="table table-striped table-dark">
	        	<thead>
				    <tr>
				      <th scope="col">Nome</th>
				      <th scope="col">Curso</th>
				      <th scope="col">Professor Responsável</th>
				      <th scope="col">Opções</th>
				    </tr>
			    </thead>
	        	@foreach($alunos as $al)
	            	<tbody>
					    <tr>
					      <td>{{$al->nome}}</td>
					      <td>{{$al->curso}}</td>
					      <td>{{$al->professor->nome}}</td>
					      <td>
					      	<form action="{{route('aluno.alterar',$al->id)}}"
					      	method="post">
					      		@method('put')
					      		@csrf
					      		@if($al->situacao === 'ativado')
					      			<button class="btn btn-warning" type="submit">Desativar</button>
					      		@else
					      			<button class="btn btn-warning" type="submit">Ativar</button>
					      		@endif
					      	</form>

                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$al->id}}">
                    Apagar
                  </button>

              <!-- Modal -->
                    <div class="modal fade" id="delete{{$al->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: #212529;">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Atenção</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body text-center">
                            Deseja apagar esse aluno?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar
                            </button>
                           <form action="{{route('aluno.delete',$al->id)}}"
                            method="post">
                              @method('delete')
                              @csrf
                              <button type="submit" class="btn btn-danger">Apagar</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

			            	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#update{{$al->id}}">
                      Atualizar
                    </button>
                        <!-- Modal update-->
                    <div class="modal fade" id="update{{$al->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="color: #212529;">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">

                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Atualizar aluno</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>

                          <div class="modal-body">
                             <form action="{{route('aluno.update',$al->id)}}" method="post">
                              @method('put')
                              @csrf

                              <div class="form-group">
                                  <label for="nome">Nome</label>
                                  <input type="text" name="nome" class="form-control" value="{{$al->nome}}" placeholder="Nome" id="nome" required>
                              </div>

                              <div class="form-group">
                                  <label for="curso">Curso</label>
                                  <input type="text" name="curso" class="form-control" value="{{$al->curso}}" placeholder="Curso" id="curso" required>
                              </div>

                              <div class="form-group">
                                  <label for="sel_professores">Professor responsável</label>
                                  <select class="form-control" name="sel_professores" id="sel_professores" required>
                                    @foreach($profs as $prof)
                                      @if($prof->id === $al->id_professor)
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
                    </div>
					      </td>
					    </tr>
					  </tbody>
	            @endforeach
        	</table>

        	{{ $alunos->links() }}

             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
			         Cadastrar aluno
			       </button>

             @foreach($errors->all() as $message)
                <div class="alert alert-danger text-center mt-3" role="alert">
                    <strong>{{$message}}</strong>
                </div>
              @endforeach

        </div>
    </div>
</div>
@endsection

<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Novo aluno</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
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
</div>