@extends('layouts.basico')

@section('titulo', 'HomeProfessor')

@section('conteudo')
    <h1 class="text-center mt-5">Alunos que você vizualiza</h1>
    <h4 class="text-center mt-5">Selecione o aluno para ter mais informações</h4>
    <div class="d-flex justify-content-center">
        @foreach($DadosAlunos as $aluno)
            <div class="p-5">
                <a href="{{route('atividadesAluno2.professor',['Aluno'=>$aluno[0],'IDProfessor'=>$IDProfessor])}}">
                    {{$aluno[1]}}
                </a>
            </div>
        @endforeach
    </div>
@endsection
