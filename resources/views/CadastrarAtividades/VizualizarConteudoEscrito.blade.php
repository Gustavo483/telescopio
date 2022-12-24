@extends('layouts.basico')

@section('titulo', 'vizualizar questões')

@section('conteudo')
    <div class="flexPAluno mt-3 ">
        <h4 class="h4Pets">
            Painal do Administrador > Unidades > Conteudos > Vizualizar atividade escrita
        </h4>
        <a class="btnVoltar" href="{{route('vizualizar.conteudo',['conteudo'=>$dadosconteudo])}}">
            Voltar
        </a>
    </div>
    <h3 class=" mt-5 h4Pets text-center">
        Vizualização do conteudo {{$dadosconteudo->st_nome_conteudo}} da unidade {{$dadosconteudo->unidades->st_nome_unidade}}
    </h3>

    <div class="mostrarTexto2 mt-5 mb-2">
        <a class="btnVoltar" href="{{route('EditarTextoAtividade', ['textoEscrito'=>$textoEscrito,'dadosconteudo'=>$dadosconteudo])}}">
            Editar texto
        </a>
    </div>

    <div class="mostrarTexto mb-5">
        {!! $textoEscrito->st_texto !!}
    </div>
@endsection
