@extends('layouts.basico')

@section('titulo', 'HomeAdmin')

@section('conteudo')

    <div>
        <a class="me-5" href="{{route('registerAluno')}}">
            cadastrar novo aluno
        </a>

        <a class="me-5" href="/registerProfessor">
            cadastrar novo professor
        </a>

        <a class="me-5" href="/AlunoCurso">
            vincular aluno e curso
        </a>

        <a class="me-5" href="{{route('ProfessorCurso')}}">
            vincular Professor e curso
        </a>

        <a class="me-5" href="{{route('listarAlunosCursos')}}">
            listarAlunosCursos
        </a>

        <a class="me-5" href="{{route('listarprofessoresCursos')}}">
            listarProfessorCursos
        </a>

    </div>

    <div class="mt-5">
        <a href="{{route('curso.index')}}">
            cursos
        </a>
    </div>
    <div class="mt-5">
        <a href="{{route('unidade.index')}}">
            unidade
        </a>
    </div>

@endsection
