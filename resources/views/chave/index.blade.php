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
					      	<form action="{{route('chave.delete',$ch->id)}}"
					      	method="post">
					      		@method('delete')
					      		@csrf
					      		<button class="btn btn-danger">Apagar</button>
					      	</form>
			            	<a class="btn btn-success" href="{{route('chave.edit',$ch->id)}}">Atualizar</a>
					      </td>
					    </tr>
					  </tbody>
	            @endforeach
        	</table>

        	{{ $chaves->links() }}

             <a class="btn btn-primary" href="{{route('chave.create')}}">
                Cadastrar chave
            </a>
        </div>
    </div>
</div>
@endsection