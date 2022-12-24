@extends('layouts.CadastrarQuestoes')

@section('titulo', 'Teste Intermediário')

@section('conteudo')
    <div class="flexPAluno mt-3 ">
        <h4 class="h4Pets">
            Painal do Administrador > Unidades > Conteudos > Cadastrar teste Final do curso
        </h4>
        <a class="btnVoltar" href="{{route('vizualizar.conteudo',['conteudo'=>$dadosconteudo])}}">
            Voltar
        </a>
    </div>

    <div class="flexRegisterAluno2 mb-5">
        <div class="FormCadastro">
            <form method="post" action="{{route('SelecionarConteudos.testeFinalCurso', ['dadosconteudo'=>$dadosconteudo])}}">
                @csrf
                <div class="hsd2">
                    <h4>Cadastro de teste final de curso:</h4>
                </div>
                <div class="p-2 my-3">
                    <label>Selecione o curso para o teste final</label>
                    <select id="select1"  name="dado" class="form-control">
                        <option value="">selecione</option>
                        @foreach($todosCursos as $curso)
                            <option value="{{$curso->id}}">{{$curso->st_nome_curso}}</option>
                        @endforeach
                    </select>
                    <div>
                        {{ $errors->has('dado') ? $errors->first('dado') : '' }}
                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center mt-4 mb-4">
                    <button class="btnVoltar4" type="submit">Cadastrar </button>
                </div>
            </form>
        </div>
    </div>
@endsection



