@extends('layouts.basico')

@section('titulo', 'Pets')

@section('conteudo')

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h4 class="mt-4 mb-4">Cadastrar novo Pet</h4>
    <form action="{{ route('CadastrarPet.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
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

        <label for="st_nome_pet mt-3">Digite o none do Pet</label>
        <input class="form-control mt-2" type="text" name="st_nome_pet" value="{{ old('st_nome_pet') }}" placeholder="Digite o nome do pet">
        <div class="text-dange">
            {{ $errors->has('st_nome_pet') ? $errors->first('st_nome_pet') : '' }}
        </div>

        <label for="int_estrelas_paraComprar mt-3">Digite o total de estrelas para comprar o pet</label>
        <input class="form-control mt-2" type="number" name="int_estrelas_paraComprar" value="{{ old('int_estrelas_paraComprar') }}" placeholder="Digite o total de estrelas para compra">
        <div class="text-dange">
            {{ $errors->has('int_estrelas_paraComprar') ? $errors->first('int_estrelas_paraComprar') : '' }}
        </div>


        <div class="mb-3">
            <button type="submit" class="btn btn-success">Upload</button>
        </div>
    </form>


    <h2 class="text-center">Pets Cadastrados</h2>
    <div class="d-flex justify-content-center">
        @foreach($Pets as $Pet)
            <div class="tamanhoDiv2 ms-2 ">
                <img src="images/{{$Pet->image }}" class="mb-2" style="width:100px;height:100px;">

                <div class="text-center">
                    {{$Pet->st_nome_pet}}
                </div>
                <div class="text-center">
                    Total estrelas: {{$Pet->int_estrelas_paraComprar}}
                </div>

                <div class="d-flex mt-2">
                    <div class="">
                        <a href="{{route('Editar.Pets',['Pet'=>$Pet->id])}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                            </svg>
                        </a>
                    </div>
                    <div>
                        <a href="#">
                            <form id="form_{{$Pet->id}}" method="post" action="{{route('delete.pet',['Pet'=>$Pet->id])}}">
                                @method('DELETE')
                                @csrf
                                <a class="linkedel" href="#" onclick="document.getElementById('form_{{$Pet->id}}').submit()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                    </svg>
                                </a>
                            </form>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
