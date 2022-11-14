@extends('layouts.basico')

@section('titulo', 'HomeProfessor')

@section('conteudo')
    <h4>Bem-vindo de volta {{$professor->st_nome_professor}}</h4>
    <div>
        <a class="me-5" href="{{route('vizualizarCursos.Professor',['IDProfessor'=>$professor->id])}}">
            vizualizar cursos
        </a>
        <br>
        <a class="me-5" href="{{route('vizualizarTodosAlunos.Professor',['IDProfessor'=>$professor->id])}}">
            Vizualizar alunos que eu coordeno
        </a>
    </div>

    <div>
        Home professor
    </div>

@endsection
