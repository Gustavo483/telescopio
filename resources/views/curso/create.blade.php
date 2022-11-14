@extends('layouts.basico')

@section('titulo', 'NovoCurso')

@section('conteudo')
    <div class="bg-primary">
        <form action="{{route('curso.store')}}" method="post">
            @csrf
            <input type="text" name="st_nome_curso" value="{{ $curso->st_nome_curso?? old('st_nome_curso') }}" placeholder="Digite o nome do curso">
            <select id="select1"  name="DadosParaSalvar" class="form-control">
                <option value="null">Selecione</option>
                @foreach ($todasUnidades as $UmaUnidade)
                    <option value="{{$NomeCurso12->id}}">
                        {{$UmaUnidade->st_nome_unidade}}
                    </option>
                @endforeach
            </select>

            <div>
                {{ $errors->has('st_nome_curso') ? $errors->first('st_nome_curso') : '' }}
                {{ $errors->has('st_nome_disciplinas') ? $errors->first('st_nome_disciplinas') : '' }}
            </div>

        </form>
    </div>
@endsection
