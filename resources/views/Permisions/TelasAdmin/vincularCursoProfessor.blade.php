@extends('layouts.basico')

@section('titulo', 'Vincular curso professor')

@section('conteudo')
    <div class="flexPAluno mt-3">
        <h4 class="h4Pets">
            Painal do Administrador > Vincular curso e professor
        </h4>
        <a href="{{route('inicio.pagina')}}" class="btnVoltar">
            Voltar
        </a>
    </div>

    <div class="mt-5">
        <div class="flexRegisterAluno mb-5">
            <div class="FormCadastro">
                <form action="{{route('VincularProfessorCurso')}}" method="post">
                    @csrf
                    <div class="hsd2">
                        <h4>Cadastrar curso para um professor</h4>
                    </div>
                    <div class="p-3">
                        <div>
                            <label class="form-label mt-2" for="id_professor"> Selecione o professor: </label>
                            <select class="js-example-tags form-control"  name="id_professor">
                                <option value="">Selecione</option>
                                @foreach ($professores as $professor)
                                    <option value="{{$professor->id}}">
                                        {{$professor->st_nome_professor}}
                                    </option>
                                @endforeach
                            </select>
                            <div class="errosd">
                                {{ $errors->has('id_professor') ? $errors->first('id_professor') : '' }}
                            </div>
                        </div>
                        <div>
                            <label class="form-label mt-2" for="name"> Selecione o curso: </label>
                            <select class="js-example-tags form-control"  name="curso">
                                <option value="">Selecione</option>
                                @foreach ($cursos as $curso)
                                    <option value="{{$curso->id}}">
                                        {{$curso->st_nome_curso}}
                                    </option>
                                @endforeach
                            </select>
                            <div class="errosd">
                                {{ $errors->has('curso') ? $errors->first('curso') : '' }}
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 mb-3 d-flex justify-content-center">
                        <button class="btnVoltar4" type="submit">Cadastrar cursos</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
