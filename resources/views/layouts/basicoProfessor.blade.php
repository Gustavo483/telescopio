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
                <h4 class=" h4Pets"> @yield('infoPágina')</h4>
                @if(isset($Identificador))
                    <a href="{{route('vizualizarTodosAlunos.Professor',['IDProfessor'=>$IDProfessor])}}" class="btnVoltar">
                        Voltar
                    </a>
                @endif
                @if(!isset($Identificador))
                    <a href="{{route('vizualizarAlunosCadastradosNoCurso.Professor',['IDCurso'=>$IDCurso,'IDProfessor'=>$IDProfessor])}}" class="btnVoltar">
                        Voltar
                    </a>
                @endif
            </div>

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show mb-2 mt-4" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @error('cursos')
                <div class="alert alert-danger alert-dismissible fade show mb-2 mt-4" role="alert">
                    {{$message}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror

            @error('data')
                <div class="alert alert-danger alert-dismissible fade show mb-2 mt-4" role="alert">
                    {{$message}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror

            @error('QuantidadeAtividades')
                <div class="alert alert-danger alert-dismissible fade show mb-2 mt-4" role="alert">
                    {{$message}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror

            <div class="d-flex justify-content-between mt-5">
                <div class="tamanhoDivProgresso">
                    <div class="flexProgresso">
                        <div>
                            <img src="{{asset('images/pokemon.png')}}" style="width:60px;height:60px;">
                        </div>
                        <div class="text-center">
                            {{$ConquitasAlunos->int_total_pets}}
                        </div>
                    </div>
                </div>

                <div class="tamanhoDivProgresso">
                    <div class="flexProgresso">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="#3574cf" class="bi bi-book" viewBox="0 0 16 16">
                                <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                            </svg>
                        </div>
                        <div>
                            {{$ConquitasAlunos->int_total_cursos_concluidos}}
                        </div>
                    </div>
                </div>

                <div class="tamanhoDivProgresso">
                    <div class="flexProgresso">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="#3574cf" class="bi bi-trophy" viewBox="0 0 16 16">
                                <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5zm.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935zM3.504 1c.007.517.026 1.006.056 1.469.13 2.028.457 3.546.87 4.667C5.294 9.48 6.484 10 7 10a.5.5 0 0 1 .5.5v2.61a1 1 0 0 1-.757.97l-1.426.356a.5.5 0 0 0-.179.085L4.5 15h7l-.638-.479a.501.501 0 0 0-.18-.085l-1.425-.356a1 1 0 0 1-.757-.97V10.5A.5.5 0 0 1 9 10c.516 0 1.706-.52 2.57-2.864.413-1.12.74-2.64.87-4.667.03-.463.049-.952.056-1.469H3.504z"/>
                            </svg>
                        </div>
                        <div class="text-center">
                            {{$ConquitasAlunos->int_total_trofeus}}
                        </div>
                    </div>
                </div>

                <div class="tamanhoDivProgresso">
                    <div class="flexProgresso">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="#3574cf" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                                <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                            </svg>
                        </div>
                        <div>
                            {{$ConquitasAlunos->int_revisoes}}
                        </div>
                    </div>
                </div>

                <div class="tamanhoDivProgresso">
                    <div class="flexProgresso">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="#3574cf" class="bi bi-stars" viewBox="0 0 16 16">
                                <path d="M7.657 6.247c.11-.33.576-.33.686 0l.645 1.937a2.89 2.89 0 0 0 1.829 1.828l1.936.645c.33.11.33.576 0 .686l-1.937.645a2.89 2.89 0 0 0-1.828 1.829l-.645 1.936a.361.361 0 0 1-.686 0l-.645-1.937a2.89 2.89 0 0 0-1.828-1.828l-1.937-.645a.361.361 0 0 1 0-.686l1.937-.645a2.89 2.89 0 0 0 1.828-1.828l.645-1.937zM3.794 1.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387A1.734 1.734 0 0 0 4.593 5.69l-.387 1.162a.217.217 0 0 1-.412 0L3.407 5.69A1.734 1.734 0 0 0 2.31 4.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387A1.734 1.734 0 0 0 3.407 2.31l.387-1.162zM10.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732L9.1 2.137a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L10.863.1z"/>
                            </svg>
                        </div>
                        <div>
                            {{$ConquitasAlunos->int_total_estrelas}}
                        </div>
                    </div>
                </div>

            </div>
            <div class="dfcxzx mt-5">
                <div>
                    @if(!isset($Identificador))
                        <a class="linkHomeVisualizarAluno2 me-3" href="{{route('atividadesAluno.professor',['Aluno'=>$Aluno,'IDCurso'=>$IDCurso,'IDProfessor'=>$IDProfessor])}}">
                            Atividades
                        </a>
                    @endif
                    @if(isset($Identificador))
                        <a class="linkHomeVisualizarAluno2 me-3" href="{{route('atividadesAluno2.professor',['Aluno'=>$Aluno,'IDProfessor'=>$IDProfessor])}}">
                            Atividades
                        </a>
                    @endif
                </div>

                <div>
                    @if(!isset($Identificador))
                        <a class="linkHomeVisualizarAluno2 me-3" href="{{route('CursosAluno.professor',['Aluno'=>$Aluno,'IDCurso'=>$IDCurso,'IDProfessor'=>$IDProfessor])}}">
                            Cursos
                        </a>
                    @endif

                    @if(isset($Identificador))
                        <a class="linkHomeVisualizarAluno2 me-3" href="{{route('CursosAluno2.professor',['Aluno'=>$Aluno,'IDProfessor'=>$IDProfessor])}}">
                            Cursos
                        </a>
                    @endif

                </div>

                <div>
                    @if(!isset($Identificador))
                        <a class="linkHomeVisualizarAluno2 me-3" href="{{route('ProgressoAluno.professor',['Aluno'=>$Aluno,'IDCurso'=>$IDCurso,'IDProfessor'=>$IDProfessor])}}">
                            Progresso
                        </a>
                    @endif

                    @if(isset($Identificador))
                        <a class="linkHomeVisualizarAluno2 me-3" href="{{route('ProgressoAluno2.professor',['Aluno'=>$Aluno,'IDProfessor'=>$IDProfessor])}}">
                            Progresso
                        </a>
                    @endif

                </div>

                <div>
                    @if(!isset($Identificador))
                        <a class="linkHomeVisualizarAluno2" href="{{route('TarefasAluno.professor',['Aluno'=>$Aluno,'IDCurso'=>$IDCurso,'IDProfessor'=>$IDProfessor])}}">
                            Tarefas
                        </a>
                    @endif

                    @if(isset($Identificador))
                        <a class="linkHomeVisualizarAluno2 me-3" href="{{route('TarefasAluno2.professor',['Aluno'=>$Aluno,'IDProfessor'=>$IDProfessor])}}">
                            Tarefas
                        </a>
                    @endif
                </div>
            </div>
            @yield('conteudo')
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready( function () {
                $('#myTable').DataTable({
                    "language":{
                        "url":"//cdn.datatables.net/plug-ins/1.13.1/i18n/pt-PT.json"
                    }
                });
            } );
        </script>
        <script>
            var dcsdcsqw22 = document.getElementById('dcsdcsqw22')
            var CursosCadastrados = document.getElementById('CursosCadastrados')
            var DivCadastrarCurso = document.getElementById('DivCadastrarCurso')
            var AbrirDivCadastrarCurso = document.getElementById('AbrirDivCadastrarCurso')
            var FecharModal = document.getElementById('FecharModal')
            var FecharModal2 = document.getElementById('FecharModal2')
            var btnCadastrarCurso = document.getElementById('CadastrarCurso')
            var btnCadastrarCurso2 = document.getElementById('CadastrarCurso2')
            var btnModal = document.getElementById('btntessdx')
            var divModal = document.getElementById('divModal')
            var SalvarCursosModal = document.getElementById('SalvarCursosModal')

            AbrirDivCadastrarCurso.addEventListener("click",function (){
                if(dcsdcsqw22.classList.contains("dcsdcsqw")){
                    dcsdcsqw22.classList.remove('dcsdcsqw')
                    dcsdcsqw22.innerHTML = 'Vizualizar Cursos Cadastrados'
                }else{
                    dcsdcsqw22.classList.add('dcsdcsqw')
                    dcsdcsqw22.innerHTML = 'Cadastrar Novo Curso'
                }

                DivCadastrarCurso.classList.toggle('none')
                CursosCadastrados.classList.toggle('none')
            })

            FecharModal.addEventListener("click",function () {
                divModal.innerHTML = ''
            })
            FecharModal2.addEventListener("click",function () {

                divModal.innerHTML = ''
            })
            SalvarCursosModal.addEventListener("click",function () {
                btnCadastrarCurso2.click()
            })

            btnCadastrarCurso.addEventListener("click", function (){
                var chebox = document.getElementsByClassName('checkboxCursos')
                for (var i = 0; i < chebox.length; i++){
                    if ( chebox[i].checked) {
                        var idValue = chebox[i].value
                        var dados = idValue.split('@Asd24')
                        var element = document.createElement("div");
                        element.innerHTML = '<div class="p-1">- '+dados[1]+'</div>';
                        divModal.appendChild(element)
                    }
                }

                btnModal.click()
            })
        </script>
    </body>

</html>
