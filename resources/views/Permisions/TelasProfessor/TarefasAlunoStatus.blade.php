@extends('layouts.basico')

@section('titulo', 'HomeProfessor')

@section('conteudo')
    <h3 class="mt-5">Painel do professor> {{$IDCurso->st_nome_curso}} > {{$Aluno->st_nome_aluno}} </h3>
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

    <h5 class="text-center mt-5">Tarefas do aluno no curso "{{$IDCurso->st_nome_curso}}"</h5>

    <div class="fdvdd">
        <div>
            {{ $errors->has('QuantidadeAtividades') ? $errors->first('QuantidadeAtividades') : '' }}
        </div>
        <div>
            {{ $errors->has('data') ? $errors->first('data') : '' }}
        </div>
    </div>

    <div>
        <table class="w-100 mt-4">
            <thead>
            <tr>
                <th class="text-center">Curso</th>
                <th class="text-center">Atividades</th>
                <th class="text-center">Prazo</th>
                <th class="text-center">Status</th>
                <th class="text-center">Estrelas obtidas</th>
                <th class="text-center">Excluir</th>
            </tr>
            </thead>
            <thead>
            @foreach($dadosTarefas as $tarefa)
                <tr>
                    <td class="text-center">{{$tarefa->cursos->st_nome_curso}}</td>
                    <td class="text-center">{{$tarefa->conteudos->st_nome_conteudo}}</td>
                    <td class="text-center">{{$tarefa->data}}</td>
                    <td class="text-center">
                        @if($tarefa->submit_atividade == 0)
                            Não realizou
                        @endif
                        @if($tarefa->submit_atividade != 0)
                            realizou
                        @endif
                    </td>
                    <td class="text-center">{{$tarefa->int_estrelas_obtidas}}</td>
                    <td class="text-center">
                        <form id="form_{{$tarefa->id}}" method="post" action="{{route('deleteTarefaAluno.professor',['Aluno'=>$Aluno,'IDCurso'=>$IDCurso,'IDProfessor'=>$IDProfessor,'IDTarefa'=>$tarefa->id])}}">
                            @method('DELETE')
                            @csrf
                            <a class="linkedel" href="#" onclick="document.getElementById('form_{{$tarefa->id}}').submit()">
                                del
                            </a>
                        </form>
                    </td>
                </tr>
            @endforeach
            </thead>
        </table>
    </div>

@endsection
