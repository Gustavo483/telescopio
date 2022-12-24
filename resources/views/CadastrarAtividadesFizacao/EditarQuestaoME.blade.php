@extends('layouts.CadastrarQuestoes')

@section('titulo', 'Questão ME')

@section('conteudo')
    <div class="flexPAluno mt-3 ">
        <h4 class="h4Pets">
            Painal do Administrador > Unidades > Conteudos > Editar questão ME atividade fização
        </h4>
        <a class="btnVoltar" href="{{route('vizualizar.TodasAtividadesFZ',['dadosconteudo'=>$Questao->fk_conteudo])}}">
            Voltar
        </a>
    </div>

    <h3 class=" mt-5 h4Pets text-center mb-5">
        Editar questão do conteúdo {{$conteudo->st_nome_conteudo}}
    </h3>

    <form method="post" action="{{ route('update.QuestaoFZME', ['IDQuestao' =>$Questao->id])}}">
        @csrf
        @method('PUT')
        <label class="mt-2 form-label">Datos da banca:</label>
        <input class="form-control" type="text" name="DadosBanca" value="{{ $Questao->DadosBanca?? old('DadosBanca') }}" placeholder="Dados da banca">
        <div class="errosd">
            {{ $errors->has('DadosBanca') ? $errors->first('DadosBanca') : '' }}
        </div>

        <label class="mt-5 form-label" for="">Pergunta:</label>
        <textarea name="st_pergunta" id="st_pergunta_ME" cols="30" rows="10">
            {{{$Questao->st_pergunta?? old('st_pergunta')}}}
        </textarea>
        <div class="errosd">
            {{ $errors->has('st_pergunta') ? $errors->first('st_pergunta') : '' }}
        </div>

        <label class="mt-5 form-label" for="">alternativa 1:</label>
        <textarea name="st_alternativa1" id="st_alternativa1" cols="30" rows="10">
            {{{$Questao->st_alternativa1?? old('st_alternativa1')}}}
        </textarea>
        <div class="errosd">
            {{ $errors->has('st_alternativa1') ? $errors->first('st_alternativa1') : '' }}
        </div>

        <label class="mt-5 form-label" for="">alternativa 2:</label>
        <textarea name="st_alternativa2" id="st_alternativa2" cols="30" rows="10">
            {{{$Questao->st_alternativa2?? old('st_alternativa2')}}}
        </textarea>
        <div class="errosd">
            {{ $errors->has('st_alternativa2') ? $errors->first('st_alternativa2') : '' }}
        </div>

        <label class="mt-5 form-label" for="">alternativa 3:</label>
        <textarea name="st_alternativa3" id="st_alternativa3" cols="30" rows="10">
                    {{{$Questao->st_alternativa3?? old('st_alternativa3')}}}
        </textarea>
        <div class="errosd">
            {{ $errors->has('st_alternativa3') ? $errors->first('st_alternativa3') : '' }}
        </div>

        <label class="mt-5 form-label" for="">alternativa 4:</label>
        <textarea name="st_alternativa4" id="st_alternativa4" cols="30" rows="10">
                    {{{$Questao->st_alternativa4?? old('st_alternativa4')}}}
        </textarea>
        <div class="errosd">
            {{ $errors->has('st_alternativa4') ? $errors->first('st_alternativa4') : '' }}
        </div>

        <label class="mt-5 form-label" for="">alternativa 5:</label>
        <textarea name="st_alternativa5" id="st_alternativa5" cols="30" rows="10">
            {{{$Questao->st_alternativa5?? old('st_alternativa5')}}}
        </textarea>
        <div class="errosd">
            {{ $errors->has('st_alternativa5') ? $errors->first('st_alternativa5') : '' }}
        </div>

        <label class="mt-5 form-label" for="">Resolução da atividade:</label>
        <textarea name="st_resolusao" id="st_resolusao_ME" cols="30" rows="10">
            {{{ $Questao->st_resolusao?? old('st_resolusao')}}}
        </textarea>
        <div class="errosd">
            {{ $errors->has('st_resolusao') ? $errors->first('st_resolusao') : '' }}
        </div>

        <label class="mt-2 form-label">Digite o número da resposta correta:</label>
        <input class="form-control" type="number" name="st_gabarito" value="{{ $Questao->st_gabarito?? old('st_gabarito') }}" placeholder="Digite o número da atividade que está correta">
        <div class="errosd">
            {{ $errors->has('st_gabarito') ? $errors->first('st_gabarito') : '' }}
        </div>


        <div class="d-flex justify-content-center">
            <button type="submit" class="btnVoltar5 my-5"> Atualizar </button>
        </div>
    </form>

    <script>
        $('#st_pergunta_ME').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,
            height: 100
        });
        $('#st_alternativa1').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,
            height: 100
        });
        $('#st_alternativa2').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,
            height: 100
        });
        $('#st_alternativa3').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,
            height: 100
        });
        $('#st_alternativa4').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,
            height: 100
        });
        $('#st_alternativa5').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,
            height: 100
        });
        $('#st_resolusao_ME').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,
            height: 100
        });
    </script>
@endsection


