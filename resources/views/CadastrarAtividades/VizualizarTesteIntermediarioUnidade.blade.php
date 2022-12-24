@extends('layouts.basico')

@section('titulo', 'vizualizar questões')

@section('conteudo')
    <div class="flexPAluno mt-3 ">
        <h4 class="h4Pets">
            Painal do Administrador > Unidades > Conteudos > vizualizar teste intermediario da unidade
        </h4>
        <a class="btnVoltar" href="{{route('vizualizar.conteudo',['conteudo'=>$dados[0]->fk_conteudo_pertencente])}}">
            Voltar
        </a>
    </div>

    <h3 class=" mt-5 h4Pets text-center">
        Relação de conteudos para o teste intermediario da unidade {{$dadosconteudo->unidades->st_nome_unidade}}
    </h3>

    <a class="btnVoltar5 my-5 text-center" href="{{route('edit.ConteudoTesteIntermediario',['dadosconteudo'=>$dadosconteudo])}}">
        Editar teste
    </a>

    <table id="myTable" class="mb-5 mt-5">
        <thead>
            <tr class="border12">
                <th class="border12">Nome do Conteudo</th>
                <th class="border12">Quantidade de questões</th>
                <th class="border12">excluir</th>
            </tr>
        </thead>
        <tbody>
        @foreach($dados as $dado)
            <tr class="border12">
                <td class="border12">
                    {{$dado->conteudos->st_nome_conteudo}}
                </td>
                <td class="border12">
                    {{$dado->totalQuestao}}
                </td>

                <td class="border12">
                    <form id="form_{{$dado->id}}" method="post" action="{{route('delete.ConteudoTesteIntermediario',['IDexclusao'=>$dado->id, 'dadosconteudo'=>$dado->fk_conteudo_pertencente])}}">
                        @method('DELETE')
                        @csrf
                        <a class="linkedel" href="#" onclick="document.getElementById('form_{{$dado->id}}').submit()">
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
@endsection
