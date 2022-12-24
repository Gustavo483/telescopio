@extends('layouts.basico')

@section('titulo', 'Trofeus')

@section('conteudo')

    <div class="flexPAluno mt-3 ">
        <h4 class="h4Pets">
            Painal do Aluno > Troféus
        </h4>
        <a href="{{route('inicio.pagina')}}" class="btnVoltar">
            Voltar
        </a>
    </div>

    <div class="d-flex justify-content-center mt-5">
        @if($verificador == 0)
            @foreach($trofeusConquistados as $trofeusConquita)
                <div class="tamanhoDivtrofeus ms-5">
                    <img src="images/{{$trofeusConquita[3] }}" class="mb-2 xczxc" style="width:170px; height:180px;">
                    <div class="text-center conquistado2 py-1">
                        {{$trofeusConquita[5] }}
                    </div>
                    <div class="conquistado">
                        <div class="text-center">
                            Complete {{$trofeusConquita[1]}} cursos de {{$trofeusConquita[0]}}
                        </div>
                        <div class="p-2 mt-1">
                            <p class="text-center">{{$trofeusConquita[1]}}/ {{$trofeusConquita[2]}}</p>
                            100%
                        </div>
                    </div>
                </div>
            @endforeach

            @foreach($trofeusEmAbertosComPorcentagem as $trofeusConquita)
                <div class="tamanhoDivtrofeus ms-5">
                    <img src="images/{{$trofeusConquita[3] }}" class="mb-2" style="width:170px; height:180px;">
                    <div class="text-center sdfsd py-1">
                        {{$trofeusConquita[5] }}
                    </div>
                    <div class="colorBlack">
                        <div class="text-center">
                            Complete {{$trofeusConquita[1]}} cursos de {{$trofeusConquita[0]}}
                        </div>
                        <div class="p-2 mt-1">
                            <p>{{$trofeusConquita[1]}}/ {{$trofeusConquita[2]}}</p>
                            porcentagem: {{$trofeusConquita[4]}}
                        </div>
                    </div>
                </div>
            @endforeach

            @foreach($TodosTrofeus as $Trofeu)
                @if(! in_array($Trofeu->id,$idTrofeusConquistados) and ! in_array($Trofeu->id,$idTrofeusNaoConquistados))
                    <div class="tamanhoDivtrofeus ms-5">
                        <img src="images/{{$Trofeu->st_caminho_img}}" class="mb-2" style="width:170px; height:180px;">
                        <div class="text-center sdfsd py-1">
                            {{$Trofeu->st_nome_trofeu}}
                        </div>
                        <div class="colorBlack">
                            <div class="text-center">
                                Complete {{$Trofeu->int_total_atividades}} cursos de {{$Trofeu->disciplinas->st_nome_disciplina}}
                            </div>
                            <div class="p-2 mt-1">
                                <p>0/ {{$Trofeu->int_total_atividades}}</p>
                                porcentagem: 0%
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif

        @if($verificador != 0)
            @foreach($TodosTrofeus as $Trofeu)
                <div class="tamanhoDivtrofeus ms-5">
                    <img src="images/{{$Trofeu->st_caminho_img}}" class="mb-2" style="width:170px; height:180px;">
                    <div class="text-center sdfsd py-1">
                        {{$Trofeu->st_nome_trofeu}}
                    </div>
                    <div class="colorBlack">
                        <div class="text-center pt-1">
                            Complete {{$Trofeu->int_total_atividades}} cursos de {{$Trofeu->disciplinas->st_nome_disciplina}}
                        </div>
                        <div class="p-2 mt-1">
                            <div>
                                porcentagem: 0%
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        @endif

    </div>
@endsection
