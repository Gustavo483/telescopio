@extends('layouts.basico2')

@section('titulo', 'HomeAluno')

@section('conteudo2')
    <div class="container mt-5 text-center">
        {!!$texto->st_texto!!}
    </div>
    <div class="divEspacamento"></div>
@endsection
