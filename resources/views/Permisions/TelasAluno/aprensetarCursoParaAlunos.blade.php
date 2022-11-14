@extends('layouts.basico')

@section('titulo', 'HomeAluno')

@section('conteudo')

    <div class="d-flex justify-content-center">
        <div class="tamanho1">
            <div>
                @for($i = 0; $i < $contadorUnidades; $i++)
                    <div>
                        <h5>{{$IDsUnidades[$i]->st_nome_unidade}}</h5>
                    </div>
                    <div>
                        @foreach($nomeConteudo0 as $NomeConteudo)
                            @if($i == 0)
                                <div class="ps-3">
                                    {{$NomeConteudo}}
                                    @foreach($PrimeiroDadoParaApresentar as $dados)
                                        <div class="ms-5">
                                            <a href="{{route('Aluno.MostrarExercicio',['IdAluno'=>$dados[0],'idConteudo'=>$dados[1],'IdCronograma'=>$dados[6],'tipoAtividade'=>$dados[5], 'IdCurso'=>$IdCurso ])}}">
                                                {{$dados[5]}}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div>
                        @foreach($DadosConteudos as $NomeConteudo)
                            @if($IDsUnidades[$i]->id == $NomeConteudo->fk_unidade and $NomeConteudo->st_nome_conteudo != $nomeConteudo0[0] )
                                <div class="ps-3">
                                    {{$NomeConteudo->st_nome_conteudo}}
                                    @foreach($DadosParaApresentar as $dados)
                                        @if($dados[2] == $NomeConteudo->st_nome_conteudo and $NomeConteudo->fk_unidade == $dados[8])
                                            @if($dados[7] == 0)
                                                <div class="ms-5">
                                                <span>
                                                    {{$dados[5]}}
                                                </span>
                                                </div>
                                            @endif
                                            @if($dados[7] != 0)
                                                <div class="ms-5">
                                                    <a href="{{route('Aluno.MostrarExercicio',['IdAluno'=>$dados[0],'idConteudo'=>$dados[1],'IdCronograma'=>$dados[6],'tipoAtividade'=>$dados[5], 'IdCurso'=>$IdCurso ])}}">
                                                        {{$dados[5]}}
                                                    </a>
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endfor

            </div>
        </div>
        <div class="tamanho2">
            <div class="text-center">
                dsfdf
            </div>
        </div>
    </div>
@endsection
