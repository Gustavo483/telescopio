<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Texto</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style_sidebar.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/styleBasico.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
</head>
<body class="colorBackgroud">
<div class="conteinerBasico">
    <div class="container">
        <div class="flexBasico">
            <div style="height: 80px" class="flexBasico">
                <div>
                    <a href="{{route('inicio.pagina')}}">
                        <img class="imgLogoBasico" src="{{asset('images/logo1.png')}}">
                    </a>
                </div>
            </div>
            <div>
                <form id="encerrar" method="post" action="{{route('logout')}}">
                    @csrf
                    <a class="encerrar" href="#" onclick="document.getElementById('encerrar').submit()">
                        encerrar cessão
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="flexPAluno mt-3 ">
        <h4 class="h4Pets">
            Painal do Administrador > Unidades > Conteudos > Cadastrar atividade escrita
        </h4>
        <a class="btnVoltar" href="{{route('vizualizar.conteudo',['conteudo'=>$dadosconteudo])}}">
            Voltar
        </a>
    </div>
    <h3 class=" mt-5 h4Pets text-center">
        Edição do conteúdo {{$dadosconteudo->st_nome_conteudo}} da unidade {{$dadosconteudo->unidades->st_nome_unidade}}
    </h3>
    <form method="post" action="{{route('updateConteudoEscrito', ['dadosconteudo'=>$dadosconteudo,'textoEscrito'=>$textoEscrito])}}">
        @csrf
        <div class="my-5">
            <label class="mt-5" for="">Digite o conteúdo:</label>
            <textarea class="" name="st_texto" id="st_texto" cols="30" rows="10">
                {{ $textoEscrito->st_texto?? old('st_texto')}}
            </textarea>
            <div class="errosd">
                {{ $errors->has('st_texto') ? $errors->first('st_texto') : '' }}
            </div>

            <div class="d-flex justify-content-center my-3">
                <button class="btnVoltar5" type="submit">Salvar alteraçoes</button>
            </div>

        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script>
    $('#st_texto').summernote({
        placeholder: 'Hello Bootstrap 4',
        tabsize: 2,
        height: 100
    });
</script>

</body>
</html>
