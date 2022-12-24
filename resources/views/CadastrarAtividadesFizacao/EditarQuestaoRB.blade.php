@extends('layouts.CadastrarQuestoes')

@section('titulo', 'Questão RB')

@section('conteudo')
    <div class="flexPAluno mt-3 ">
        <h4 class="h4Pets">
            Painal do Administrador > Unidades > Conteudos > Editar questão RB atividade fização
        </h4>
        <a class="btnVoltar" href="{{route('vizualizar.TodasAtividadesFZ',['dadosconteudo'=>$Questao->fk_conteudo])}}">
            Voltar
        </a>
    </div>

    <h3 class=" mt-5 h4Pets text-center mb-5">
        Editar questão do conteúdo {{$conteudo->st_nome_conteudo}}
    </h3>

    <form method="post" action="{{ route('update.QuestaoFZRB', ['IDQuestao' =>$Questao->id])}}">
        @csrf
        @method('PUT')

        <label class="mt-2 form-label">Datos da banca:</label>

        <input class="form-control" type="text" name="DadosBanca" value="{{ $Questao->DadosBanca?? old('DadosBanca') }}" placeholder="Dados da banca">
        <div class="errosd">
            {{ $errors->has('DadosBanca') ? $errors->first('DadosBanca') : '' }}
        </div>

        <label class="mt-5 form-label" for="">Pergunta:</label>
        <textarea name="st_pergunta" id="st_pergunta_RB" cols="30" rows="10">
                    {{{ $Questao->st_pergunta?? old('st_pergunta')}}}
                </textarea>
        <div class="errosd">
            {{ $errors->has('st_pergunta') ? $errors->first('st_pergunta') : '' }}
        </div>


        <label class="mt-5 form-label" for="">Resposta da atividade:</label>
        <input class="form-control" type="text" name="st_gabarito" value="{{ $Questao->st_gabarito?? old('st_gabarito') }}">
        <div class="errosd">
            {{ $errors->has('st_gabarito') ? $errors->first('st_gabarito') : '' }}
        </div>


        <label class="mt-5 form-label" for="">Resolução da atividade:</label>
        <textarea name="st_resolusao" id="st_resolusao_RB" cols="30" rows="10">
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
        $('#st_pergunta_RB').summernote({
            placeholder: 'escreva aqui',
            tabsize: 2,
            height: 100
        });
        $('#st_resolusao_RB').summernote({
            placeholder: 'escreva aqui',
            tabsize: 2,
            height: 100
        });

    </script>
@endsection
