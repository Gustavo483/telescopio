@extends('layouts.basico')

@section('titulo', 'HomeAluno')

@section('conteudo')
    <div class="text-center mt-5">
        olá, {{$IdAluno->st_nome_aluno}}
    </div>
    <div class="d-flex justify-content-between mt-5">

        <div>
            <div>
                img. Pets
            </div>
            <div>
                {{$ConquitasAlunos->int_total_pets}}
            </div>
        </div>
        <div>
            <div>
                img. Caderno
            </div>
            <div>
                {{$ConquitasAlunos->int_total_cursos_concluidos}}
            </div>
        </div>
        <div>
            <div>
                img.troveu
            </div>
            <div>
                {{$ConquitasAlunos->int_total_trofeus}}
            </div>
        </div>
        <div>
            <div>
                img. revisao
            </div>
            <div>
                {{$ConquitasAlunos->int_revisoes}}
            </div>
        </div>
        <div>
            <div>
                img. estrelas
            </div>
            <div>
                {{$ConquitasAlunos->int_total_estrelas}}
            </div>
        </div>
    </div>


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
