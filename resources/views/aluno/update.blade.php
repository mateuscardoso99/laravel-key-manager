@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{route('aluno.update',$aluno->id)}}" method="post">
                @method('put')
                @csrf
                <input class="form-control" type="text" name="nome" value="{{$aluno->nome}}" required>
                <input class="form-control" type="text" name="curso" value="{{$aluno->curso}}" required>
                <select name="sel_professores" required>
                    @foreach($profs as $prof)
                        @if($prof->id === $aluno->id_professor)
                            <option value="{{$prof->id}}" selected>{{$prof->nome}}</option>
                        @else
                            <option value="{{$prof->id}}">{{$prof->nome}}</option>
                        @endif
                    @endforeach
                </select>
                <button class="btn btn-primary" type="submit">Salvar</button>
            </form>
        </div>
    </div>
</div>
@endsection