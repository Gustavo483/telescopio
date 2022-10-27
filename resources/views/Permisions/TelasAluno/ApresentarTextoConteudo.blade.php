@extends('layouts.basico')

@section('titulo', 'HomeAluno')

@section('conteudo')
    <div class="container mt-5 text-center">
        {{$texto->st_texto}}
    </div>
@endsection
