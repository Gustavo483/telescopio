<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Criar Teste final</title>
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
        Cadrastro de teste final para a unidade {{$dadosconteudo->unidades->st_nome_unidade}}
    </h4>
</div>
<form method="post" action="{{route('StoreTesteFinalUnidade.conteudo', ['dadosconteudo'=>$dadosconteudo])}}">
    @csrf
    @foreach($todosConteudo as $conteudo)
        <div class="d-flex justify-content-around">
            <div >
                {{ $conteudo->st_nome_conteudo}}
            </div>
            <div>
                <input class="d-none" name="cursos[]" placeholder="Digite Algo" value="{{$conteudo->id}}">
                <input class="form-control w-100" name="valores[]" placeholder="Digite a quantidade de atividades do módulo">
            </div>
        </div>
    @endforeach
    <button type="submit">enviar</button>
</form>

<script>

</script>
</body>
</html>
