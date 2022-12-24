@extends('layouts.basico')

@section('titulo', 'unidadesCurso')

@section('conteudo')
    @if (count($errors->all()) >= 1)
        <div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">
            Não foi possível prosseguir com a solicitação. Verifique os dados e tente novamente
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="flexPAluno mt-3 ">
        <h4 class="h4Pets">
            Painal do Administrador > cursos > {{$NomeCurso->st_nome_curso}}
        </h4>
        <a href="{{route('curso.index')}}" class="btnVoltar">
            Voltar
        </a>
    </div>

    <div class="d-flex justify-content-start mt-5">
        <button id="BtnCadastrarUnidadeCurso" class="btnVoltar3" onclick="CadastrarUnidadeCurso()">Cadastrar unidade no curso</button>
        <div class="none">
            <button id="BtnEditarUnidade" class="btnVoltar3 ms-3 none" onclick="CadastrarUnidadeCurso2()">Editar unidades do curso</button>
        </div>
    </div>

    <div id="DivEditarUnidade" class="none">
        <div class="flexRegisterAluno2 mb-5">
            <div class="FormCadastro">
                <form>
                    @csrf
                    <div class="hsd2">
                        <h4>Editar Unidades do curso: {{$NomeCurso->st_nome_curso}}</h4>
                    </div>
                    <div class="p-2">
                        @if($Unidades != 'nenhum curso cadastrado')
                            @foreach($Unidades as $Unidade)
                                <div class="my-3">
                                    <div>
                                        <label class="form-label">{{$Unidade->st_nome_unidade}}:</label>
                                    </div>
                                    <input class="none" type="number" name="Ids[]" value="{{ $Unidade->id }}">
                                    <div class="d-flex">
                                        <input class="w-75 form-control" type="text" name="st_nome_unidade[]" value="{{ $Unidade->st_nome_unidade }}" placeholder="Digite o nome da unidade">
                                        <input class="w-25 form-control" type="text" name="int_ordem_apresentacao[]" value="{{ $Unidade->int_ordem_apresentacao }}" placeholder="Digite o nome da unidade">
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="d-flex justify-content-center my-4">
                        <button class="btnVoltar4" type="submit">Salvar alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="DivVizualizarUnidadesCadastradas">

        <h3 class=" mt-5 h4Pets text-center">
            Unidades Cadastradas no curso {{$NomeCurso->st_nome_curso}}
        </h3>

        <div class="d-block">
            <table id="teste" class="mb-5 w-100">
                <thead>
                <tr class="border12">
                    <th class="border12">Nome Unidade</th>
                    <th class="border12">Quant. conteudos</th>
                    <th class="border12">visualizar unidade</th>
                    <th class="border12">excluir unidade do curso</th>
                </tr>
                </thead>
                <tbody>
                @if($Unidades != 'nenhum curso cadastrado')
                    @foreach($Unidades as $Unidade)
                        <tr class="border12">
                            <td class="border12">
                                {{$Unidade->st_nome_unidade}}
                            </td>
                            <td class="border12">
                                {{count($Unidade->conteudos)}}
                            </td>
                            <td class="border12">
                                <a href="{{route('vizualizar.unidade',['unidade'=>$Unidade->id])}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                    </svg>
                                </a>
                            </td>
                            <td class="border12">
                                <a href="{{route('excluir.unidadeDoCurso',['UnidadeId'=>$Unidade->id,'CursoId'=>$NomeCurso->id,'UnidadeNome'=>$Unidade->st_nome_unidade])}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>

    <div id="DivCadastrarUnidade" class="none">
        <div class="flexRegisterAluno2 mb-5">
            <div class="FormCadastro">
                <form action="{{route('Unidade.VincularCursoUnidade')}}" method="post">
                    @csrf
                    <div class="hsd2">
                        <h4>Cadastrar unidade ao curso {{$NomeCurso->st_nome_curso}}</h4>
                    </div>
                    <div class="p-2">
                        <div>
                            <label class="form-label mt-2 " for="name">
                                Selecione a unidade:
                            </label>
                            <select class="js-example-tags form-control sdsds" name="DadosParaSalvar">
                                <option value="">Selecione</option>
                                @foreach ($todasUnidades as $UmaUnidade)
                                    @if(! in_array($UmaUnidade->id,$IdUnidadesCadastradas) )
                                        <option value="{{$NomeCurso->id}}-and12897*-{{$UmaUnidade->id}}">
                                            {{$UmaUnidade->st_nome_unidade}}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="errosd">
                            {{ $errors->has('DadosParaSalvar') ? $errors->first('DadosParaSalvar') : '' }}
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center my-4">
                        <button class="btnVoltar4" type="submit">Cadastrar curso</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection





