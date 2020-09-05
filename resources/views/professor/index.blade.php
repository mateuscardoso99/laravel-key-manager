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
					      	<form action="{{route('professor.delete',$pf->id)}}"
					      	method="post">
					      		@method('delete')
					      		@csrf
					      		<button type="submit" class="btn btn-danger">Apagar</button>
					      	</form>
			            	<a class="btn btn-success" href="{{route('professor.edit',$pf->id)}}">Atualizar</a>
					      </td>
					    </tr>
					  </tbody>
	            @endforeach
        	</table>

        	{{ $profs->links() }}

             <a class="btn btn-primary" href="{{route('professor.create')}}">
                Cadastrar professor
            </a>
        </div>
    </div>
</div>
@endsection