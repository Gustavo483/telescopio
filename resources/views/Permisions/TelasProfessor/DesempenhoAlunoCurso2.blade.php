@extends('layouts.basico')

@section('titulo', 'HomeProfessor')

@section('conteudo')
    <h3 class="mt-5">Painel do professor > desempenho aluno</h3>
    <div class="d-flex justify-content-between">
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
    <div class="d-flex justify-content-between mt-5">
        <div>
            <a href="{{route('atividadesAluno2.professor',['Aluno'=>$Aluno,'IDProfessor'=>$IDProfessor])}}">
                Atividades
            </a>
        </div>
        <div>
            <a href="{{route('CursosAluno2.professor',['Aluno'=>$Aluno,'IDProfessor'=>$IDProfessor])}}">
                Cursos
            </a>
        </div>
        <div>
            <a href="{{route('ProgressoAluno2.professor',['Aluno'=>$Aluno,'IDProfessor'=>$IDProfessor])}}">
                Progresso
            </a>
        </div>
        <div>
            <a href="{{route('TarefasAluno2.professor',['Aluno'=>$Aluno,'IDProfessor'=>$IDProfessor])}}">
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
