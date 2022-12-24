@extends('layouts.basico')

@section('titulo', 'HomeProfessor')

@section('conteudo')
    <div class="flexPAluno mt-3 ">
        <h4 class="h4Pets">
            Painal do professor > Cursos
        </h4>
        <a href="{{route('inicio.pagina')}}" class="btnVoltar">
            Voltar
        </a>
    </div>
    <h4 class="text-center mt-5 h4Pets mb-4">Selecione o curso para vizualizar os alunos cadastrados</h4>
    <div class="d-flex justify-content-center">
        @foreach($dadosCursos as $curso)
            <div class="me-5 divCurso">
                <a class="linkCurso" href="{{route('vizualizarAlunosCadastradosNoCurso.Professor', ['IDCurso'=>$curso->id, 'IDProfessor'=>$IDProfessor])}}">
                    <img src="images/{{$curso->image }}" class="mb-2 imgCurso">
                    <div class="ps-2 divCurso2">
                        {{$curso->st_nome_disciplinas}}
                    </div>
                    <div class="ps-2 divCurso3 mb-2">
                        {{$curso->st_nome_curso}}
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
