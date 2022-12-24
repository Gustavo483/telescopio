@extends('layouts.basico')

@section('titulo', 'Listar alunos cursos')

@section('conteudo')
    <div class="flexPAluno mt-3 ">
        <h4 class="h4Pets">
            Painal do Administrador > cursos do aluno {{$aluno->st_nome_aluno}}
        </h4>
        <a href="{{route('listarAlunosCursos')}}" class="btnVoltar">
            Voltar
        </a>
    </div>

    <h3 class="text-center mt-5 h4Pets">Cursos cadastrados para o aluno</h3>
    <table id="myTable" class="w-100 mt-4">
        <thead>
        <tr>
            <th class="tamanhoListarAluno text-center p-2">Nome do Curso</th>
            <th class="tamanhoListarAluno text-center p-2">Porcentagem </th>
            <th class="tamanhoListarAluno2 text-center p-2">Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cursos as $curso)
            <tr>
                <td class="text-center p-2">{{$curso[1]}}</td>
                <td class="text-center p-2">{{$curso[2]}}%</td>
                <td class="text-center p-3">
                    <form id="form_{{$aluno->id}}{{$curso[0]}}" method="post" action="{{route('deleteAlunoCurso',['aluno'=>$aluno->id, 'curso'=>$curso[0]])}}">
                        @method('DELETE')
                        @csrf
                        <a class="linkedel" href="#" onclick="document.getElementById('form_{{$aluno->id}}{{$curso[0]}}').submit()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="red" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </a>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
