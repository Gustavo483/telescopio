@extends('layouts.basico')

@section('titulo', 'revisao')

@section('conteudo')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div id="div233" class="">
        <h5 class="text-center">
            Cadastrar forma de revisão
        </h5>
        <form action="{{route('CadastrarFormadeRevisao', ['revisao'=>$Revisao->id])}}" method="post" >
            @csrf
            <label for="ordemCursoApresentar mt-3">Digite a ordem de curso para fazer o teste</label>
            <input class="form-control mt-2" type="number" name="ordemCursoApresentar" value="{{$Revisao->ordemCursoApresentar ?? old('ordemCursoApresentar') }}">
            <div class="text-dange">
                {{ $errors->has('ordemCursoApresentar') ? $errors->first('ordemCursoApresentar') : '' }}
            </div>

            <label for="NumerosQuestao mt-3">Digite o número de questões </label>
            <input class="form-control mt-2" type="number" name="NumerosQuestao" value="{{$Revisao->NumerosQuestao ?? old('NumerosQuestao') }}">
            <div class="text-dange">
                {{ $errors->has('NumerosQuestao') ? $errors->first('NumerosQuestao') : '' }}
            </div>
            <button type="submit">enviar</button>
        </form>
    </div>
@endsection
