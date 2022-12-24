@extends('layouts.basico2')

@section('titulo', 'Teste conteudo')

@section('conteudo2')
    <div class="flex1 mt-4 mb-2">
        <div id="materia " class="gray">
            <h3> {{$DadosConteudo->unidades->st_nome_unidade}} / {{$DadosConteudo->st_nome_conteudo}}</h3>
        </div>
    </div>
    <div id="Questoeszxz" class="conteinerBody">
        <div>
            <!--formulario questão -->
            @foreach($Atividades as $atividade)
                @if ($atividade->id == $Atividades[0]->id)
                    @if($atividade->st_tipoDeQuestao == 'questaoME')
                        <div id="div_questao_id_{{$atividade->id}}" class=" " >
                            <div>
                                <p class="my-2 perguntaQuestao">
                                    {!! $atividade->st_pergunta !!}
                                </p>
                            </div>
                            <div class="inputQuestoes"></div>
                            @if($atividade->st_alternativa1 != null)
                                <div class="d-flex justify-content-star inputQuestoes">
                                    <input class="pe-2" type="checkbox" name="questao_id{{$atividade->id}}" value="st_alternativa1"/>
                                    <label class="py-1 ps-3">
                                        {!! $atividade->st_alternativa1 !!}
                                    </label>
                                </div>
                            @endif

                            @if($atividade->st_alternativa2 != null)
                                <div class="d-flex justify-content-star inputQuestoes">
                                    <input class="pe-2" type="checkbox" name="questao_id{{$atividade->id}}" value="st_alternativa2" />
                                    <label class="py-1 ps-3">
                                        {!! $atividade->st_alternativa2 !!}
                                    </label>
                                </div>
                            @endif

                            @if($atividade->st_alternativa3 != null)
                                <div class="d-flex justify-content-star inputQuestoes">
                                    <input class="pe-2" type="checkbox" name="questao_id{{$atividade->id}}" value="st_alternativa3" />
                                    <label class="py-1 ps-3">
                                        {!! $atividade->st_alternativa3 !!}
                                    </label>
                                </div>
                            @endif

                            @if($atividade->st_alternativa4 != null)
                                <div class="d-flex justify-content-star inputQuestoes">
                                    <input class="" type="checkbox" name="questao_id{{$atividade->id}}" value="st_alternativa4" />
                                    <label class="py-1 ps-3">
                                        {!! $atividade->st_alternativa4 !!}
                                    </label>
                                </div>
                            @endif

                            @if($atividade->st_alternativa5 != null)
                                <div class="d-flex justify-content-star inputQuestoes">
                                    <input class="pe-2" type="checkbox" name="questao_id{{$atividade->id}}" value="st_alternativa5" />
                                    <label class="py-1 ps-3">
                                        {!! $atividade->st_alternativa5 !!}
                                    </label>
                                </div>
                            @endif

                            <div id="ajuda_id_{{$atividade->id}}" class="mt-5 none">
                                <h5>Resolução da atividade</h5>
                                <div>
                                    {!! $atividade->st_resolusao!!}
                                </div>
                            </div>

                            <div id="div_resposta{{$atividade->id}}" class="mt-5 none">{!! $atividade->st_gabarito!!}</div>

                        </div>
                    @endif

                    @if($atividade->st_tipoDeQuestao == 'questaoRB')
                        <div id="div_questao_id_{{$atividade->id}}" class=" " >
                            <div>
                                <p class="my-2 perguntaQuestao">
                                    {!! $atividade->st_pergunta !!}
                                </p>
                            </div>
                            <div>
                                <input class="form-control" id="resposta_aluno{{$atividade->id}}" type="text" name="respostaAluno" placeholder="Digite sua resposta">
                            </div>

                            <div id="ajuda_id_{{$atividade->id}}" class="mt-5 none">
                                <h5>Resolução da atividade</h5>
                                <div>
                                    {!! $atividade->st_resolusao!!}
                                </div>
                            </div>
                            <div id="div_resposta{{$atividade->id}}" class="mt-5 none">{!! $atividade->st_gabarito!!}</div>
                        </div>
                    @endif

                    @if($atividade->st_tipoDeQuestao == 'questaoRN')
                        <div id="div_questao_id_{{$atividade->id}}" class=" ">
                            <div>
                                <p class="my-2 perguntaQuestao">
                                    {!! $atividade->st_pergunta !!}
                                </p>
                            </div>
                            <div>
                                <input class="form-control" id="resposta_aluno{{$atividade->id}}" type="number" name="respostaAluno" placeholder="Digite sua resposta">
                            </div>

                            <div id="ajuda_id_{{$atividade->id}}" class="mt-5 none">
                                <h5>Resolução da atividade</h5>
                                <div>
                                    {!! $atividade->st_resolusao!!}
                                </div>
                            </div>
                            <div id="div_resposta{{$atividade->id}}" class="mt-5 none">{!! $atividade->st_gabarito!!}</div>
                        </div>
                    @endif
                @endif




                @if ($atividade->id != $Atividades[0]->id)
                    @if($atividade->st_tipoDeQuestao == 'questaoME')
                        <div id="div_questao_id_{{$atividade->id}}" class="none" >
                            <div>
                                <p class="my-2 perguntaQuestao">
                                    {!! $atividade->st_pergunta !!}
                                </p>
                            </div>
                            <div class="inputQuestoes"></div>
                            @if($atividade->st_alternativa1 != null)
                                <div class="d-flex justify-content-star inputQuestoes">
                                    <input class="pe-2" type="checkbox" name="questao_id{{$atividade->id}}" value="st_alternativa1"/>
                                    <label class="py-1 ps-3">
                                        {!! $atividade->st_alternativa1 !!}
                                    </label>
                                </div>
                            @endif

                            @if($atividade->st_alternativa2 != null)
                                <div class="d-flex justify-content-star inputQuestoes">
                                    <input class="pe-2" type="checkbox" name="questao_id{{$atividade->id}}" value="st_alternativa2" />
                                    <label class="py-1 ps-3">
                                        {!! $atividade->st_alternativa2 !!}
                                    </label>
                                </div>
                            @endif

                            @if($atividade->st_alternativa3 != null)
                                <div class="d-flex justify-content-star inputQuestoes">
                                    <input class="pe-2" type="checkbox" name="questao_id{{$atividade->id}}" value="st_alternativa3" />
                                    <label class="py-1 ps-3">
                                        {!! $atividade->st_alternativa3 !!}
                                    </label>
                                </div>
                            @endif

                            @if($atividade->st_alternativa4 != null)
                                <div class="d-flex justify-content-star inputQuestoes">
                                    <input class="" type="checkbox" name="questao_id{{$atividade->id}}" value="st_alternativa4" />
                                    <label class="py-1 ps-3">
                                        {!! $atividade->st_alternativa4 !!}
                                    </label>
                                </div>
                            @endif

                            @if($atividade->st_alternativa5 != null)
                                <div class="d-flex justify-content-star inputQuestoes">
                                    <input class="pe-2" type="checkbox" name="questao_id{{$atividade->id}}" value="st_alternativa5" />
                                    <label class="py-1 ps-3">
                                        {!! $atividade->st_alternativa5 !!}
                                    </label>
                                </div>
                            @endif

                            <div id="ajuda_id_{{$atividade->id}}" class="mt-5 none">
                                <h5>Resolução da atividade</h5>
                                <div>
                                    {!! $atividade->st_resolusao!!}
                                </div>
                            </div>
                            <div id="div_resposta{{$atividade->id}}" class="mt-5 none">{!! $atividade->st_gabarito!!}</div>
                        </div>
                    @endif


                    @if($atividade->st_tipoDeQuestao == 'questaoRB')
                        <div id="div_questao_id_{{$atividade->id}}" class="none" >
                            <div>
                                <p class="my-2 perguntaQuestao">
                                    {!! $atividade->st_pergunta !!}
                                </p>
                            </div>
                            <div>
                                <input class="form-control" id="resposta_aluno{{$atividade->id}}" type="text" name="respostaAluno" placeholder="Digite sua resposta">
                            </div>

                            <div id="ajuda_id_{{$atividade->id}}" class="mt-5 none">
                                <h5>Resolução da atividade</h5>
                                <div>
                                    {!! $atividade->st_resolusao!!}
                                </div>
                            </div>
                            <div id="div_resposta{{$atividade->id}}" class="mt-5 none">{!! $atividade->st_gabarito!!}</div>
                        </div>
                    @endif

                    @if($atividade->st_tipoDeQuestao == 'questaoRN')
                        <div id="div_questao_id_{{$atividade->id}}" class=" none">
                            <div>
                                <p class="my-2 perguntaQuestao">
                                    {!! $atividade->st_pergunta !!}
                                </p>
                            </div>
                            <div>
                                <input class="form-control" id="resposta_aluno{{$atividade->id}}" type="number" name="respostaAluno" placeholder="Digite sua resposta">
                            </div>

                            <div id="ajuda_id_{{$atividade->id}}" class="mt-5 none">
                                <h5>Resolução da atividade</h5>
                                <div>
                                    {!! $atividade->st_resolusao!!}
                                </div>
                            </div>
                            <div id="div_resposta{{$atividade->id}}" class="mt-5 none">{!! $atividade->st_gabarito!!}</div>
                        </div>
                    @endif
                @endif
            @endforeach
            <!--Fim formulario questão -->
        </div>
    </div>
    <div id="DivResultado" class="cdcdsdssa none">
        <div id="tresEstrelas" class=" mt-3 none">
            <div class="gfdfgdf">
                <div class="parabens mb-4">Parabéns, Você obteve três estrelas !!!</div>
                <div class="dadosasa">
                    <div class="tresEstrelas1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="130" height="130" fill="#3574cf" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                    </div>
                    <div class="tresEstrelas2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="130" height="130" fill="#3574cf" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                    </div>
                    <div class="tresEstrelas3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="130" height="130" fill="#3574cf" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div id="duasestrelas" class="mt-3 none">
            <div class="gfdfgdf">
                <div class="parabens mb-4">Parabéns, Você obteve duas estrelas !!!</div>
                <div class="dadosasa">
                    <div class="tresEstrelas1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="130" height="130" fill="#3574cf" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                    </div>
                    <div class="tresEstrelas2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="130" height="130" fill="#3574cf" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                    </div>
                    <div class="tresEstrelas3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="130" height="130" fill="#3574cf" class="bi bi-star" viewBox="0 0 16 16">
                            <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div id="umaestrelas" class="mt-3 none">
            <div class="gfdfgdf">
                <div class="parabens mb-4">Parabéns, Você obteve uma estrelas !!!</div>
                <div class="dadosasa">
                    <div class="tresEstrelas1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="130" height="130" fill="#3574cf" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                    </div>
                    <div class="tresEstrelas2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="130" height="130" fill="#3574cf" class="bi bi-star" viewBox="0 0 16 16">
                            <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                        </svg>
                    </div>
                    <div class="tresEstrelas3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="130" height="130" fill="#3574cf" class="bi bi-star" viewBox="0 0 16 16">
                            <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div id="zeroEstrelas" class="mt-3 none">
            <div class="gfdfgdf">
                <div class="parabens mb-4">Não desanime, você vai conseguir!!!</div>
                <div class="dadosasa">
                    <div class="tresEstrelas1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="130" height="130" fill="#3574cf" class="bi bi-star" viewBox="0 0 16 16">
                            <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                        </svg>
                    </div>
                    <div class="tresEstrelas2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="130" height="130" fill="#3574cf" class="bi bi-star" viewBox="0 0 16 16">
                            <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                        </svg>
                    </div>
                    <div class="tresEstrelas3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="130" height="130" fill="#3574cf" class="bi bi-star" viewBox="0 0 16 16">
                            <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="dccsdc"></div>
    <div class="d123">
        <div class="hrquestoes "></div>
        <div class="">
            <div class="">
                <div class="flex69">
                    <div class="">
                        @for($i = 0; $i < count($idsAtividades); $i++)
                            <div id="DivRespondeuErrado{{$Atividades[$i]->id}}" class="divRelative  none">
                                <div class="divErro1 ">
                                    <div class="flex2 ">
                                        <div class="boxTextos">
                                            <h6 class="boxTextos">Você está quase lá</h6>
                                            <div class="font ">
                                                <span onclick="tentarNovamente('{{$Atividades[$i]->id}}')"  id="tentarNovamente{{$Atividades[$i]->id}}" class="tentarNovamente">Tente de novo,</span>
                                                <span onclick="ObterAjuda('{{$Atividades[$i]->id}}')"   id="ObterAjudaBtn{{$Atividades[$i]->id}}" class="tentarNovamente">Obter ajuda</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center absolutSeta">
                                    <svg class="_10uuq40" width="35" height="28"><filter id="uid-feedback-popover-4-dropshadow"><feOffset  result="offsetblur"></feOffset><feGaussianBlur in="SourceAlpha" stdDeviation="2"></feGaussianBlur><feComponentTransfer><feFuncA type="linear" slope="0.1"></feFuncA></feComponentTransfer><feMerge><feMergeNode></feMergeNode><feMergeNode in="SourceGraphic"></feMergeNode></feMerge></filter><polyline fill="#3574cf" points="0,0 10,12 20,0" stroke="rgba(0, 0, 0, 0.1)" filter="url(#uid-feedback-popover-4-dropshadow"></polyline></svg>
                                </div>
                            </div>

                            <div id="divPaginacaoNormal">
                                @if($i == 0)
                                    <button onclick="verificarAcerto('{{$Atividades[0]->st_tipoDeQuestao}}',{{$Atividades[0]->id}},{{$jsonsd}},'{{$tipoAtividade}}')" id="btn_verificacao{{$Atividades[0]->id}}" class="button1" >
                                        Verificar
                                    </button>
                                @endif

                                @if($i > 0)
                                    <button onclick="verificarAcerto('{{$Atividades[$i]->st_tipoDeQuestao}}',{{$Atividades[$i]->id}},{{$jsonsd}},'{{$tipoAtividade}}')" id="btn_verificacao{{$Atividades[$i]->id}}" class="button1 none" >
                                        Verificar
                                    </button>
                                @endif
                            </div>
                            <div>
                                <button id="ResultadoAtividade" onclick="enviarFormulario()" class="button1 none">
                                    Salvar Progresso
                                </button>
                            </div>
                        @endfor

                    </div>
                    <div id="botoesProgresso1">
                        @for($i = 0; $i < count($idsAtividades); $i++)
                            @if($i == 0)
                                <button id="btn_questao_{{$idsAtividades[$i]}}" class="bolapaginacao  bgFocus"> {{$i + 1}}</button>
                            @endif

                            @if($i != 0)
                                <button id="btn_questao_{{$idsAtividades[$i]}}" class="bolapaginacao  SemResposta"> {{$i + 1}}</button>
                            @endif
                        @endfor
                    </div>
                    <div id="botoesProgresso2" class="none">
                        @for($i = 0; $i < count($idsAtividades); $i++)
                            <button id="btn_questao_final_{{$idsAtividades[$i]}}" onclick="AbrirQuestao({{$idsAtividades[$i]}})" class="bolapaginacao"> {{$i + 1}}</button>
                        @endfor
                    </div>
                </div>

                <div id="VerificarSeRespondeuTudo" class="text-center mt-2 none">
                    <form method="post" action="{{ route('Aluno.SalvarProgresso',['IdAluno'=>$IdAluno, 'idConteudo'=>$IdConteudo, 'IdCurso'=>$IdCurso,'tipoAtividade'=>$tipoAtividade])}}">
                        @csrf
                        <input id="input_int_estrela_obtida" type="text" class="form-control" name="int_estrela_obtida" value="">
                        <input id= "input_int_acertos" type="text" class="form-control" name="int_acertos" value="">
                        <input id="input_int_tempo_execucao" type="text" class="form-control" name="int_tempo_execucao" value="">
                        <button id="sub_formulario" type="submit" class="btn btn-lg btn-primary"> Submit </button>
                    </form>
                </div>

                <div id="VerificarSeRespondeuTudo" class="text-center mt-2 none">
                    <form method="post" action="{{ route('Aluno.SalvarAtividadeFizacao',['IdAluno'=>$IdAluno, 'idConteudo'=>$IdConteudo, 'IdCurso'=>$IdCurso,'tipoAtividade'=>$tipoAtividade])}}">
                        @csrf
                        <input id= "input_int_acertos2" type="text" class="form-control" name="int_acertos" value="">
                        <input id="input_int_tempo_execucao2" type="text" class="form-control" name="int_tempo_execucao" value="">
                        <button id="sub_formulario2" type="submit" class="btn btn-lg btn-primary"> Submit </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
