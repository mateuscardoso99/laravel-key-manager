@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        	<table class="table table-striped table-dark">
	        	<thead>
				    <tr>
				      <th scope="col">Nome</th>
				      <th scope="col">Graduação</th>
				      <th scope="col">Opções</th>
				    </tr>
			    </thead>
	        	@foreach($profs as $pf)
	            	<tbody>
					    <tr>
					      <td>{{$pf->nome}}</td>
					      <td>{{$pf->graduacao}}</td>
					      <td>
					      	<form action="{{route('professor.alterar',$pf->id)}}"
					      	method="post">
					      		@method('put')
					      		@csrf
					      		@if($pf->situacao === 'ativado')
					      			<button  class="btn btn-warning" type="submit">Desativar</button>
					      		@else
					      			<button  class="btn btn-warning" type="submit">Ativar</button>
					      		@endif
					      	</form>

					      	<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$pf->id}}">
			                    Apagar
			                </button>

			              <!-- Modal -->
			                    <div class="modal fade" id="delete{{$pf->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: #212529;">
			                      <div class="modal-dialog modal-dialog-centered" role="document">
			                        <div class="modal-content">
			                          <div class="modal-header">
			                            <h5 class="modal-title" id="exampleModalLabel">Atenção</h5>
			                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                              <span aria-hidden="true">&times;</span>
			                            </button>
			                          </div>
			                          <div class="modal-body text-center">
			                            Deseja apagar esse professor?
			                          </div>
			                          <div class="modal-footer">
			                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar
			                            </button>
			                            <form action="{{route('professor.delete',$pf->id)}}"
								      	method="post">
								      		@method('delete')
								      		@csrf
								      		<button type="submit" class="btn btn-danger">Apagar</button>
								      	</form>
			                          </div>
			                        </div>
			                      </div>
			                    </div>

					      	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#update{{$pf->id}}">
		                      Atualizar
		                    </button>
		                        <!-- Modal update-->
		                    <div class="modal fade" id="update{{$pf->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="color: #212529;">
		                      <div class="modal-dialog modal-dialog-centered" role="document">
		                        <div class="modal-content">

		                          <div class="modal-header">
		                            <h5 class="modal-title" id="exampleModalLongTitle">Atualizar professor</h5>
		                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                              <span aria-hidden="true">&times;</span>
		                            </button>
		                          </div>

		                          <div class="modal-body">
		                            <form action="{{route('professor.update',$pf->id)}}" method="post">
						                @method('put')
						                @csrf

						                <div class="form-group">
						                    <label for="nome">Nome</label>
						                    <input type="text" name="nome" class="form-control" value="{{$pf->nome}}" placeholder="Nome" id="nome" required>
						                </div>

						                <div class="form-group">
						                    <label for="graduacao">Graduação</label>
						                    <input type="text" name="graduacao" class="form-control" value="{{$pf->graduacao}}" placeholder="Graduação" id="graduacao" required>
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

        	{{ $profs->links() }}

        	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
			  Cadastrar professor
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
        <h5 class="modal-title" id="exampleModalLongTitle">Novo professor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
         <form action="{{route('professor.store')}}" method="post">
            	@csrf
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" class="form-control" placeholder="Nome" id="nome" required>
                </div>

                <div class="form-group">
                    <label for="graduacao">Graduação</label>
                    <input type="text" name="graduacao" class="form-control" placeholder="Graduação" id="graduacao" required>
                </div>

            	<button class="btn btn-primary" type="submit">Salvar</button>
            </form>
      </div>
    </div>
  </div>
</div>