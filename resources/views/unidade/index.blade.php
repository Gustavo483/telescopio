@extends('layouts.basico')

@section('titulo', 'unidadesCurso')

@section('conteudo')
    <div class="">
        <div>
            <h1 class="text-center">Cadastrar nova unidade</h1>
        </div>
        <div class="divCadastroCurso">
            <form action="{{route('unidade.store')}}" method="post">
                @csrf
                <div class="d-flex justify-content-start">
                    <div>
                        digite o nome da nova unidade:
                    </div>
                    <div class="ms-5">
                        <input type="text" name="st_nome_unidade" value="{{ $curso->st_nome_unidade?? old('st_nome_unidade') }}" placeholder="Digite o nome da unidade">
                    </div>
                </div>
                <div>
                    {{ $errors->has('st_nome_unidade') ? $errors->first('st_nome_unidade') : '' }}
                </div>
                <button type="submit">Cadastrar</button>
            </form>
        </div>
    </div>

    <div>
        <h1 class="text-center mt-5">Unidades existentes</h1>
    </div>
    <div>
        @foreach($unidades as $unidade)

            <ul>
                <li>
                    <a href="{{ route('vizualizar.unidade', ['unidade' => $unidade->id]) }}">
                        {{$unidade->st_nome_unidade}}
                    </a>
                </li>
            </ul>
        @endforeach
    </div>

@endsection
