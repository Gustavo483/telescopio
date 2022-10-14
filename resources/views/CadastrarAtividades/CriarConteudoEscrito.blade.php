<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Criar conteudo escrito</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

</head>
<body class="container">
<div>
    <a href="{{route('vizualizar.conteudo',['conteudo'=>$dadosconteudo])}}">
        Voltar para o cronograma do curso
    </a>
</div>
<div>
    <h4 class="mt-5 mb-2">
        Cadrastro de atividade de multipla escolha para o conteudo {{$dadosconteudo->st_nome_conteudo}}
    </h4>
</div>
<form method="post" action="{{route('StoreConteudoEscrito.conteudo', ['dadosconteudo'=>$dadosconteudo])}}">
    @csrf
    <label class="mt-5" for="">Digite o conteúdo:</label>
    <textarea name="st_texto" id="st_texto" cols="30" rows="10">
                {{{ old('st_texto')}}}
            </textarea>
    <div>
        {{ $errors->has('st_texto') ? $errors->first('st_texto') : '' }}
    </div>
    <input class="d-hidden" type="number" name="st_ordem_apresentacao" value="{{$ordemApresentacao}}">



    <button type="submit">enviar</button>

</form>

<script>
    $('#st_texto').summernote({
        placeholder: 'Hello Bootstrap 4',
        tabsize: 2,
        height: 100
    });

</script>
</body>
</html>
