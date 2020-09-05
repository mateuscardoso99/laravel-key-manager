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
					      	<button class="btn btn-primary">Detalhes</button>
					      	<form action="{{route('aula.delete',$aula->id)}}"
					      	method="post">
					      		@method('delete')
					      		@csrf
					      		<button class="btn btn-danger">Apagar</button>
					      	</form>
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