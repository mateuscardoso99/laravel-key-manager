@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h3>Chaves livres</h3>
        	<table class="table table-striped table-dark">
	        	<thead>
				    <tr>
				      <th scope="col">Sala</th>
				      <th scope="col">Porteiro responsável</th>
				    </tr>
			    </thead>
	        	@foreach($chavesliberadas as $ch)
	            	<tbody>
					    <tr>
					      <td>{{$ch->sala}}</td>
					      <td>{{$ch->porteiro->nome}}</td>
					    </tr>
					  </tbody>
	            @endforeach
        	</table>

            <h3>Chaves ocupadas</h3>
            <table class="table table-striped table-dark">
	        	<thead>
				    <tr>
                      <th scope="col">Sala</th>
				      <th scope="col">Responsável</th>
				    </tr>
			    </thead>
	        	@foreach($chavesocupadas as $ch)
	            	<tbody>
					    <tr>
                          <td>{{$ch->chave->sala}}</td>
                          @if($ch->professor && $ch->aluno)
					      	<td>{{$ch->professor->nome}}
					      		e {{$ch->aluno->nome}}
					      	</td>
					      @elseif($ch->professor)
					      	<td>{{$ch->professor->nome}}</td>
					      @else
					      	<td>{{$ch->aluno->nome}}</td>
					      @endif
					    </tr>
					  </tbody>
	            @endforeach
        	</table>

        </div>
    </div>
</div>
@endsection