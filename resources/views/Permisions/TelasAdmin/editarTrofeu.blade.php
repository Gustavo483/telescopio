@extends('layouts.basico')

@section('titulo', 'Trofeus')

@section('conteudo')
    <div class="flexPAluno mt-3 ">
        <h4 class="h4Pets">
            Painal do Administrador > Editar Trofeus
        </h4>
        <a href="{{route('inicio.pagina')}}" class="btnVoltar">
            Voltar
        </a>
    </div>


    <div class="flexRegisterAluno mb-5">
        <div class="FormCadastro">
            <form action="{{ route('UpdadeTroveu',['trofeu'=>$trofeu->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="hsd2">
                    <h4>Editar o trofeu "{{$trofeu->st_nome_trofeu}}</h4>
                </div>
                <div class="p-2">
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
                    <div>
                        <label for="st_nome_trofeu mt-3">Digite o none do trofeu</label>
                        <input class="form-control mt-2" type="text" name="st_nome_trofeu" value="{{ $trofeu->st_nome_trofeu ?? old('st_nome_trofeu') }}" placeholder="Digite o nome do trofeu">
                        <div class="errosd">
                            {{ $errors->has('st_nome_trofeu') ? $errors->first('st_nome_trofeu') : '' }}
                        </div>
                    </div>

                    <div>
                        <label for="int_total_atividades mt-3">Digite o total de curso a ser concluidos para ganhar o trofeu</label>
                        <input class="form-control mt-2" type="number" name="int_total_atividades" value="{{ $trofeu->int_total_atividades ?? old('int_total_atividades') }}" placeholder="apenas números">
                        <div class="errosd">
                            {{ $errors->has('int_total_atividades') ? $errors->first('int_total_atividades') : '' }}
                        </div>
                    </div>

                    <div>
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
                            <div class="errosd">
                                {{ $errors->has('fk_disciplina') ? $errors->first('fk_disciplina') : '' }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center my-4">
                    <button class="btnVoltar4" type="submit">Editar Trofeu</button>
                </div>
            </form>
        </div>
    </div>
@endsection
