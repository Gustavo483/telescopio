@extends('layouts.basico')

@section('titulo', 'HomeAluno')

@section('conteudo')
    <div class="d-flex justify-content-center mt-5">
        @foreach($dadosAlunosCursos as $dadoAlunoCurso)
            <div class="me-5">
                <a href="{{route('Aluno.vizualizarCurso',['IdAluno'=>$IdAluno,'IdCurso'=>$dadoAlunoCurso->id])}}">
                    <div class="text-center">
                        {{$dadoAlunoCurso->id}}
                    </div>
                    <div class="text-center">
                        {{$dadoAlunoCurso->st_nome_curso}}
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
