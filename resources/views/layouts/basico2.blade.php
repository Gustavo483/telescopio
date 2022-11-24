<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>@yield('titulo')</title>
    <!--<title> Drop Down Sidebar Menu | CodingLab </title>-->
    <link rel="stylesheet" href="{{ asset('css/sidebar.css')}}">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="sidebar close">
    <ul class="nav-links">
        @for($i = 0; $i < $contadorUnidades; $i++)
            <li>
                @foreach($nomeConteudo0 as $NomeConteudo)
                    @if($i == 0)
                        <div class="iocn-link">
                            <a href="#">
                                <i class='bx bx-collection' ></i>
                                <span class="link_name">{{$NomeConteudo}}</span>
                            </a>
                            <i class='bx bxs-chevron-down arrow' ></i>
                        </div>
                        <ul class="sub-menu">
                            @foreach($PrimeiroDadoParaApresentar as $dados)
                                <li>
                                    <a class="link_name" href="{{route('Aluno.MostrarExercicio',['IdAluno'=>$dados[0],'idConteudo'=>$dados[1],'IdCronograma'=>$dados[6],'tipoAtividade'=>$dados[5], 'IdCurso'=>$IdCurso ])}}">
                                        {{$dados[5]}}
                                    </a>
                                </li>

                            @endforeach
                        </ul>
                    @endif
                @endforeach
            </li>
        @endfor


        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class='bx bx-book-alt' ></i>
                    <span class="link_name">Posts</span>
                </a>
                <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Posts</a></li>
                <li><a href="#">Web Design</a></li>
                <li><a href="#">Login Form</a></li>
                <li><a href="#">Card Design</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-pie-chart-alt-2' ></i>
                <span class="link_name">Analytics</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Analytics</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-line-chart' ></i>
                <span class="link_name">Chart</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Chart</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class='bx bx-plug' ></i>
                    <span class="link_name">Plugins</span>
                </a>
                <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Plugins</a></li>
                <li><a href="#">UI Face</a></li>
                <li><a href="#">Pigments</a></li>
                <li><a href="#">Box Icons</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-compass' ></i>
                <span class="link_name">Explore</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Explore</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-history'></i>
                <span class="link_name">History</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">History</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-cog' ></i>
                <span class="link_name">Setting</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Setting</a></li>
            </ul>
        </li>
        <li>
            <div class="profile-details">
                <div class="profile-content">
                    <!--<img src="image/profile.jpg" alt="profileImg">-->
                </div>
                <div class="name-job">
                    <div class="profile_name">Prem Shahi</div>
                    <div class="job">Web Desginer</div>
                </div>
                <i class='bx bx-log-out' ></i>
            </div>
        </li>
    </ul>
</div>
<section class="home-section">
    <div class="home-content">
        <i class='bx bx-menu'></i>
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
    let sidebarBtn = document.querySelector(".bx-menu");
    console.log(sidebarBtn);
    sidebarBtn.addEventListener("click", ()=>{
        sidebar.classList.toggle("close");
    });
</script>
</body>
</html>

