@extends('layouts.basico')

@section('titulo', 'Pets')

@section('conteudo')

    @if (count($errors->all()) >= 1)
        <div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">
            Não foi possível prosseguir com a solicitação. Verifique os dados e tente novamente
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="flexPAluno mt-3 ">
        <h4 class="h4Pets">
            Painal do Administrador > Pets
        </h4>
        <a href="{{route('inicio.pagina')}}" class="btnVoltar">
            Voltar
        </a>
    </div>

    <button id="BtnCriarPet" class="btnVoltar3 mt-5" onclick="CriarPets()">Criar novo Pet</button>

    <div id="divCriarPet" class="none">
        <div class="flexRegisterAluno mb-5">
            <div class="FormCadastro">
                <form action="{{ route('CadastrarPet.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="hsd2">
                        <h4>Criar novo Pet:</h4>
                    </div>
                    <div class="p-2">
                        <div class="mb-3 mt-3">
                            <label class="form-label" for="inputImage">Selecione a imagem do Pet:</label>
                            <input
                                type="file"
                                name="image"
                                id="inputImage"
                                class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="st_nome_pet mt-3">Digite o none do Pet</label>
                            <input class="form-control mt-2" type="text" name="st_nome_pet" value="{{ old('st_nome_pet') }}" placeholder="Digite o nome do pet">
                            <div class="errosd">
                                {{ $errors->has('st_nome_pet') ? $errors->first('st_nome_pet') : '' }}
                            </div>
                        </div>

                        <div>
                            <label for="int_estrelas_paraComprar mt-3">Digite o total de estrelas para comprar o pet</label>
                            <input class="form-control mt-2" type="number" name="int_estrelas_paraComprar" value="{{ old('int_estrelas_paraComprar') }}" placeholder="Digite o total de estrelas para compra">
                            <div class="errosd">
                                {{ $errors->has('int_estrelas_paraComprar') ? $errors->first('int_estrelas_paraComprar') : '' }}
                            </div>
                        </div>

                        <div class="d-flex justify-content-center align-items-center my-4">
                            <button type="submit" class="btnVoltar4">Criar Pet</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="divApresentarPets">
        <h3 class=" my-5 h4Pets text-center">
            Pets Cadastrados
        </h3>

        <div class="dsdsdccc">
            @foreach($Pets as $Pet)

                <div class="divPets2">
                    <div class="p-2">
                        <img src="images/{{$Pet->image }}" class="mb-2" style="width:100%;">
                        <div class="text-center"> {{$Pet->st_nome_pet }}</div>
                        <div class="text-center">
                            Total estrelas: {{$Pet->int_estrelas_paraComprar}}
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-1 colorcs p-2">
                        <div class="mx-2">
                            <a class="linkPets" href="{{route('Editar.Pets',['Pet'=>$Pet->id])}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                            </a>
                        </div>
                        <div class="mx-2">
                            <a class="linkPets" href="#">
                                <form id="form_{{$Pet->id}}" method="post" action="{{route('delete.pet',['Pet'=>$Pet->id])}}">
                                    @method('DELETE')
                                    @csrf
                                    <a class="linkPets" href="#" onclick="document.getElementById('form_{{$Pet->id}}').submit()">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </a>
                                </form>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


@endsection
