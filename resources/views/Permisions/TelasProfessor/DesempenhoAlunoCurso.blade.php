@extends('layouts.basico')

@section('titulo', 'HomeProfessor')

@section('conteudo')
    <h3 class="mt-5">Painel do professor> Curso > Alunos </h3>
    <div>
        <h6 class="text-center mt-4">Aqui vai ficar os dados do aluno(Criar a tabela e relacionamento)</h6>
    </div>
    <div class="d-flex justify-content-between mt-5">
        <div>
            <a href="{{route('atividadesAluno.professor',['Aluno'=>$Aluno,'IDCurso'=>$IDCurso,'IDProfessor'=>$IDProfessor])}}">
                Atividades
            </a>
        </div>
        <div>
            <a href="{{route('CursosAluno.professor',['Aluno'=>$Aluno,'IDCurso'=>$IDCurso,'IDProfessor'=>$IDProfessor])}}">
                Cursos
            </a>
        </div>
        <div>
            <a href="{{route('ProgressoAluno.professor',['Aluno'=>$Aluno,'IDCurso'=>$IDCurso,'IDProfessor'=>$IDProfessor])}}">
                Progresso
            </a>
        </div>
        <div>
            <a href="{{route('TarefasAluno.professor',['Aluno'=>$Aluno,'IDCurso'=>$IDCurso,'IDProfessor'=>$IDProfessor])}}">
                Tarefas
            </a>
        </div>
    </div>

    <h6 class="text-center mt-5">Atividades </h6>
    <table class="text-center">
        <thead>
        <tr>
            <th class="p-4">data</th>
            <th class="p-4">Disciplina</th>
            <th class="p-4">Tipo atividade</th>
            <th class="p-4">Atividade</th>
            <th class="p-4">Acertos (%)</th>
            <th class="p-4">Tempo de realização</th>
        </tr>

        </thead>
        <tbody>
        @foreach($alunos as $aluno)
            <tr>
                <td class="p-4">
                </td>
                <td class="p-4">
                    <a>
                       cfdfvdf
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
