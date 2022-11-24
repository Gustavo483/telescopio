@extends('layouts.basico')

@section('titulo', 'HomeAdmin')

@section('conteudo')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

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

    <div class="mt-4">
        <a href="{{route('CadastrarTrofeus')}}">
            trofeus Cadastrados
        </a>
    </div>
    <div class="mt-4">
        <a href="{{route('revisaoForma')}}">
            forma de revisao
        </a>
    </div>

    <div>
        <a href="{{route('vizualizarPets')}}">
            Pets Cadastrados
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
