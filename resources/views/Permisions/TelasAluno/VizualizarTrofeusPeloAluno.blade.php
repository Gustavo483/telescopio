@extends('layouts.basico')

@section('titulo', 'Trofeus')

@section('conteudo')
    <div class="d-flex justify-center">
        @if($verificador == 0)
            @foreach($trofeusConquistados as $trofeusConquita)
                <div class="tamanhoDiv ms-2">
                    <img src="images/{{$trofeusConquita[3] }}" class="mb-2" style="width:200px;height:250px;">
                    <div class="text-center sdfsd">
                        {{$trofeusConquita[5] }}
                    </div>
                    <div class="text-center">
                        Complete {{$trofeusConquita[1]}} cursos de {{$trofeusConquita[0]}}
                    </div>
                    <div>
                        <p>{{$trofeusConquita[1]}}/ {{$trofeusConquita[2]}}</p>
                        100%
                    </div>
                </div>
            @endforeach

            @foreach($trofeusEmAbertosComPorcentagem as $trofeusConquita)
                <div class="tamanhoDiv ms-2">
                    <img src="images/{{$trofeusConquita[3] }}" class="mb-2" style="width:200px;height:250px;">
                    <div class="text-center sdfsd">
                        {{$trofeusConquita[5] }}
                    </div>
                    <div class="text-center">
                        Complete {{$trofeusConquita[1]}} cursos de {{$trofeusConquita[0]}}
                    </div>
                    <div>
                        <p>{{$trofeusConquita[1]}}/ {{$trofeusConquita[2]}}</p>
                        porcentagem: {{$trofeusConquita[4]}}
                    </div>
                </div>
            @endforeach

            @foreach($TodosTrofeus as $Trofeu)
                @if(! in_array($Trofeu->id,$idTrofeusConquistados) and ! in_array($Trofeu->id,$idTrofeusNaoConquistados))
                    <div class="tamanhoDiv ms-2">
                        <img src="images/{{$Trofeu->st_caminho_img}}" class="mb-2" style="width:200px;height:250px;">
                        <div class="text-center sdfsd">
                            {{$Trofeu->st_nome_trofeu}}
                        </div>
                        <div class="text-center">
                            Complete {{$Trofeu->int_total_atividades}} cursos de {{$Trofeu->disciplinas->st_nome_disciplina}}
                        </div>
                        <div>
                            <p>0/ {{$Trofeu->int_total_atividades}}</p>
                            porcentagem: 0%
                        </div>
                    </div>
                @endif
            @endforeach
        @endif

        @if($verificador != 0)
            @foreach($TodosTrofeus as $Trofeu)

                <div class="tamanhoDiv ms-2">
                    <img src="images/{{$Trofeu->st_caminho_img}}" class="mb-2" style="width:200px;height:250px;">
                    <div class="text-center sdfsd">
                        {{$Trofeu->st_nome_trofeu}}
                    </div>
                    <div class="text-center">
                        Complete {{$Trofeu->int_total_atividades}} cursos de {{$Trofeu->disciplinas->st_nome_disciplina}}
                    </div>
                    <div>
                        <p>0/ {{$Trofeu->int_total_atividades}}</p>
                        porcentagem: 0%
                    </div>
                </div>
            @endforeach
        @endif

    </div>
@endsection
