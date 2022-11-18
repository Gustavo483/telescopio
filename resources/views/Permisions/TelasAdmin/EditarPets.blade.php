@extends('layouts.basico')

@section('titulo', 'Trofeus')

@section('conteudo')
    <h4 class="mt-4 mb-4">Editar o pet "{{$Pet->st_nome_pet}}"</h4>
    <form action="{{ route('UpdadePet',['Pet'=>$Pet->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
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
        <div class="text-dange">
            {{ $errors->has('st_nome_pet') ? $errors->first('st_nome_pet') : '' }}
        </div>

        <label for="int_estrelas_paraComprar">Digite o total de estrelas para comprar o pet</label>
        <input class="form-control mt-2" type="number" name="int_estrelas_paraComprar" value="{{ $Pet->int_estrelas_paraComprar ?? old('int_estrelas_paraComprar') }}" placeholder="apenas números">
        <div class="text-dange">
            {{ $errors->has('int_estrelas_paraComprar') ? $errors->first('int_estrelas_paraComprar') : '' }}
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-success">Salvar alterações</button>
        </div>
    </form>

@endsection
