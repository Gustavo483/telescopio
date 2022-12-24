@extends('layouts.CadastrarQuestoes')

@section('titulo', 'Teste Intermediário')

@section('conteudo')
    <div class="flexPAluno mt-3 ">
        <h4 class="h4Pets">
            Painal do Administrador > Unidades > Conteudos > Cadastrar teste intermediário
        </h4>
        <a class="btnVoltar" href="{{route('vizualizar.conteudo',['conteudo'=>$dadosconteudo])}}">
            Voltar
        </a>
    </div>

    <div class="flexRegisterAluno2 mb-5">
        <div class="FormCadastro">
            <form method="post" action="{{route('StoreTesteIntermediarioUnidade.conteudo', ['dadosconteudo'=>$dadosconteudo])}}">
                @csrf
                <div class="hsd2">
                    <h4>Teste Intermediário {{$dadosconteudo->unidades->st_nome_unidade}}</h4>
                </div>
                @foreach($todosConteudo as $conteudo)
                        <div class="p-2">
                            <label class="form-label">{{ $conteudo->st_nome_conteudo}}:</label>
                            <input class="d-none" name="cursos[]" placeholder="Digite Algo" value="{{$conteudo->id}}">
                            <input class="form-control w-100" name="valores[]" placeholder="Digite a quantidade de atividades do conteudo">
                        </div>
                @endforeach
                <div class="d-flex justify-content-center align-items-center mt-4 mb-4">
                    <button class="btnVoltar4" type="submit">Cadastrar atividade</button>
                </div>
            </form>
        </div>
    </div>

    <script>

    </script>
@endsection
