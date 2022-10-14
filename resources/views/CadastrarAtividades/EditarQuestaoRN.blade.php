<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Questão RN</title>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    </head>
    <body class="container">
        <div>
            <a href="{{route('vizualizar.TodasAtividades',['dadosconteudo'=>$Questao->fk_conteudo])}}">
                Voltar
            </a>
        </div>
        <div>
            <h4 class="mt-5 mb-2">
                Editar questão RN
            </h4>
        </div>
        <form method="post" action="{{ route('update.QuestaoRN', ['IDQuestao' =>$Questao->id])}}">
            @csrf
            @method('PUT')

            <label class="mt-2">Datos da banca:</label>

            <input type="text" name="DadosBanca" value="{{ $Questao->DadosBanca?? old('DadosBanca') }}" placeholder="Dados da banca">
            <div>
                {{ $errors->has('DadosBanca') ? $errors->first('DadosBanca') : '' }}
            </div>

            <label class="mt-5" for="">Pergunta:</label>
            <textarea name="st_pergunta" id="st_pergunta_RN" cols="30" rows="10">
                {{{ $Questao->st_pergunta??  old('st_pergunta')}}}
            </textarea>
            <div>
                {{ $errors->has('st_pergunta') ? $errors->first('st_pergunta') : '' }}
            </div>


            <label class="mt-5" for="">Resposta da atividade:</label>
            <input type="text" name="st_respostaRN" value="{{ $Questao->st_respostaRN?? old('st_respostaRN') }}">
            <div>
                {{ $errors->has('st_respostaRN') ? $errors->first('st_respostaRN') : '' }}
            </div>


            <label class="mt-5" for="">Resolução da atividade:</label>
            <textarea name="st_resolusao" id="st_resolusao_RN" cols="30" rows="10">
                {{{ $Questao->st_resolusao?? old('st_resolusao')}}}
            </textarea>
            <div>
                {{ $errors->has('st_resolusao') ? $errors->first('st_resolusao') : '' }}
            </div>

            <div class="mt-2 text-center">
                <button type="submit" class="btn btn-lg btn-primary mt-5"> enviar </button>
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
    </body>
</html>
