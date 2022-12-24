@extends('layouts.CadastrarQuestoes')

@section('titulo', 'Questão RN')

@section('conteudo')
    <div class="flexPAluno mt-3 ">
        <h4 class="h4Pets">
            Painal do Administrador > Unidades > Conteudos > Editar questão RN
        </h4>
        <a class="btnVoltar" href="{{route('vizualizar.conteudo',['conteudo'=>$conteudo->id])}}">
            Voltar
        </a>
    </div>

    <h3 class=" mt-5 h4Pets text-center mb-5">
        Editar questão de resposta numérica para o conteúdo {{$conteudo->st_nome_conteudo}}
    </h3>
        <form method="post" action="{{ route('update.QuestaoRN', ['IDQuestao' =>$Questao->id])}}">
            @csrf
            @method('PUT')

            <label class="mt-2 form-label">Datos da banca:</label>
            <input class="form-control" type="text" name="DadosBanca" value="{{ $Questao->DadosBanca?? old('DadosBanca') }}" placeholder="Dados da banca">
            <div class="errosd">
                {{ $errors->has('DadosBanca') ? $errors->first('DadosBanca') : '' }}
            </div>

            <label class="mt-5" for="">Pergunta:</label>
            <textarea name="st_pergunta" id="st_pergunta_RN" cols="30" rows="10">
                {{{ $Questao->st_pergunta??  old('st_pergunta')}}}
            </textarea>
            <div class="errosd">
                {{ $errors->has('st_pergunta') ? $errors->first('st_pergunta') : '' }}
            </div>


            <label class="mt-5 form-label" for="">Resposta da atividade:</label>
            <input class="form-control" type="number" name="st_gabarito" value="{{ $Questao->st_gabarito?? old('st_gabarito') }}">
            <div class="errosd">
                {{ $errors->has('st_gabarito') ? $errors->first('st_gabarito') : '' }}
            </div>


            <label class="mt-5" for="">Resolução da atividade:</label>
            <textarea name="st_resolusao" id="st_resolusao_RN" cols="30" rows="10">
                {{{ $Questao->st_resolusao?? old('st_resolusao')}}}
            </textarea>
            <div class="errosd">
                {{ $errors->has('st_resolusao') ? $errors->first('st_resolusao') : '' }}
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btnVoltar5 my-5"> Atualizar </button>
            </div>

        </form>

        <script>
            $('#st_pergunta_RN').summernote({
                placeholder: 'escreva aqui',
                tabsize: 2,
                height: 100
            });
            $('#st_respostaRN').summernote({
                placeholder: 'escreva aqui',
                tabsize: 2,
                height: 100
            });
            $('#st_resolusao_RN').summernote({
                placeholder: 'Hescreva aqui',
                tabsize: 2,
                height: 100
            });
        </script>
@endsection
