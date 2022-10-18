@extends('layouts.basico')

@section('titulo', 'home')

@section('conteudo')


    <div class="mt-5">
        <a href="{{route('curso.index')}}">
            cursos
        </a>
    </div>
    <div class="mt-5">
        <a href="{{route('unidade.index')}}">
            unidade
        </a>
    </div>

@endsection
