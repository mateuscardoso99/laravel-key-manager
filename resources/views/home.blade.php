@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Gerencie chaves de salas de aula</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Cadastre, edite, exclua, manipule professores, 
                    alunos, porteiros, chaves e aulas, gerencie suas aulas veja quem pegou determinada chave, quem é o responsável por ela, quando devolveu e muito mais e veja relatórios do uso das chaves.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
