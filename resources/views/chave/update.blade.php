@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{route('chave.update',$chave->id)}}" method="post">
                @method('put')
                @csrf
                <input class="form-control" type="text" name="sala" value="{{$chave->sala}}" required>
                <select name="sel_porteiros" required>
                    @foreach($porteiros as $pt)
                        @if($pt->id === $chave->id_porteiro)
                            <option value="{{$pt->id}}" selected>{{$pt->nome}}</option>
                        @else
                            <option value="{{$pt->id}}">{{$pt->nome}}</option>
                        @endif
                    @endforeach
                </select>
                <button class="btn btn-primary" type="submit">Salvar</button>
            </form>
        </div>
    </div>
</div>
@endsection