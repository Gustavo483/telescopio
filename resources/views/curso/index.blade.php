@extends('layouts.basico')

@section('titulo', 'unidades')

@section('conteudo')

    <div class="">
        <div>
            <h1 class="text-center">Cadastrar novo Curso</h1>
        </div>
        <div class="divCadastroCurso">
            <form action="{{route('curso.store')}}" method="post">
                @csrf
                <div class="d-flex justify-content-start">
                    <div>
                        Digite o nome do novo curso:
                    </div>
                    <div class="ms-5">
                        <input type="text" name="st_nome_curso" value="{{ $curso->st_nome_curso?? old('st_nome_curso') }}" placeholder="Digite o nome do curso">
                    </div>
                </div>
                <div class="d-flex justify-content-start">
                    <div>
                        Selecione a disciplina do curso:
                    </div>
                    <select id="select1"  name="st_nome_disciplinas" class="">
                        <option value="null">Selecione</option>
                        @foreach ($DisciplinasCadastradas as $DisciplinaCadastrada)
                            <option value="{{$DisciplinaCadastrada->st_nome_disciplinas}}">
                                {{$DisciplinaCadastrada->st_nome_disciplinas}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <h3 class="text-center">Cadastro de nova disciplina</h3>
                    <div>
                        <form method="post" action="{{route('SalvarNovaDisciplina.Curso')}}">
                            @csrf
                            <input type="text" name="st_nome_disciplinas" value="{{ $curso->st_nome_disciplinas?? old('st_nome_disciplinas') }}" placeholder="Digite o nome da disciplina">
                        </form>
                    </div>
                </div>

                <div>
                    {{ $errors->has('st_nome_curso') ? $errors->first('st_nome_curso') : '' }}
                </div>
                <div>
                    {{ $errors->has('st_nome_disciplinas') ? $errors->first('st_nome_disciplinas') : '' }}
                </div>
                <button type="submit">Cadastrar</button>
            </form>
        </div>
    </div>

    <div>
        <h1 class="text-center mt-5">Cursos existentes</h1>
    </div>
    <div>
        @foreach($cursos as $curso)

            <ul>
                <li>
                    <a href="{{ route('vizualizar.Curso', ['curso' => $curso->id]) }}">
                        {{$curso->st_nome_curso}}
                    </a>
                </li>
            </ul>
        @endforeach
    </div>
@endsection
