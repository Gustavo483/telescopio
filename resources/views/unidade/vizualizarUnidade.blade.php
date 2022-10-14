@extends('layouts.basico')

@section('titulo', 'unidade')

@section('conteudo')
    <div>
        {{$unidade->st_nome_unidade}}
    </div>

    <div class="mt-5 mb-5">
        <h1 class="mt-5 mb-5">Conteúdos da Unidade</h1>
    </div>
    <div>
        <table class="mb-5">
            <tr class="border12">
                <th class="border12">Nome conteudo</th>
                <th class="border12">visualizar conteudo</th>
                <th class="border12">excluir conteudo da unidade</th>
            </tr>
            @foreach($conteudos as $conteudo)
                <tr class="border12">
                    <td class="border12">
                        {{$conteudo->st_nome_conteudo}}
                    </td>
                    <td class="border12">
                        <a href="{{route('vizualizar.conteudo',['conteudo'=>$conteudo->id])}}">
                            visualizar
                        </a>
                    </td>
                    <td class="border12">
                        <form id="form_{{$conteudo->id}}" method="post" action="{{route('delete.conteudo',['conteudo'=>$conteudo->id])}}">
                            @method('DELETE')
                            @csrf
                            <a class="linkedel" href="#" onclick="document.getElementById('form_{{$conteudo->id}}').submit()">
                                destruir
                            </a>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <div>
        <h1>
            Cadastrar novo conteudo para a unidade
        </h1>
        <div>
            <form action="{{route('conteudo.store', ['idUnidade'=>$unidade->id])}}" method="post">
                @csrf
                <input type="text" name="st_nome_conteudo" value="{{ old('st_nome_conteudo') }}" placeholder="Digite o nome do conteudo">
                <div>
                    {{ $errors->has('st_nome_conteudo') ? $errors->first('st_nome_conteudo') : '' }}
                </div>
                <button type="submit">criar conteudo</button>
            </form>
        </div>
    </div>




@endsection
