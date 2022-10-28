@extends('layouts.basico')

@section('titulo', 'vizualizar questões')

@section('conteudo')
    <a href="{{route('vizualizar.conteudo',['conteudo'=>$dados[0]->fk_conteudo_pertencente])}}">
        voltar para o cronograma
    </a>

    <table class="mb-5 mt-5">
        <tr class="border12">
            <th class="border12">Nome do Conteudo</th>
            <th class="border12">Quantidade de questões</th>
            <th class="border12">excluir</th>
        </tr>
        @foreach($dados as $dado)
            <tr class="border12">
                <td class="border12">
                    {{$dado->conteudos->st_nome_conteudo}}
                </td>
                <td class="border12">
                    {{$dado->totalQuestao}}
                </td>

                <td class="border12">
                    <form id="form_{{$dado->id}}" method="post" action="{{route('delete.ConteudoTesteFinalCurso',['IDexclusao'=>$dado->id, 'dadosconteudo'=>$dado->fk_conteudo_pertencente])}}">
                        @method('DELETE')
                        @csrf
                        <a class="linkedel" href="#" onclick="document.getElementById('form_{{$dado->id}}').submit()">
                            excluir
                        </a>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <a href="{{route('edit.ConteudoTesteFinalCurso',['dadosconteudo'=>$dado->fk_conteudo_pertencente, 'fkCurso'=>$dado->fk_curso])}}">
        Editar Teste Final do Curso
    </a>

@endsection
