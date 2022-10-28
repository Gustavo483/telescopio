<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Criar Teste Intermediário</title>
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
        Cadrastro de teste final de curso
    </h4>
</div>
<form method="post" action="{{route('SelecionarConteudos.testeFinalCurso', ['dadosconteudo'=>$dadosconteudo])}}">
    @csrf
    <div class="mb-5">
        <h6 class="mb-3 mt-3 text-center">Selecione o curso para Cadastrar teste final</h6>
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

    <button type="submit">enviar</button>
</form>

<script>

</script>
</body>
</html>
