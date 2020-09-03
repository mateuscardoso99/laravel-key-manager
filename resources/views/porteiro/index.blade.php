@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        	<table class="table table-striped table-dark">
	        	<thead>
				    <tr>
				      <th scope="col">Nome</th>
				      <th scope="col">Opções</th>
				    </tr>
			    </thead>
	        	@foreach($porteiros as $pt)
	            	<tbody>
					    <tr>
					      <td>{{$pt->nome}}</td>
					      <td>
					      	<form action="{{route('porteiro.alterar',$pt->id)}}"
					      	method="post">
					      		@method('put')
					      		@csrf
					      		@if($pt->situacao === 'ativado')
					      			<button type="submit">Desativar</button>
					      		@else
					      			<button type="submit">Ativar</button>
					      		@endif
					      	</form>
					      	<form action="{{route('porteiro.delete',$pt->id)}}"
					      	method="post">
					      		@method('delete')
					      		@csrf
					      		<button>Apagar</button>
					      	</form>
			            	<a href="{{route('porteiro.edit',$pt->id)}}">Atualizar</a>
					      </td>
					    </tr>
					  </tbody>
	            @endforeach
        	</table>

             <a href="{{route('porteiro.create')}}">
                Cadastrar porteiro
            </a>
        </div>
    </div>
</div>
@endsection