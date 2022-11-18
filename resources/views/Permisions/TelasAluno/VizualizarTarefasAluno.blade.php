@extends('layouts.basico')

@section('titulo', 'Trofeus')

@section('conteudo')
    <div class="mt-3">
        <table>
            <thead>
                <tr>
                    <th class="w-50 text-center">Info.</th>
                    <th class="w-25 text-center">Data Para Realização</th>
                    <th class="w-25"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($TarefasCadastras as $tarefa)
                    <tr>
                        <td class="text-center">O professor {{$tarefa->professores->st_nome_professor}} cadastrou uma atividade do curso {{$tarefa->cursos->st_nome_curso}} para voçê.</td>
                        <td class="text-center">{{$tarefa->data}}</td>
                        <td class="text-center">
                            <a href="{{route('direcionarAlunoParaTarefa',['DatosTarefa'=>$tarefa])}}" class="">
                                Realizar Tarefa
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
