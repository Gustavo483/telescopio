@extends('layouts.basico')

@section('titulo', 'Registro Professor')

@section('conteudo')
    <div class="flexPAluno mt-3 ">
        <h4 class="h4Pets">
            Painal do Administrador > {{$Admin->st_nome_admin}} > Cadastro de professor
        </h4>
        <a href="{{route('inicio.pagina')}}" class="btnVoltar">
            Voltar
        </a>
    </div>
    <div class="flexRegisterAluno mb-5">
        <div class="FormCadastro">
            <form action="{{route('RegistrarProfessorStore')}}" method="post">
                @csrf
                <div class="hsd2">
                    <h4>Dados Cadastrais:</h4>
                </div>
                <div class="p-3">
                    <label class="form-label mt-2" for="name"> Digite o nome:</label>
                    <input class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="Digite o nome do professor:">
                    <div class="errosd">
                        {{ $errors->has('name') ? $errors->first('name') : '' }}
                    </div>

                    <label class="form-label mt-2 " for="name"> Digite o e-mail:</label>
                    <input class="form-control" type="text" name="email" value="{{ old('email') }}" placeholder="Digite o email:">
                    <div class="errosd">
                        {{ $errors->has('email') ? $errors->first('email') : '' }}
                    </div>

                    <label class="form-label mt-2" for="name"> Digite a senha:</label>
                    <input class="form-control" type="text" name="password" value="{{ old('password') }}" placeholder="Digite a senha:">
                    <div class="errosd">
                        {{ $errors->has('password') ? $errors->first('password') : '' }}
                    </div>

                    <div class="d-flex justify-content-center align-items-center my-4">
                        <button class="btnVoltar4" type="submit">Cadastrar professor</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
