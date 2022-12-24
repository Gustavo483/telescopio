@extends('layouts.basicoProfessor')

@section('titulo', 'Histórico')
@section('infoPágina', 'Painel do professor > '.$IDCurso->st_nome_curso.' > '.$Aluno->st_nome_aluno.' > Cursos')

@section('conteudo')
    <!-- Button trigger modal -->
    <button id="btntessdx" type="button" class="none" data-bs-toggle="modal" data-bs-target="#exampleModal">
        enviar
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Salvar Cursos para o Aluno {{$Aluno->st_nome_aluno}}</h5>
                    <button id="FecharModal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 class="h4Pets ">Cursos Selecionados:</h6>
                    <div id="divModal">

                    </div>
                </div>
                <div class="modal-footer">
                    <button id="FecharModal2"  type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button id="SalvarCursosModal" type="button" class="btn btn-primary">Salvar Cursos</button>
                </div>
            </div>
        </div>
    </div>

    <div>
        <button id="AbrirDivCadastrarCurso" class="btnVoltar3" type="button"> <span id="dcsdcsqw22" class="dcsdcsqw">Cadastrar Novo Curso </span></button>
    </div>

    <div id="DivCadastrarCurso" class="none">
        <h4 class="text-center mt-5 h4Pets">Cadastrar novo curso para o aluno</h4>

        <div class=" mt-5 mb-5">
            <div class="w-50 masds d-flex justify-content-end">
                <button id="CadastrarCurso" class="btnVoltar2"> Salvar</button>
            </div>
        </div>

        <div class="d-flex justify-content-center espacamento">
            <div class="w-50">
                <form method="post" action="{{route('VincularAlunoCurso.professor',['Aluno'=>$Aluno,'IDCurso'=>$IDCurso,'IDProfessor'=>$IDProfessor])}}">
                    @csrf

                    <table id="myTable" class="100%">
                        <thead>
                        <tr>
                            <th class="p-4">
                                Nome do Curso
                            </th >
                            <th class="p-4">selecionar curso</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($CursoParaCadastrarAluno as $curso)
                            @if(! in_array($curso->st_nome_curso, $arrayDados))
                                <tr>
                                    <td id="Curso{{$curso->st_nome_curso}}" class="text-center">
                                        {{$curso->st_nome_curso}}
                                    </td>
                                    <td class="text-center">
                                        <input class="checkboxCursos" type="checkbox" name="cursos[]" value="{{$curso->id}}@Asd24{{$curso->st_nome_curso}}">
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    <button id="CadastrarCurso2" class="none" type="submit"> enviar</button>
                </form>
            </div>
        </div>
    </div>

    <div id="CursosCadastrados" class="espacamento">
        <h4 class="text-center mt-5 h4Pets mb-5">Cursos cadastrados para o aluno</h4>
        <div class="d-flex justify-content-center">
            <table id="table2" class="text-center mb-5">
                <thead>
                <tr>
                    <th class="p-4">Curso</th>
                    <th class="p-4">Porcentagem</th>
                </tr>
                </thead>
                <tbody>
                @foreach($porcentagens as $dados)
                    <tr>
                        <td class="p-4">{{$dados[0]}}</td>
                        <td class="p-4">{{$dados[1]}}%</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection




