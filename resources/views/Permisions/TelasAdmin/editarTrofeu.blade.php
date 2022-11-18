@extends('layouts.basico')

@section('titulo', 'Trofeus')

@section('conteudo')
    <h4 class="mt-4 mb-4">Editar o trofeu "{{$trofeu->st_nome_trofeu}}"</h4>
    <form action="{{ route('UpdadeTroveu',['trofeu'=>$trofeu->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
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
        <input class="form-control mt-2" type="text" name="st_nome_trofeu" value="{{ $trofeu->st_nome_trofeu ?? old('st_nome_trofeu') }}" placeholder="Digite o nome do trofeu">
        <div class="text-dange">
            {{ $errors->has('st_nome_trofeu') ? $errors->first('st_nome_trofeu') : '' }}
        </div>

        <label for="int_total_atividades mt-3">Digite o total de curso a ser concluidos para ganhar o trofeu</label>
        <input class="form-control mt-2" type="number" name="int_total_atividades" value="{{ $trofeu->int_total_atividades ?? old('int_total_atividades') }}" placeholder="apenas números">
        <div class="text-dange">
            {{ $errors->has('int_total_atividades') ? $errors->first('int_total_atividades') : '' }}
        </div>

        <div class="mt-3">
            <label for="int_total_atividades ">Selecione a disciplina</label>
            <select id=""  name="fk_disciplina" class="form-control">
                <option value="{{$trofeu->disciplinas->id}}">{{$trofeu->disciplinas->st_nome_disciplina}}</option>
                @foreach($disciplinas as $disciplina)
                    <option value="{{$disciplina->id}}">
                        {{$disciplina->st_nome_disciplina}}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-success">Salvar alterações</button>
        </div>
    </form>


@endsection
