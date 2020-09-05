@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        	<table class="table table-striped table-dark">
	        	<thead>
				    <tr>
				      <th scope="col">Sala</th>
				      <th scope="col">Porteiro Responsável</th>
				      <th scope="col">Opções</th>
				    </tr>
			    </thead>
	        	@foreach($chaves as $ch)
	            	<tbody>
					    <tr>
					      <td>{{$ch->sala}}</td>
					      <td>{{$ch->porteiro->nome}}</td>
					      <td>
					      		@if($ch->situacao === 'liberada')
					      			<a class="btn btn-success" href="{{route('chave.manager',$ch->id)}}">Liberar</a>
					      		@else
					      			<a class="btn btn-warning" href="{{route('chave.manager',$ch->id)}}">Devolver</a>
					      		@endif


                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$ch->id}}">
                          Apagar
                      </button>

                    <!-- Modal -->
                          <div class="modal fade" id="delete{{$ch->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: #212529;">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Atenção</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body text-center">
                                  Deseja apagar essa chave?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar
                                  </button>
                                  <form action="{{route('chave.delete',$ch->id)}}"
                                  method="post">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger">Apagar</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
			            	
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#update{{$ch->id}}">
                      Atualizar
                    </button>
                        <!-- Modal update-->
                    <div class="modal fade" id="update{{$ch->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="color: #212529;">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">

                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Atualizar chave</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>

                          <div class="modal-body">
                              <form action="{{route('chave.update',$ch->id)}}" method="post">
                              @method('put')
                              @csrf

                              <div class="form-group">
                                  <label for="sala">Sala</label>
                                  <input type="text" name="sala" class="form-control" value="{{$ch->sala}}" placeholder="Sala" id="sala" required>
                              </div>

                              <div class="form-group">
                                  <label for="sel_porteiros">Porteiro responsável</label>
                                  <select class="form-control" name="sel_porteiros" id="sel_porteiros" required>
                                    @foreach($porteiros as $pt)
                                      @if($pt->id === $ch->id_porteiro)
                                          <option value="{{$pt->id}}" selected>{{$pt->nome}}</option>
                                      @else
                                          <option value="{{$pt->id}}">{{$pt->nome}}</option>
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

        	{{ $chaves->links() }}

             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
			  Cadastrar chave
			</button> 

        </div>
    </div>
</div>
@endsection

<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Nova chave</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
         <form action="{{route('chave.store')}}" method="post">
            	@csrf

                <div class="form-group">
                    <label for="sala">Sala</label>
                    <input type="text" name="sala" class="form-control" placeholder="Sala" id="sala" required>
                </div>

                <div class="form-group">
                    <label for="sel_porteiros">Porteiro responsável</label>
                    <select class="form-control" name="sel_porteiros" id="sel_porteiros" required>
                      @foreach($porteiros as $pt)
                        <option value="{{$pt->id}}">{{$pt->nome}}</option>
                      @endforeach
                    </select>
                </div>

            	<button class="btn btn-primary" type="submit">Salvar</button>
            </form>
      </div>
    </div>
  </div>
</div>