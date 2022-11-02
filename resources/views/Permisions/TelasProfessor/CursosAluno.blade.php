@extends('layouts.basico')

@section('titulo', 'HomeProfessor')

@section('conteudo')
    <h3 class="mt-5">Painel do professor> {{$IDCurso->st_nome_curso}} > {{$Aluno->st_nome_aluno}} </h3>
    <div>
        <h6 class="text-center mt-4">Aqui vai ficar os dados do aluno(Criar a tabela e relacionamento)</h6>
    </div>
    <div class="d-flex justify-content-between mt-5">
        <div>
            <a href="{{route('atividadesAluno.professor',['Aluno'=>$Aluno,'IDCurso'=>$IDCurso,'IDProfessor'=>$IDProfessor])}}">
                Atividades
            </a>
        </div>
        <div>
            <a href="{{route('CursosAluno.professor',['Aluno'=>$Aluno,'IDCurso'=>$IDCurso,'IDProfessor'=>$IDProfessor])}}">
                Cursos
            </a>
        </div>
        <div>
            <a href="{{route('ProgressoAluno.professor',['Aluno'=>$Aluno,'IDCurso'=>$IDCurso,'IDProfessor'=>$IDProfessor])}}">
                Progresso
            </a>
        </div>
        <div>
            <a href="{{route('TarefasAluno.professor',['Aluno'=>$Aluno,'IDCurso'=>$IDCurso,'IDProfessor'=>$IDProfessor])}}">
                Tarefas
            </a>
        </div>
    </div>

    <h6 class="text-center mt-5">Cursos</h6>
    <div>
        <h6>Em progresso:</h6>
    </div>
    <ul class="">
        @foreach($porcentagens as $dados)
            <li class="mt-3">
                <div class="d-flex">
                    <div class="me-5">
                        {{$dados[0]}}
                    </div>
                    <div class="ms-5">
                        porcentagem: {{$dados[1]}}
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

    <h1 class="text-center mt-5">Cadastrar novo curso para o aluno</h1>

    <div class=" bg-danger text-center">
        {{ $errors->has('cursos') ? $errors->first('cursos') : '' }}
    </div>
    <div class="d-flex justify-content-center">
        <form method="post" action="{{route('VincularAlunoCurso.professor',['Aluno'=>$Aluno,'IDCurso'=>$IDCurso,'IDProfessor'=>$IDProfessor])}}">
            @csrf
            <div class="text-end mt-5">
                <button type="submit" >Submit</button>
            </div>

            <table class="">
                <thead>
                <tr>
                    <th class="p-4">
                        #
                    </th>
                    <th class="p-4">
                        Nome do Curso
                    </th >
                    <th class="p-4">selecionar curso</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($CursoParaCadastrarAluno as $curso)
                    <tr>
                        <td class="text-center">
                            {{$curso->id}}
                        </td>
                        <td class="text-center">
                            {{$curso->st_nome_curso}}
                        </td>
                        <td class="text-center">
                            <input type="checkbox" name="cursos[]" value="{{$curso->id}}">
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </form>
    </div>


@endsection
