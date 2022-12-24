<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>@yield('titulo')</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style_sidebar.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/styleBasico.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="{{asset('js/professor.js')}}"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
        <div class="mt-3">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        @yield('conteudo')
    </div>

    <!-- Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(".js-example-tags").select2({
            tags: true
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('js/script.js')}}"></script>
    <script src="{{asset('js/professor.js')}}"></script>

    <script>
        $(document).ready( function () {
            $('#myTable').DataTable({
                "language":{
                    "url":"//cdn.datatables.net/plug-ins/1.13.1/i18n/pt-PT.json"
                }
            });
            $('#myTable3').DataTable({
                "language":{
                    "url":"//cdn.datatables.net/plug-ins/1.13.1/i18n/pt-PT.json"
                }
            });

        } );

    </script>
    <script>
        var btn233 = document.getElementById('btn233')
        var div233 = document.getElementById('div233')
        var btn234 = document.getElementById('btn234')

        btn233.addEventListener("click", function (){
            div233.classList.remove('class1')
            div233.classList.add('class2')
        });

        btn234.addEventListener("click", function (){
            div233.classList.add('class1')
            div233.classList.remove('class2')
        });

        var btnasdas = document.getElementById('btnasdas')
        btnasdas.addEventListener("click", function (){
            btnasdas.type = "submit"
            btnasdas.click()
        })
    </script>
</body>


</html>
