@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <a class="btn btn-primary" href="{{route('chave.situacao')}}">
                Situação das chaves
            </a>

            <a class="btn btn-success" href="{{route('chave.devolucao')}}">
                Relatório geral de chaves devolvidas
            </a>
            
        </div>
    </div>
</div>
@endsection