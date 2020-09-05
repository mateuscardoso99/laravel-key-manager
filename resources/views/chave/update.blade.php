@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{route('chave.update',$chave->id)}}" method="post">
                @method('put')
                @csrf

                <div class="form-group">
                    <label for="sala">Sala</label>
                    <input type="text" name="sala" class="form-control" value="{{$chave->sala}}" placeholder="Sala" id="sala" required>
                </div>

                <div class="form-group">
                    <label for="sel_porteiros">Porteiro responsável</label>
                    <select class="form-control" name="sel_porteiros" id="sel_porteiros" required>
                      @foreach($porteiros as $pt)
                        @if($pt->id === $chave->id_porteiro)
                            <option value="{{$pt->id}}" selected>{{$pt->nome}}</option>
                        @else
                            <option value="{{$pt->id}}">{{$pt->nome}}</option>
                        @endif
                      @endforeach
                    </select>
                </div>

                <button class="btn btn-primary" type="submit">Salvar</button>
            </form>
        </div>
    </div>
</div>
@endsection