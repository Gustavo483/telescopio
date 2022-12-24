@extends('layouts.basico')

@section('titulo', 'unidade')

@section('conteudo')
    @if (count($errors->all()) >= 1)
        <div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">
            Não foi possível prosseguir com a solicitação. Verifique os dados e tente novamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="flexPAluno mt-3 ">
        <h4 class="h4Pets">
            Painal do Administrador > unidades > {{$unidade->st_nome_unidade}}
        </h4>
        <a href="{{route('unidade.index')}}" class="btnVoltar">
            Voltar
        </a>
    </div>


    <div class="d-flex justify-content-start mt-5">
        <button id="BtnCadastrarConteudoUnidade" class="btnVoltar3" onclick="CadastrarConteudoUnidade()">Cadastrar novo conteudo</button>

        <div class="">
            <button id="" class="btnVoltar3 ms-3 " onclick="CadastrarConteudoUnidade2()">Editar conteudos da unidade</button>
        </div>
    </div>

    <div id="EditarConteudo" class="none">
        <div class="flexRegisterAluno2 mb-5">
            <div class="FormCadastro">
                <form action="{{route('atualizarUnidade', ['unidade'=>$unidade->id])}}" method="post">
                    @csrf
                    <div class="hsd2">
                        <h4>Editar Conteúdos da unidade {{$unidade->st_nome_unidade}}</h4>
                    </div>
                    <div class="p-2">
                        @foreach($conteudos as $conteudo)
                            <div class="my-3">
                                <div>
                                    <label class="form-label">{{$conteudo->st_nome_conteudo}}:</label>
                                </div>
                                <input class="none" type="number" name="Ids[]" value="{{ $conteudo->id }}">
                                <div class="d-flex">
                                    <input class="w-75 form-control" type="text" name="st_nome_conteudo[]" value="{{ $conteudo->st_nome_conteudo }}" placeholder="Digite o nome da unidade">
                                    <input class="w-25 form-control" type="text" name="int_ordem_apresentacao[]" value="{{ $conteudo->int_ordem_apresentacao }}" placeholder="Digite o nome da unidade">
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-center align-items-center my-4">
                        <button class="btnVoltar4" type="submit">criar conteudo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="DivApresentarConteudos">
        <h3 class=" mt-5 h4Pets text-center">
            Conteúdos da Unidade {{$unidade->st_nome_unidade}}
        </h3>

        <div class="my-5">
            <table id="myTable" class="mb-5">
                <thead>
                <tr class="border12">
                    <th class="border12">Nome conteudo</th>
                    <th class="border12">Ordem apresentação</th>
                    <th class="border12">visualizar conteudo</th>
                    <th class="border12">excluir conteudo da unidade</th>
                </tr>
                </thead>

                <tbody>
                @foreach($conteudos as $conteudo)
                    <tr class="border12">
                        <td class="border12">
                            {{$conteudo->st_nome_conteudo}}
                        </td>
                        <td class="border12">
                            {{$conteudo->int_ordem_apresentacao}}
                        </td>
                        <td class="border12">
                            <a href="{{route('vizualizar.conteudo',['conteudo'=>$conteudo->id])}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg>
                            </a>
                        </td>
                        <td class="border12">
                            <form id="form_{{$conteudo->id}}" method="post" action="{{route('delete.conteudo',['conteudo'=>$conteudo->id])}}">
                                @method('DELETE')
                                @csrf
                                <a class="linkedel" href="#" onclick="document.getElementById('form_{{$conteudo->id}}').submit()">
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
    </div>

    <div id="DivCadastrarNovoConteudo" class="none">
        <div class="flexRegisterAluno2 mb-5">
            <div class="FormCadastro">

            <form action="{{route('conteudo.store', ['idUnidade'=>$unidade->id])}}" method="post">
                @csrf
                <div class="hsd2">
                    <h4>Cadastrar conteúdo para {{$unidade->st_nome_unidade}}</h4>
                </div>
                <div class="p-2">
                    <div>
                        <label class="form-label mt-2 " for="st_nome_conteudo"> Digite o nome do conteúdo:</label>
                        <input class="form-control" type="text" name="st_nome_conteudo" value="{{ old('st_nome_conteudo') }}" placeholder="Digite o nome do conteudo">
                        <div class="errosd">
                            {{ $errors->has('st_nome_conteudo') ? $errors->first('st_nome_conteudo') : '' }}
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center my-4">
                    <button class="btnVoltar4" type="submit">criar conteudo</button>
                </div>
            </form>
        </div>
    </div>

@endsection
