@extends('layouts.basico')

@section('titulo', 'Trofeus')

@section('conteudo')
    <div class="flexPAluno mt-3 ">
        <h4 class="h4Pets">
            Painal do Administrador > Editar Pets
        </h4>
        <a href="{{route('inicio.pagina')}}" class="btnVoltar">
            Voltar
        </a>
    </div>
    <div class="flexRegisterAluno mb-5">
        <div class="FormCadastro">
            <form action="{{ route('UpdadePet',['Pet'=>$Pet->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="hsd2">
                    <h4>Editar o pet "{{$Pet->st_nome_pet}}</h4>
                </div>
                <div class="p-2">
                    <div class="mb-3">
                        <label class="form-label" for="inputImage">Selecione a imagem do pet:</label>
                        <input
                            type="file"
                            name="image"
                            id="inputImage"
                            class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <label for="st_nome_pet">Digite o none do pet</label>
                    <input class="form-control mt-2" type="text" name="st_nome_pet" value="{{ $Pet->st_nome_pet ?? old('st_nome_pet') }}" placeholder="Digite o nome do pet">
                    <div class="errosd">
                        {{ $errors->has('st_nome_pet') ? $errors->first('st_nome_pet') : '' }}
                    </div>

                    <label for="int_estrelas_paraComprar">Digite o total de estrelas para comprar o pet</label>
                    <input class="form-control mt-2" type="number" name="int_estrelas_paraComprar" value="{{ $Pet->int_estrelas_paraComprar ?? old('int_estrelas_paraComprar') }}" placeholder="apenas números">
                    <div class="errosd">
                        {{ $errors->has('int_estrelas_paraComprar') ? $errors->first('int_estrelas_paraComprar') : '' }}
                    </div>

                    <div class="d-flex justify-content-center align-items-center mt-4">
                        <button class="btnVoltar4" type="submit">Salvar alterações</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
