@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h3>Chaves devolvidas por alunos</h3>
        	<table class="table table-striped table-dark">
	        	<thead>
				    <tr>
				      <th scope="col">Sala</th>
				      <th scope="col">Aluno</th>
				      <th scope="col">Início</th>
                      <th scope="col">Fim</th>
				    </tr>
			    </thead>
	        	@foreach($aulasdealunos as $al)
	            	<tbody>
					    <tr>
					      <td>{{$al->chave->sala}}</td>
					      <td>{{$al->aluno->nome}}</td>
					      <td>{{$al->data_inicio}}</td>
                          <td>{{$al->data_fim}}</td>
					    </tr>
					  </tbody>
	            @endforeach
        	</table>

            <h3>Chaves devolvidas por professores</h3>
            <table class="table table-striped table-dark">
	        	<thead>
				    <tr>
                      <th scope="col">Sala</th>
				      <th scope="col">Professor</th>
				      <th scope="col">Início</th>
                      <th scope="col">Fim</th>
				    </tr>
			    </thead>
	        	@foreach($aulasdeprofs as $pf)
	            	<tbody>
					    <tr>
                          <td>{{$pf->chave->sala}}</td>
					      <td>{{$pf->professor->nome}}</td>
					      <td>{{$pf->data_inicio}}</td>
                          <td>{{$pf->data_fim}}</td>
					    </tr>
					  </tbody>
	            @endforeach
        	</table>

            <h3>Chaves devolvidas por alunos e professores</h3>
            <table class="table table-striped table-dark">
	        	<thead>
				    <tr>
                      <th scope="col">Sala</th>
				      <th scope="col">Aluno</th>
                      <th scope="col">Professor</th>
				      <th scope="col">Início</th>
                      <th scope="col">Fim</th>
				    </tr>
			    </thead>
	        	@foreach($all as $al)
	            	<tbody>
					    <tr>
                          <td>{{$al->chave->sala}}</td>
					      <td>{{$al->aluno->nome}}</td>
                          <td>{{$al->professor->nome}}</td>
					      <td>{{$al->data_inicio}}</td>
                          <td>{{$al->data_fim}}</td>
					    </tr>
					  </tbody>
	            @endforeach
        	</table>

        </div>
    </div>
</div>
@endsection