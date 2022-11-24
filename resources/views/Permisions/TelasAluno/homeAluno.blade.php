@extends('layouts.basico')

@section('titulo', 'HomeAluno')

@section('conteudo')

    <div class="fsdcs mt-5">
        <div>
            olá, {{$IdAluno->st_nome_aluno}}
        </div>
        <div>
            @if($totalTarefas == 0)
                <a class="disabled link">
                    {{$totalTarefas}}
                    Tarefas
                </a>
            @endif
            @if($totalTarefas != 0)
                <a href="{{route('VizualizarTarefasAluno',['IdAluno'=>$IdAluno->id])}}" class="link ">
                    {{$totalTarefas}}
                    Tarefas
                </a>
            @endif
        </div>
    </div>
    <div class="d-flex justify-content-between mt-5">
        <div>
            <a href="{{route('VizualizarPetsAluno',['IdAluno'=>$IdAluno->id])}}" class="">
                <div class="linkPetsAluno">
                    <div class="text-center">
                        img. Pets
                    </div>
                    <div class="text-center">
                        {{$ConquitasAlunos->int_total_pets}}
                    </div>
                </div>
            </a>
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
            <a href="{{route('VizualizarTrofeusAluno',['IdAluno'=>$IdAluno->id])}}" class="">
                <div class="linkPetsAluno">
                    <div class="text-center">
                        img.troveu
                    </div>
                    <div class="text-center">
                        {{$totalTrofeus}}
                    </div>
                </div>
            </a>

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
