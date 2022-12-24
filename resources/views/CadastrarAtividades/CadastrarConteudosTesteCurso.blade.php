@extends('layouts.basico')

@section('titulo', 'Teste final curso')

@section('conteudo')
    <div class="flexPAluno mt-3 ">
        <h4 class="h4Pets">
            Painal do Administrador > Unidades > Conteudos > Cadastrar teste final do curso
        </h4>
        <a class="btnVoltar" href="{{route('vizualizar.conteudo',['conteudo'=>$dadosconteudo])}}">
            Voltar
        </a>
    </div>

    <div class="flexRegisterAluno2 mb-5">
        <div class="FormCadastro">
            <form method="post" action="{{route('StoreTesteFinalCursocdhj.conteudo', ['dadosconteudo'=>$dadosconteudo, 'IDCurso'=>$IDCurso])}}">
                @csrf
                <div class="hsd2">
                    <h4>Teste final do curso: {{$IDCurso->st_nome_curso}}</h4>
                </div>
                <div class="p-2">
                    @foreach($Conteudos as $conteudo)
                        <div class="my-2">
                            <label class="form-label">{{ $conteudo->st_nome_conteudo}}:</label>
                            <input class="d-none" name="conteudos[]" placeholder="Digite Algo" value="{{$conteudo->id}}">
                            <input type="number" class="form-control w-100" name="valores[]" placeholder="Digite a quantidade de atividades">
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center align-items-center mt-4 mb-4">
                    <button class="btnVoltar4" type="submit">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>


@endsection
