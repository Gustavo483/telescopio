@extends('layouts.basicoProfessor')

@section('titulo', 'Histórico')
@section('infoPágina', 'Painel do professor > '.$Aluno->st_nome_aluno.' > Tarefas')

@section('conteudo')
    <h5 class="text-center mt-5">Tarefas do aluno nos cursos cadastrados"</h5>

    <div class="fdvdd">
        <div>
            {{ $errors->has('QuantidadeAtividades') ? $errors->first('QuantidadeAtividades') : '' }}
        </div>
        <div>
            {{ $errors->has('data') ? $errors->first('data') : '' }}
        </div>
    </div>

    <div>
        <table id="tableTarefa" class="w-100 mt-4 mb-5">
            <thead>
            <tr>
                <th class="text-center p-1">Curso</th>
                <th class="text-center p-1">Atividades</th>
                <th class="text-center p-1">Prazo</th>
                <th class="text-center p-1">Status</th>
                <th class="text-center p-1">Estrelas obtidas</th>
                <th class="text-center p-1">Excluir</th>
            </tr>
            </thead>
            <thead>
            @foreach($dadosTarefas as $tarefa)
                <tr>
                    <td class="text-center p-1">{{$tarefa->cursos->st_nome_curso}}</td>
                    <td class="text-center p-1">{{$tarefa->conteudos->st_nome_conteudo}}</td>
                    <td class="text-center p-1">{{$tarefa->data}}</td>
                    <td class="text-center p-1">
                        @if($tarefa->submit_atividade == 0)
                            Não realizou
                        @endif
                        @if($tarefa->submit_atividade == 1)
                            realizou
                        @endif
                        @if($tarefa->submit_atividade == 3)
                            Data excedida
                        @endif
                    </td>
                    <td class="text-center p-1">{{$tarefa->int_estrelas_obtidas}}</td>
                    <td class="text-center p-1">
                        <form id="form_{{$tarefa->id}}" method="post" action="{{route('deleteTarefaAluno2.professor',['Aluno'=>$Aluno,'IDProfessor'=>$IDProfessor,'IDTarefa'=>$tarefa->id])}}">
                            @method('DELETE')
                            @csrf
                            <a class="linkedel" href="#" onclick="document.getElementById('form_{{$tarefa->id}}').submit()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                </svg>
                            </a>
                        </form>
                    </td>
                </tr>
            @endforeach
            </thead>
        </table>
    </div>
@endsection
