@extends('layouts.basico')

@section('titulo', 'HomeAdmin')

@section('conteudo')
    <div class="flexPAluno mt-3 ">
        <h4 class="h4Pets">
            Painal do Administrador > Vincular curso e aluno
        </h4>
        <a href="{{route('inicio.pagina')}}" class="btnVoltar">
            Voltar
        </a>
    </div>

    <div class="mt-5 ">
        <div class="flexRegisterAluno mb-5">
            <div class="FormCadastro">
                <form action="{{route('VincularAlunoCurso')}}" method="post">
                    @csrf
                    <div class="hsd2">
                        <h4>Cadastrar curso para um aluno</h4>
                    </div>
                    <div class="p-3">
                        <div>
                            <label class="form-label mt-2" for="name"> Selecione o aluno: </label>
                            <select class="js-example-tags form-control"  name="id_aluno">
                                <option value="">Selecione</option>
                                @foreach ($alunos as $aluno)
                                    <option value="{{$aluno->id}}">
                                        {{$aluno->st_nome_aluno}}
                                    </option>
                                @endforeach
                            </select>
                            <div class="errosd">
                                {{ $errors->has('id_aluno') ? $errors->first('id_aluno') : '' }}
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

                        <div class="mt-4 mb-3 d-flex justify-content-center">
                            <button class="btnVoltar4" type="submit">Cadastrar cursos</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
