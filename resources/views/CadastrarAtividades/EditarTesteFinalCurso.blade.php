@extends('layouts.basico')

@section('titulo', 'vizualizar questões')

@section('conteudo')
    <div>
        <a href="{{route('vizualizar.conteudo',['conteudo'=>$dadosconteudo])}}">
            Voltar para o cronograma do curso
        </a>
    </div>
    <div>
        <h4 class="mt-5 mb-2">
            Cadrastro de teste final para a unidade {{$dadosconteudo->unidades->st_nome_unidade}}
        </h4>
    </div>
    <form method="post" action="{{route('update.ConteudoTesteFinalCurso', ['dadosconteudo'=>$dadosconteudo, 'IDCurso'=>$IDCurso])}}">
        @csrf
        <div class="mb-5">
            <h6 class="mb-3 mt-3 text-center">dados já cadastradados</h6>
            @foreach($dadosPreenchidos as $conteudo)
                <div class="d-flex justify-content-around">
                    <div >
                        {{ $conteudo->conteudos->st_nome_conteudo}}
                    </div>
                    <div>
                        <input class="d-none" name="cursos[]" placeholder="Digite Algo" value="{{$conteudo->conteudos->id}}">
                        <input class="form-control w-100" name="valores[]" value="{{$conteudo->totalQuestao}}" placeholder="Digite a quantidade de atividades do módulo">
                    </div>
                </div>
            @endforeach

        </div>

        <h6 class="mb-3 mt-3 text-center">Novos dados para salvamento</h6>
        @foreach($todosConteudo as $conteudo)
            <div class="d-flex justify-content-around">
                <div >
                    {{ $conteudo->st_nome_conteudo}}
                </div>
                <div>
                    <input class="d-none" name="cursos[]" placeholder="Digite Algo" value="{{$conteudo->id}}">
                    <input class="form-control w-100" name="valores[]" placeholder="Digite a quantidade de atividades do módulo">
                </div>
            </div>
        @endforeach
        <button type="submit">enviar</button>
    </form>

@endsection
