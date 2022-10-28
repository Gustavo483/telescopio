@extends('layouts.basico')

@section('titulo', 'Teste final curso')

@section('conteudo')
    <div>
        teste final do curso
    </div>
    <form method="post" action="{{route('StoreTesteFinalCursocdhj.conteudo', ['dadosconteudo'=>$dadosconteudo, 'IDCurso'=>$IDCurso])}}">
        @csrf
        @foreach($Conteudos as $conteudo)
            <div class="d-flex justify-content-around">
                <div >
                    {{ $conteudo->st_nome_conteudo}}
                </div>
                <div>
                    <input class="d-none" name="conteudos[]" placeholder="Digite Algo" value="{{$conteudo->id}}">
                    <input class="form-control w-100" name="valores[]" placeholder="Digite a quantidade de atividades">
                </div>
            </div>
        @endforeach
        <button type="submit">enviar</button>
    </form>

@endsection
