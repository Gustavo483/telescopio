@extends('layouts.basicoProfessor')

@section('titulo', 'Histórico')
@section('infoPágina', 'Painel do professor > '.$IDCurso->st_nome_curso.' > '.$Aluno->st_nome_aluno.' > historico')

@section('conteudo')

    <div class="flexas2 mb-5">
        <table id="table2" class="text-center mb-5">
            <thead>
                <tr>
                    <th class="p-4">data</th>
                    <th class="p-4">Curso</th>
                    <th class="p-4">Tipo atividade</th>
                    <th class="p-4">conteudo</th>
                    <th class="p-4">Acertos (%)</th>
                    <th class="p-4">Tempo (min)</th>
                </tr>
            </thead>
            <tbody>
            @foreach($historicos as $historico)
                <tr>
                    <td class="p-4">{{date_format($historico->created_at,"d/m/Y  H:i")}}</td>
                    <td class="p-4">{{$historico->cursos->st_nome_curso}}</td>
                    <td class="p-4">{{$historico->st_tipo_atividade}}</td>
                    <td class="p-4">{{$historico->conteudos->st_nome_conteudo}}</td>
                    <td class="p-4">{{$historico->int_acertos}}</td>
                    <td class="p-4">{{$historico->int_tempo_execucao}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
