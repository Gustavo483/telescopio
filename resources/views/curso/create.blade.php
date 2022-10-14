@extends('layouts.basico')

@section('titulo', 'NovoCurso')

@section('conteudo')
    <div class="bg-primary">
        <form action="{{route('curso.store')}}" method="post">
            @csrf
            <input type="text" name="st_nome_curso" value="{{ $curso->st_nome_curso?? old('st_nome_curso') }}" placeholder="Digite o nome do curso">
            <div>
                {{ $errors->has('st_nome_curso') ? $errors->first('st_nome_curso') : '' }}
            </div>
        </form>
    </div>
@endsection
