@extends('layouts.basico')

@section('titulo', 'HomeAluno')

@section('conteudo')
    <div class="d-flex justify-content-center">
        <div class="tamanho1">
            <div>
                @foreach($nomeConteudo0 as $NomeConteudo)
                    <div>
                        {{$NomeConteudo}}
                        @foreach($PrimeiroDadoParaApresentar as $dados)
                            <div class="ms-5">
                                <a href="{{route('Aluno.MostrarExercicio',['IdAluno'=>$dados[0],'idConteudo'=>$dados[1],'IdCronograma'=>$dados[6],'tipoAtividade'=>$dados[5]])}}">
                                    {{$dados[5]}}
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>

            <div>
                @foreach($NomesConteudos as $NomeConteudo)
                    <div>
                        {{$NomeConteudo}}
                        @foreach($DadosParaApresentar as $dados)
                            @if($dados[2] == $NomeConteudo)
                                @if($dados[7] == 0)
                                    <div class="ms-5">
                                        <span>
                                            {{$dados[5]}}
                                        </span>
                                    </div>
                                @endif
                                @if($dados[7] != 0)
                                    <div class="ms-5">
                                        <a href="{{route('Aluno.MostrarExercicio',['IdAluno'=>$dados[0],'idConteudo'=>$dados[1],'IdCronograma'=>$dados[6],'tipoAtividade'=>$dados[5]])}}">
                                            {{$dados[5]}}
                                        </a>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
        <div class="tamanho2">
            <div class="text-center">
                dsfdf
            </div>
        </div>
    </div>
@endsection
