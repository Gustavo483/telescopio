<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>@yield('titulo')</title>
    <!--<title> Drop Down Sidebar Menu | CodingLab </title>-->
    <link rel="stylesheet" href="{{ asset('css/sidebar.css')}}">
    <link rel="stylesheet" href="{{ asset('css/body.css')}}">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="sidebar close">
    <div class="logo-details pt-3 tessdfsd1234">
        <i class=' '>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
            </svg>
        </i>
        <span class="logo_name">{{$porcentagens[0]}}</span>
    </div>
    <ul class="nav-links">
        <li class="testre2">
            <a class="" href="#">
                <span class="link_name2 sdsd ">
                    <div style="width:{{$porcentagens[1]}}%" class="bg-success"> {{$porcentagens[1]}}%</div>
                </span>
            </a>
        </li>

        @for($i = 0; $i < $contadorUnidades; $i++)
            @if(in_array($IDsUnidades[$i]->st_nome_unidade,$nomeUnidadeSemSubmit))
                <li class="">
                    <a href="#">
                        <i class= >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journals" viewBox="0 0 16 16">
                                <path d="M5 0h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2 2 2 0 0 1-2 2H3a2 2 0 0 1-2-2h1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1H1a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v9a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1H3a2 2 0 0 1 2-2z"/>
                                <path d="M1 6v-.5a.5.5 0 0 1 1 0V6h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V9h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 2.5v.5H.5a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1H2v-.5a.5.5 0 0 0-1 0z"/>
                            </svg>
                        </i>
                        <span class="link_name dfdfdc"> {{$IDsUnidades[$i]->st_nome_unidade}}</span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a class="link_name " href="#">{{$IDsUnidades[$i]->st_nome_unidade}}</a></li>
                    </ul>
                </li>
            @endif

            @if(! in_array($IDsUnidades[$i]->st_nome_unidade,$nomeUnidadeSemSubmit))
                <li class="">
                    <a href="#">
                        <i class= >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journals" viewBox="0 0 16 16">
                                <path d="M5 0h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2 2 2 0 0 1-2 2H3a2 2 0 0 1-2-2h1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1H1a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v9a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1H3a2 2 0 0 1 2-2z"/>
                                <path d="M1 6v-.5a.5.5 0 0 1 1 0V6h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V9h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 2.5v.5H.5a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1H2v-.5a.5.5 0 0 0-1 0z"/>
                            </svg>
                        </i>
                        <span class="link_name">{{$IDsUnidades[$i]->st_nome_unidade}}</span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="#">{{$IDsUnidades[$i]->st_nome_unidade}}</a></li>
                    </ul>
                </li>
            @endif
            <li class="ddfdfd">
                @foreach($nomeConteudo0 as $NomeConteudo)
                    @if($i == 0)
                        <div class="iocn-link">
                            <a href="#">
                                <i class='' >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                    </svg>
                                </i>
                                <span class="link_name">{{$NomeConteudo}}</span>
                            </a>
                            <i class='bx bxs-chevron-down arrow' ></i>
                        </div>
                        <ul class="sub-menu">
                            <li><a class="link_name" href="#">{{$NomeConteudo}}</a></li>
                            @foreach($PrimeiroDadoParaApresentar as $dados)
                                <li class="d-flex justify-content-center ">
                                    <div>
                                        <a class="" href="{{route('Aluno.MostrarExercicio',['IdAluno'=>$dados[0],'idConteudo'=>$dados[1],'IdCronograma'=>$dados[6],'tipoAtividade'=>$dados[5], 'IdCurso'=>$IdCurso ])}}">
                                            {{$dados[5]}}
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                @endforeach
            </li>
            @foreach($DadosConteudos as $NomeConteudo)
                <li class="">
                    @if(in_array($NomeConteudo->st_nome_conteudo,$NomeConteudoSemSubmit))
                        @if($IDsUnidades[$i]->id == $NomeConteudo->fk_unidade and $NomeConteudo->st_nome_conteudo != $nomeConteudo0[0] )
                            <div class="iocn-link badf">
                                <a href="#">
                                    <i class='' >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                        </svg>
                                    </i>

                                    <span class="link_name">{{$NomeConteudo->st_nome_conteudo}}</span>
                                </a>
                                <i class='bx bxs-chevron-down arrow' ></i>
                            </div>
                        @endif
                    @endif

                    @if(! in_array($NomeConteudo->st_nome_conteudo,$NomeConteudoSemSubmit))
                        @if($IDsUnidades[$i]->id == $NomeConteudo->fk_unidade and $NomeConteudo->st_nome_conteudo != $nomeConteudo0[0] )
                            <div class="iocn-link">
                                <a href="#">
                                    <i class='' >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                        </svg>
                                    </i>
                                    <span class="link_name">{{$NomeConteudo->st_nome_conteudo}}</span>
                                </a>
                                <i class='bx bxs-chevron-down arrow' ></i>
                            </div>
                            <ul class="sub-menu">
                                <li class=""><a class="link_name" href="#">{{$NomeConteudo->st_nome_conteudo}}</a></li>
                                @foreach($DadosParaApresentar as $dados)
                                    @if($dados[2] == $NomeConteudo->st_nome_conteudo and $NomeConteudo->fk_unidade == $dados[8])
                                        @if($dados[7] == 0)
                                            <li class="d-flex justify-content-center NaoFezAtividades ">
                                                <div>
                                                    <div class="sdsdsdsd">
                                                        {{$dados[5]}}
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                        @if($dados[7] != 0)
                                            <li class="d-flex justify-content-center ">
                                                <div>
                                                    <a class="" href="{{route('Aluno.MostrarExercicio',['IdAluno'=>$dados[0],'idConteudo'=>$dados[1],'IdCronograma'=>$dados[6],'tipoAtividade'=>$dados[5], 'IdCurso'=>$IdCurso ])}}">
                                                        {{$dados[5]}}
                                                    </a>
                                                </div>

                                            </li>
                                        @endif
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    @endif
                </li>
            @endforeach
        @endfor
    </ul>
</div>
<section class="home-section">
    <div class="home-content">
        <div class="container3232">
            <div class="dccdc">
                <div class="flex32">
                    <div style="height: 80px" class="flex32">
                        {{$IdAluno->st_nome_aluno}}
                    </div>
                    <div>
                        <form id="sdsd" method="post" action="{{route('logout')}}">
                            @csrf
                            <a class="linkedel" href="#" onclick="document.getElementById('sdsd').submit()">
                                encerrar cessão
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="conteiner2 mt-3">
            <div>
                @if(isset($mensagemSucess))
                    <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
                        {{$mensagemSucess}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(isset($mensagemErro))
                    <div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">
                        {{ $mensagemErro }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            <div>
                @yield('conteudo2')
            </div>
        </div>

    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script>
    let arrow = document.querySelectorAll(".arrow");
    for (var i = 0; i < arrow.length; i++) {
        arrow[i].addEventListener("click", (e)=>{
            let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
            arrowParent.classList.toggle("showMenu");
        });
    }
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".tessdfsd1234");
    console.log(sidebarBtn);
    sidebarBtn.addEventListener("click", ()=>{
        sidebar.classList.toggle("close");
    });
</script>
</body>
</html>
