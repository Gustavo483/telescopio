@extends('layouts.basico')

@section('titulo', 'Registro Professor')

@section('conteudo')
    <div>
        <a href="{{route('inicio.pagina')}}">
            voltar
        </a>
    </div>
    <h1 class="text-center mt-5">
        Registro de professor
    </h1>
    <div class="w-100 h-100 mt-5 d-flex justify-content-center align-items-center">
        <form action="{{route('RegistrarProfessorStore')}}" method="post">
            @csrf
            <input class="form-control mt-2" type="text" name="name" value="{{ old('name') }}" placeholder="Digite o nome do usuario:">
            <div>
                {{ $errors->has('name') ? $errors->first('name') : '' }}
            </div>

            <input class="form-control mt-2" type="text" name="email" value="{{ old('email') }}" placeholder="Digite o email:">
            <div>
                {{ $errors->has('email') ? $errors->first('email') : '' }}
            </div>

            <input class="form-control mt-2" type="text" name="password" value="{{ old('password') }}" placeholder="Digite a senha:">
            <div>
                {{ $errors->has('password') ? $errors->first('password') : '' }}
            </div>

            <input class="form-control mt-2" type="number" name="permision" value="{{ old('permision') }}" placeholder="Digite o número de permissão do usuário:">

            <div>
                {{ $errors->has('permision') ? $errors->first('permision') : '' }}
            </div>
            <button type="submit">enviar</button>
        </form>
    </div>
@endsection
