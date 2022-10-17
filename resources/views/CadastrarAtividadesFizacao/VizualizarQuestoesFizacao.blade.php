@extends('layouts.basico')

@section('titulo', 'vizualizar questões')

@section('conteudo')
    <a href="{{route('vizualizar.conteudo',['conteudo'=>$todasQuestoesConteudo[0]->fk_conteudo])}}">
        voltar
    </a>

    <table class="mb-5 mt-5">
        <tr class="border12">
            <th class="border12">tipo ativide</th>
            <th class="border12">banca da atividade</th>
            <th class="border12">pergunta Atividade</th>
            <th class="border12">editar</th>
            <th class="border12">excluir</th>
        </tr>

        @foreach($todasQuestoesConteudo as $questao)
            <tr class="border12">
                <td class="border12">
                    {{$questao->st_tipoDeQuestao}}
                </td>
                <td class="border12">
                    {{$questao->DadosBanca}}
                </td>
                <td class="border12">
                    <div>
                        {!!$questao->st_pergunta!!}
                    </div>
                </td>
                <td>
                    @if($questao->st_tipoDeQuestao == 'questaoME')
                        <a href="{{route('editar.QuestaoFZME',['IDQuestao'=>$questao->id])}}">editar</a>
                    @endif
                    @if($questao->st_tipoDeQuestao == 'questaoRB')
                        <a href="{{route('editar.QuestaoFZRB',['IDQuestao'=>$questao->id])}}">editar</a>
                    @endif
                    @if($questao->st_tipoDeQuestao == 'questaoRN')
                        <a href="{{route('editar.QuestaoFZRN',['IDQuestao'=>$questao->id])}}">editar</a>
                    @endif
                </td>
                <td class="border12">
                    <form id="form_{{$questao->id}}" method="post" action="{{route('delete.QuestaoFZ',['IDQuestao'=>$questao->id])}}">
                        @method('DELETE')
                        @csrf
                        <a class="linkedel" href="#" onclick="document.getElementById('form_{{$questao->id}}').submit()">
                            excluir
                        </a>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

@endsection
