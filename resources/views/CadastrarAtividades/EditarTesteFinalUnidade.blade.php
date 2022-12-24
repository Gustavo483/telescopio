@extends('layouts.basico')

@section('titulo', 'vizualizar questões')

@section('conteudo')
    <div class="flexPAluno mt-3 ">
        <h4 class="h4Pets">
            Painal do Administrador > Unidades > Conteudos > Editar teste Final da unidade
        </h4>
        <a class="btnVoltar" href="{{route('vizualizar.conteudo',['conteudo'=>$dadosconteudo])}}">
            Voltar
        </a>
    </div>

    <div class="flexRegisterAluno2 mb-5">
        <div class="FormCadastro">
            <form method="post" action="{{route('updateTesteFinalUnidade.conteudo', ['dadosconteudo'=>$dadosconteudo])}}">
                @csrf
                <div class="hsd2">
                    <h4>teste final da unidade: {{$dadosconteudo->unidades->st_nome_unidade}}</h4>
                </div>
                <div class="p-2">
                    @foreach($DadosPreenchidos as $conteudo)
                        <div>
                            <label class="form-label">{{ $conteudo->conteudos->st_nome_conteudo}}:</label>
                            <input class="d-none" name="cursos[]" placeholder="Digite Algo" value="{{$conteudo->conteudos->id}}">
                            <input class="form-control w-100" name="valores[]" value="{{$conteudo->totalQuestao}}" placeholder="Digite a quantidade de atividades do módulo">
                        </div>
                    @endforeach
                    @foreach($todosConteudo as $conteudo)
                        @if(!in_array($conteudo->id,$array))
                            <div>
                                <label class="form-label">{{$conteudo->st_nome_conteudo}}:</label>
                                <input class="d-none" name="cursos[]" placeholder="Digite Algo" value="{{$conteudo->id}}">
                                <input class="form-control w-100" name="valores[]" placeholder="Digite a quantidade de atividades do módulo">
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="d-flex justify-content-center align-items-center mt-4 mb-4">
                    <button class="btnVoltar4" type="submit">Atualizar </button>
                </div>
            </form>
        </div>
    </div>

@endsection
