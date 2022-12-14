@extends('layouts.basico')

@section('titulo', 'Atividade FIzação')

@section('conteudo')
    @foreach($Atividades as $atividade)
        @if($atividade->st_tipoDeQuestao == 'questaoME')
            <div class="ddcd">
                <h4 class="text-center">{{$atividade->st_tipoDeQuestao}}</h4>
                <div>pergunta: {{$atividade->st_pergunta}}</div>
                <div>alternativa 1: {{$atividade->st_alternativa1}}</div>
                <div>alternativa 2: {{$atividade->st_alternativa2}}</div>
                <div>alternativa 3: {{$atividade->st_alternativa3}}</div>
                <div>alternativa 4: {{$atividade->st_alternativa4}}</div>
                <div>alternativa 5: {{$atividade->st_alternativa5}}</div>
                <div>resolucação: {{$atividade->st_resolusao}}</div>
            </div>
        @endif
        @if($atividade->st_tipoDeQuestao == 'questaoRB')
            <div class="ddcd">
                <h4 class="text-center">{{$atividade->st_tipoDeQuestao}}</h4>
                <div>pergunta: {{$atividade->st_pergunta}}</div>
                <div>resolução: {{$atividade->st_resolusao}}</div>
                <div>gabarito: {{$atividade->st_gabarito}}</div>
            </div>

        @endif
        @if($atividade->st_tipoDeQuestao == 'questaoRN')
            <div class="ddcd">
                <h4 class="text-center">{{$atividade->st_tipoDeQuestao}}</h4>
                <div>pergunta: {{$atividade->st_pergunta}}</div>
                <div>resolução: {{$atividade->st_resolusao}}</div>
                <div>gabarito: {{$atividade->st_gabarito}}</div>
            </div>
        @endif
    @endforeach
@endsection
