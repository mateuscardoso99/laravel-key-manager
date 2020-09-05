@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{route('porteiro.store')}}" method="post">
            	@csrf
            	 <div class="form-group">
				    <label for="nome">Nome</label>
				    <input type="text" name="nome" class="form-control" placeholder="Nome" id="nome" required>
				 </div>
            	
            	<button class="btn btn-primary" type="submit">Salvar</button>
            </form>
        </div>
    </div>
</div>
@endsection