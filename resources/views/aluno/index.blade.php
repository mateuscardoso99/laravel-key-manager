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
					      			<button type="submit">Desativar</button>
					      		@else
					      			<button type="submit">Ativar</button>
					      		@endif
					      	</form>
					      	<form action="{{route('aluno.delete',$al->id)}}"
					      	method="post">
					      		@method('delete')
					      		@csrf
					      		<button>Apagar</button>
					      	</form>
			            	<a href="{{route('aluno.edit',$al->id)}}">Atualizar</a>
					      </td>
					    </tr>
					  </tbody>
	            @endforeach
        	</table>

             <a href="{{route('aluno.create')}}">
                Cadastrar aluno
            </a>
        </div>
    </div>
</div>
@endsection