@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{route('chave.store')}}" method="post">
            	@csrf
            	<input class="form-control" type="text" name="sala" required>
                <select name="sel_porteiros" required>
                    @foreach($porteiros as $pt)
                        <option value="{{$pt->id}}">{{$pt->nome}}</option>
                    @endforeach
                </select>
            	<button class="btn btn-primary" type="submit">Salvar</button>
            </form>
        </div>
    </div>
</div>
@endsection