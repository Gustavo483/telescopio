@extends('layouts.basico')

@section('titulo', 'Trofeus')

@section('conteudo')

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h4 class="mt-4 mb-4">Cadastrar novo trofeu</h4>
    <form action="{{ route('CadastrarTrofeu.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label" for="inputImage">Selecione a imagem do trofeu:</label>
            <input
                type="file"
                name="image"
                id="inputImage"
                class="form-control @error('image') is-invalid @enderror">
            @error('image')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <label for="st_nome_trofeu mt-3">Digite o none do trofeu</label>
        <input class="form-control mt-2" type="text" name="st_nome_trofeu" value="{{ old('st_nome_trofeu') }}" placeholder="Digite o nome do trofeu">
        <div class="text-dange">
            {{ $errors->has('st_nome_trofeu') ? $errors->first('st_nome_trofeu') : '' }}
        </div>

        <label for="int_total_atividades mt-3">Digite o total de curso a ser concluidos para ganhar o trofeu</label>
        <input class="form-control mt-2" type="number" name="int_total_atividades" value="{{ old('int_total_atividades') }}" placeholder="apenas números">
        <div class="text-dange">
            {{ $errors->has('int_total_atividades') ? $errors->first('int_total_atividades') : '' }}
        </div>

        <div class="mt-3">
            <label for="int_total_atividades ">Selecione a disciplina</label>
            <select id=""  name="fk_disciplina" class="form-control">
                <option value="">Selecione</option>
                @foreach($disciplinas as $disciplina)
                    <option value="{{$disciplina->id}}">
                        {{$disciplina->st_nome_disciplina}}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="text-dange">
            {{ $errors->has('int_total_atividades') ? $errors->first('int_total_atividades') : '' }}
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-success">Upload</button>
        </div>
    </form>



    <h2 class="text-center">Trofeus Cadastrados</h2>
    <div class="d-flex justify-content-center">
        @foreach($todosTrofeus as $trofeu)
            <div class="tamanhoDiv ms-2">
                <img src="images/{{$trofeu->st_caminho_img }}" class="mb-2" style="width:200px;height:250px;">
                <div class="text-center sdfsd">
                    {{$trofeu->st_nome_trofeu }}
                </div>
                <div class="text-center">
                    Complete {{$trofeu->int_total_atividades}} cursos de {{$trofeu->disciplinas->st_nome_disciplina}}
                </div>
                <div class="d-flex">
                    <div class="">
                        <a href="{{route('Editar.Troveu',['trofeu'=>$trofeu->id])}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                            </svg>
                        </a>
                    </div>
                    <div>
                        <a href="#">
                            <form id="form_{{$trofeu->id}}" method="post" action="{{route('delete.Trofeu',['trofeu'=>$trofeu->id])}}">
                                @method('DELETE')
                                @csrf
                                <a class="linkedel" href="#" onclick="document.getElementById('form_{{$trofeu->id}}').submit()">
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
