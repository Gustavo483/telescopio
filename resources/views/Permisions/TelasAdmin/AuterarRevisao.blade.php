@extends('layouts.basico')

@section('titulo', 'revisao')

@section('conteudo')
    <div class="flexPAluno mt-3 ">
        <h4 class="h4Pets">
            Painal do Administrador > Forma de revisão
        </h4>
        <a href="{{route('inicio.pagina')}}" class="btnVoltar">
            Voltar
        </a>
    </div>

    <div class="mt-5 ">
        <div class="flexRegisterAluno mb-5">
            <div class="FormCadastro">
                <form action="{{route('CadastrarFormadeRevisao', ['revisao'=>$Revisao->id])}}" method="post" >
                    @csrf
                    <div class="hsd2">
                        <h4>Cadastrar forma de revisão</h4>
                    </div>
                    <div class="p-3">
                        <label for="ordemCursoApresentar mt-3">Digite a ordem de curso para fazer o teste</label>
                        <input class="form-control mt-2" type="number" name="ordemCursoApresentar" value="{{$Revisao->ordemCursoApresentar ?? old('ordemCursoApresentar') }}">
                        <div class="text-dange">
                            {{ $errors->has('ordemCursoApresentar') ? $errors->first('ordemCursoApresentar') : '' }}
                        </div>

                        <div class="mt-3">
                            <label for="NumerosQuestao">Digite o número de questões </label>
                            <input class="form-control mt-2" type="number" name="NumerosQuestao" value="{{$Revisao->NumerosQuestao ?? old('NumerosQuestao') }}">
                            <div class="text-dange">
                                {{ $errors->has('NumerosQuestao') ? $errors->first('NumerosQuestao') : '' }}
                            </div>
                        </div>

                        <div class="mt-4 mb-3 d-flex justify-content-center">
                            <button class="btnVoltar4" type="submit">Salvar Alterações</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
