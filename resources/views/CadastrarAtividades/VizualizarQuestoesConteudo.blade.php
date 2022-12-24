@extends('layouts.basico')

@section('titulo', 'vizualizar questões')

@section('conteudo')
    <div class="flexPAluno mt-3 ">
        <h4 class="h4Pets">
            Painal do Administrador > Unidades > Conteudos > Vizualização Questões
        </h4>
        <a class="btnVoltar" href="{{route('vizualizar.conteudo',['conteudo'=>$dadosconteudo->id])}}">
            Voltar
        </a>
    </div>


    <h3 class=" mt-5 h4Pets text-center">
        questões do curso {{$dadosconteudo->st_nome_conteudo}}
    </h3>

    <div class="my-5">
        <table id="myTable" class="mb-5 mt-5">
            <thead>
            <tr class="border12">
                <th class="border12">tipo ativide</th>
                <th class="border12">banca da atividade</th>
                <th class="border12">pergunta Atividade</th>
                <th class="border12">editar</th>
                <th class="border12">excluir</th>
            </tr>
            </thead>
            <tbody>
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
                            <a href="{{route('editar.QuestaoME',['IDQuestao'=>$questao->id])}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                            </a>
                        @endif
                        @if($questao->st_tipoDeQuestao == 'questaoRB')
                            <a href="{{route('editar.QuestaoRB',['IDQuestao'=>$questao->id])}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                            </a>
                        @endif
                        @if($questao->st_tipoDeQuestao == 'questaoRN')
                            <a href="{{route('editar.QuestaoRN',['IDQuestao'=>$questao->id])}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                            </a>
                        @endif
                    </td>

                    <td class="border12">
                        <form id="form_{{$questao->id}}" method="post" action="{{route('delete.QuestaoConteudo',['IDQuestao'=>$questao->id])}}">
                            @method('DELETE')
                            @csrf
                            <a class="linkedel" href="#" onclick="document.getElementById('form_{{$questao->id}}').submit()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </a>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

    </div>

@endsection
