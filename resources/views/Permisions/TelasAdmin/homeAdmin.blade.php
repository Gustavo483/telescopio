@extends('layouts.basico')

@section('titulo', 'HomeAdmin')

@section('conteudo')
    <div class="flexPAluno mt-3 ">
        <h4 class="h4Pets">
            Painal do Administrador > {{$Admin->st_nome_admin}}
        </h4>
    </div>
    <div class="divApresentarHome my-3">
        <div class="cadastro">
            <h5>Cadastrar usuários</h5>
        </div>
        <div class="fles12 p-2 ">
            <div class="divLinksHomeAdmin m-3">
                <a class="block" href="{{route('registerAluno', ['Admin'=> $Admin->id])}}">
                    Aluno
                </a>
            </div>

            <div class="divLinksHomeAdmin m-3">
                <a class=" block" href="{{route('registerProfessor',['Admin'=> $Admin->id] )}}">
                    Professor
                </a>
            </div>

            <div class="divLinksHomeAdmin m-3">
                <a class=" block" href="{{route('registerAdmin',['Admin'=> $Admin->id] )}}">
                    Admin
                </a>
            </div>
        </div>
    </div>



    <div class="divApresentarHome my-5">
        <div class="cadastro">
            <h5>Cadastro de cursos e vinculações</h5>
        </div>

        <div class="fles12 p-2">
            <div class="divLinksHomeAdmin m-3">
                <a class="block"  href="{{route('curso.index')}}">
                    cursos
                </a>
            </div>

            <div class="divLinksHomeAdmin m-3">
                <a class="block"  href="{{route('unidade.index')}}">
                    unidade
                </a>
            </div>
            <div class="divLinksHomeAdmin m-3">
                <a class=" block" href="/AlunoCurso">
                    Vincular curso e aluno
                </a>
            </div>

            <div class="divLinksHomeAdmin m-3">
                <a class=" block" href="{{route('ProfessorCurso')}}">
                    Vincular curso e professor
                </a>
            </div>
        </div>

        <div class="fles123">
            <div class="divLinksHomeAdmin m-3">
                <a class="block" href="{{route('listarAlunosCursos')}}">
                    listar Alunos
                </a>
            </div>

            <div class="divLinksHomeAdmin m-3">
                <a class=" block" href="{{route('listarprofessoresCursos')}}">
                    listar Professor
                </a>
            </div>
        </div>
    </div>

    <div class="divApresentarHome my-5">
        <div class="cadastro">
            <h5>Cadastros e vizualizações</h5>
        </div>

        <div class="fles12 p-2">
            <div class="divLinksHomeAdmin m-3">
                <a class="block" href="{{route('CadastrarTrofeus')}}">
                    trofeus
                </a>
            </div>

            <div class="divLinksHomeAdmin m-3">
                <a class="block" href="{{route('revisaoForma')}}">
                    forma de revisao
                </a>
            </div>

            <div class="divLinksHomeAdmin m-3">
                <a class="block" href="{{route('vizualizarPets')}}">
                    Pets
                </a>
            </div>
        </div>
    </div>

@endsection
