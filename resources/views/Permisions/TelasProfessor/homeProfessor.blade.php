@extends('layouts.basico')

@section('titulo', 'HomeProfessor')

@section('conteudo')
    <div class="flexHomeProfessor mt-2">
        <h4 class="h4Pets mt-3 ">
            Bem-vindo de volta, {{$professor->st_nome_professor}}  !
        </h4>
        <a href="{{route('inicio.pagina')}}" class="btnVoltar">
            Voltar
        </a>
    </div>

    <h2 class="text-center my-5 h4Pets">
        Selecione uma opção
    </h2>

    <div class=" d-flex justify-content-center ">
        <a class="linkHomeProfessor me-5" href="{{route('vizualizarCursos.Professor',['IDProfessor'=>$professor->id])}}">
            Vizualizar cursos
        </a>
        <br>
        <a class="linkHomeProfessor" href="{{route('vizualizarTodosAlunos.Professor',['IDProfessor'=>$professor->id])}}">
            Vizualizar alunos
        </a>
    </div>

@endsection
