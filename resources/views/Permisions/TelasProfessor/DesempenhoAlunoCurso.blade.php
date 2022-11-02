@extends('layouts.basico')

@section('titulo', 'HomeProfessor')

@section('conteudo')
    <h3 class="mt-5">Painel do professor> {{$IDCurso->st_nome_curso}}  > {{$Aluno->st_nome_aluno}} </h3>
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
            <th class="p-4">Curso</th>
            <th class="p-4">Tipo atividade</th>
            <th class="p-4">Atividade</th>
            <th class="p-4">Acertos (%)</th>
            <th class="p-4">Tempo (min)</th>
        </tr>

        </thead>
        <tbody>
        @foreach($historicos as $historico)
            <tr>
                <td class="p-4">{{$historico->created_at}}</td>
                <td class="p-4">{{$historico->st_nome_disciplina}}</td>
                <td class="p-4">{{$historico->cursos->st_nome_curso}}</td>
                <td class="p-4">{{$historico->st_tipo_atividade}}</td>
                <td class="p-4">{{$historico->conteudos->st_nome_conteudo}}</td>
                <td class="p-4">{{$historico->int_acertos}}</td>
                <td class="p-4">{{$historico->int_tempo_execucao}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
