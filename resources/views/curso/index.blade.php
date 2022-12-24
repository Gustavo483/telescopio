@extends('layouts.basico')

@section('titulo', 'unidades')

@section('conteudo')

    @if (count($errors->all()) >= 1)
        <div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">
            Não foi possível prosseguir com a solicitação. Verifique os dados e tente novamente
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="flexPAluno mt-3 ">
        <h4 class="h4Pets">
            Painal do Administrador > cursos
        </h4>
        <a href="{{route('inicio.pagina')}}" class="btnVoltar">
            Voltar
        </a>
    </div>

    <button id="BtnCriarCurso" class="btnVoltar3 mt-5" onclick="CriarCurso()">Criar novo curso</button>

    <div id="divCriarCurso" class="none">
        <h3 class=" mt-5 h4Pets text-center">
            Criar um novo curso
        </h3>

        <div class="flexRegisterAluno2 mb-5">
            <div class="FormCadastro">
                <form action="{{route('curso.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="hsd2">
                        <h4>Cadastro de Curso:</h4>
                    </div>
                    <div class="p-3">
                        <div class="mb-3">
                            <label class="form-label mt-2" for="name"> Digite o nome do Curso:</label>
                            <input class="form-control" type="text" name="st_nome_curso" value="{{ $curso->st_nome_curso?? old('st_nome_curso') }}" placeholder="Digite o nome do curso">
                            <div class="errosd">
                                {{ $errors->has('st_nome_curso') ? $errors->first('st_nome_curso') : '' }}
                            </div>
                        </div>

                        <div class="my-3">
                            <label class="form-label" for="inputImage">Selecione a imagem do curso:</label>
                            <input
                                type="file"
                                name="image"
                                id="inputImage"
                                class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="my-3">
                            <label class="form-label mt-2 " for="name"> Selecione a disciplina do curso:</label>
                            <select id="select1"  name="st_nome_disciplina" class="form-control">
                                <option value="">Selecione</option>
                                @foreach ($DisciplinasCadastradas as $DisciplinaCadastrada)
                                    <option value="{{$DisciplinaCadastrada->st_nome_disciplina}}">
                                        {{$DisciplinaCadastrada->st_nome_disciplina}}
                                    </option>
                                @endforeach
                            </select>
                            <div class="errosd">
                                {{ $errors->has('st_nome_disciplina') ? $errors->first('st_nome_disciplina') : '' }}
                            </div>
                        </div>

                    </div>
                    <div class="d-flex justify-content-center align-items-center mb-4">
                        <button class="btnVoltar4" type="submit">Cadastrar curso</button>
                    </div>
                </form>
            </div>

            <div class="FormCadastro">
                <form method="post" action="{{route('SalvarNovaDisciplina.Curso')}}">
                    <div class="hsd2">
                        <h4>Cadastro de Disciplina:</h4>
                    </div>
                    @csrf
                    <div class="p-3">
                        <label class="form-label mt-2 " for="name"> Selecione a disciplina do curso:</label>
                        <input class="form-control" type="text" name="st_nome_disciplina1" value="{{ $curso->st_nome_disciplina?? old('st_nome_disciplina') }}" placeholder="Digite o nome da disciplina">
                        <div class="errosd">
                            {{ $errors->has('st_nome_disciplina1') ? $errors->first('st_nome_disciplina1') : '' }}
                        </div>

                        <div class="d-flex justify-content-center align-items-center my-4">
                            <button class="btnVoltar4" type="submit">Cadastrar Disciplina</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="divApresentarCursos">
        <h3 class=" mt-5 h4Pets text-center">
            Cursos existentes
        </h3>
        <div class="mb-5">
            <table id="myTable" class="w-100">
                <thead>
                <tr>
                    <th class="p-2 w-25">
                        Img. Curso
                    </th>

                    <th class="p-2">
                        Nome do Curso
                    </th>
                    <th class="p-2">
                        quant. Unidades
                    </th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($cursos as $curso)
                    <tr>
                        <td class="p-2 text-center">
                            <img src="images/{{$curso->image }}" class="mb-2" style="width:100px;">
                        </td>
                        <td class="text-center">
                            {{$curso->st_nome_curso}}
                        </td>
                        <td class="text-center">
                            {{ count($curso->unidades)}}
                        </td>
                        <td>
                            <div class="scsda">
                                <div class="d-flex justify-content-center ps-3">
                                    <a class="hoversd" href="{{route('vizualizar.Curso',['curso'=>$curso->id])}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center ps-3">
                                <a class="hoversd" href="{{route('excluir.Curso',['curso'=>$curso->id])}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
