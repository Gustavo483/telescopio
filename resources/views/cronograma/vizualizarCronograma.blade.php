@extends('layouts.basico')

@section('titulo', 'unidade')

@section('conteudo')
    <div class="flexPAluno mt-3 ">
        <h4 class="h4Pets">
            Painal do Administrador > unidades > {{$dadosconteudo->unidades->st_nome_unidade}}
        </h4>
        <a href="{{route('vizualizar.unidade',['unidade'=>$dadosconteudo->fk_unidade])}}" class="btnVoltar">
            Voltar
        </a>
    </div>

    <div class="d-flex mt-5">
        <button id="BtnCadastrarAtividadeConteudo" class="btnVoltar3" onclick="CadastrarAtividadeConteudo()">Cadastrar nova atividade</button>
    </div>

    <div id="DivApresentarAtividadeConteudo">
        <h3 class=" mt-5 h4Pets text-center">
            cronograma do conteudo {{$dadosconteudo->st_nome_conteudo}}
        </h3>

        <div>
            <table id="myTable" class="mb-5">
                <thead>
                <tr class="border12">
                    <th class="border12">Tipo ativide</th>
                    <th class="border12">Ordem de apresentação</th>
                    <th class="border12">Excluir atividade do cronograma</th>
                    <th class="border12">Vizualizar</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cronogramas as $Cronograma)
                    <tr class="border12">
                        <td class="border12">
                            {{$Cronograma->st_tipo_atividade}}
                        </td>
                        <td class="border12">
                            {{$Cronograma->st_ordem_apresentacao}}
                        </td>
                        @if($Cronograma->st_tipo_atividade == 'TEXTO')
                            <td>
                                <a href="{{route('vizualixarTextoEscrito',['dadosconteudo'=>$dadosconteudo,'idCronograma'=>$Cronograma->id])}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                    </svg>
                                </a>
                            </td>
                        @endif
                        @if($Cronograma->st_tipo_atividade == 'AtividadeFixacao')
                            <td>
                                <a href="{{route('vizualizar.TodasAtividadesFZ',['dadosconteudo'=>$dadosconteudo])}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                    </svg>
                                </a>
                            </td>
                        @endif
                        @if($Cronograma->st_tipo_atividade == 'testeConteudo')
                            <td>
                                <a href="{{route('vizualizar.TodasAtividades',['dadosconteudo'=>$dadosconteudo])}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                    </svg>
                                </a>
                            </td>
                        @endif

                        @if($Cronograma->st_tipo_atividade == 'Teste Intermediario')
                            <td>
                                <a href="{{route('vizualizar.atividadeIntermediarioUnidade',['dadosconteudo'=>$dadosconteudo])}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                    </svg>
                                </a>
                            </td>
                        @endif
                        @if($Cronograma->st_tipo_atividade == 'Teste Final Curso')
                            <td>
                                <a href="{{route('vizualizar.TesteFinalCurso',['dadosconteudo'=>$dadosconteudo])}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                    </svg>
                                </a>
                            </td>
                        @endif
                        @if($Cronograma->st_tipo_atividade == 'Teste Final')
                            <td>
                                <a href="{{route('vizualizar.atividadeFinalUnidade',['dadosconteudo'=>$dadosconteudo])}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                    </svg>
                                </a>
                            </td>
                        @endif
                        <td class="border12">
                            <form id="form_{{$Cronograma->id}}" method="post" action="{{route('delete.atividadeCronograma',['cronograma'=>$Cronograma->id])}}">
                                @method('DELETE')
                                @csrf
                                <a class="linkedel" href="#" onclick="document.getElementById('form_{{$Cronograma->id}}').submit()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
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
        <div class="mt-5">
            <h3 class=" mt-5 h4Pets text-center">
                Questões Cadastradas
            </h3>

        </div>

        <div class="my-5">
            <table id="myTable2" class="mb-5 mt-5 w-100">
                <thead>
                <tr class="border12">
                    <th class="border12">Tipo ativide</th>
                    <th class="border12">Total de questão do modelo</th>
                    <th class="border12">Adicionar nova atividade</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td class="border12">Multipla escolha</td>
                    <td class="border12">{{$arayQuantidade[0]}}</td>
                    <td class="border12">
                        <div class="d-flex justify-content-center">
                            <a class="btnVoltar5" href="{{route('criarQuestaoME.conteudo',['dadosconteudo'=>$dadosconteudo])}}">
                                cadastrar questão ME
                            </a>
                        </div>

                    </td>
                </tr>
                <tr>
                    <td class="border12">Resposta breve</td>
                    <td class="border12">{{$arayQuantidade[1]}}</td>
                    <td class="border12">
                        <div class="d-flex justify-content-center">
                            <a class="btnVoltar5" href="{{route('criarQuestaoRB.conteudo',['dadosconteudo'=>$dadosconteudo])}}">
                                cadastrar questão RB
                            </a>
                        </div>
                    </td>

                </tr>
                <tr>
                    <td class="border12">Resposta Numérica</td>
                    <td class="border12">{{$arayQuantidade[2]}}</td>
                    <td class="border12">
                        <div class="d-flex justify-content-center">
                            <a class=" btnVoltar5" href="{{route('criarQuestaoRN.conteudo',['dadosconteudo'=>$dadosconteudo])}}">
                                cadastrar questão RN
                            </a>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="border12">Questão de fização</td>
                    <td class="border12">{{$arayQuantidade[3]}}</td>
                    <td class="border12">
                        <div class="d-flex justify-content-center">
                            <a class=" btnVoltar5" href="{{route('criarQuestaoFZ.conteudo',['dadosconteudo'=>$dadosconteudo])}}">
                                Cadastrar questões FZ
                            </a>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div id="DivCadastrarAtividadeConteudo" class="none">
        <div class="flexRegisterAluno2 mb-5">
            <div class="FormCadastro">
                <form class="" method="post" action="{{route('cronograma.store',['dadosconteudo'=>$dadosconteudo])}}">
                    @csrf
                    <div class="hsd2">
                        <h4>Adicionar nova atividade para o {{$dadosconteudo->st_nome_conteudo}}</h4>
                    </div>
                    <div class="p-2">
                        <div class="">
                            <label class="form-label mt-2 " for="st_nome_conteudo">  Selecione o tipo de atividade:</label>
                            <select id="select1"  name="TipoAtividade" class="form-control">
                                <option value="ConteudoEscrito">Conteúdo Escrito</option>
                                <option value="AtividadeFixacao">Atividade de Fixação</option>
                                <option value="testeConteudo">teste do conteudo</option>
                                <option value="TesteIntermediario">teste Intermediarios da unidade</option>
                                <option value="testeFinalUnidade">teste Final da unidade</option>
                                <option value="testeFinalCurso">teste Final do curso</option>
                            </select>
                        </div>

                        <div class="mt-2">
                            <label class="form-label mt-2 " for="st_nome_conteudo">Digite a ordem de apresentação:</label>
                            <div class="">
                                <input class="form-control" type="number" name="st_ordem_apresentacao" value="{{ old('st_ordem_apresentacao') }}" placeholder="Digite a ordem de apresentação">
                            </div>
                            <div class="errosd">
                                {{ $errors->has('st_ordem_apresentacao') ? $errors->first('st_ordem_apresentacao') : '' }}
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center my-4">
                        <button class="btnVoltar4" type="submit">Cadastrar Atividade</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
