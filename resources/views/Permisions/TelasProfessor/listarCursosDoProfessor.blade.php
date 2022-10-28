@extends('layouts.basico')

@section('titulo', 'HomeProfessor')

@section('conteudo')
    <h1 class="text-center mt-5">Cursos que você administra</h1>
    <h4 class="text-center mt-5">Selecione o curso para vizualizar os alunos cadastrados</h4>
    <div class="d-flex justify-content-center">
        @foreach($dadosCursos as $curso)
            <div class="p-5">
                <a href="{{route('vizualizarAlunosCadastradosNoCurso.Professor', ['IDCurso'=>$curso->id])}}">
                    {{$curso->st_nome_curso}}
                </a>
            </div>
        @endforeach
    </div>




@endsection
