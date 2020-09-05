@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        	<table class="table table-striped table-dark">
	        	<thead>
				    <tr>
				      <th scope="col">Status</th>
				      <th scope="col">Chave</th>
				      <th scope="col">Opções</th>
				    </tr>
			    </thead>
	        	@foreach($aulas as $aula)
	            	<tbody>
					    <tr>
					      <td>{{$aula->status}}</td>
					      <td>{{$aula->chave->sala}}</td>
					      <td>

					      	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detalhes{{$aula->id}}">
                         		Detalhes
                      		</button>

                    <!-- Modal -->
                          <div class="modal fade" id="detalhes{{$aula->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: #212529;">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Informações da aula</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <h3>Data de início: {{$aula->data_inicio}}</h3>
                                  <h3>Data de término: {{$aula->data_fim}}</h3>

                                  <br>

                                  @if($aula->aluno && $aula->professor)
                                  	<h3>Aluno responsável: {{$aula->aluno->nome}}</h3>
                                  	<h3>Professor responsável: {{$aula->professor->nome}}</h3>
                                  @elseif($aula->aluno)
                                  	<h3>Aluno responsável: {{$aula->aluno->nome}}</h3>
                                  @else
                                  	<h3>Professor responsável: {{$aula->professor->nome}}</h3>
                                  @endif
                                  
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>

					      	<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$aula->id}}">
                         		Apagar
                      		</button>

                    <!-- Modal -->
                          <div class="modal fade" id="delete{{$aula->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: #212529;">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Atenção</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body text-center">
                                  Deseja apagar essa aula?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar
                                  </button>
                                  <form action="{{route('aula.delete',$aula->id)}}"
							      	method="post">
							      		@method('delete')
							      		@csrf
							      		<button class="btn btn-danger">Apagar</button>
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

        	{{ $aulas->links() }}

        </div>
    </div>
</div>
@endsection