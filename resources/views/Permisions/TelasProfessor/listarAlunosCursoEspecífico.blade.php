@extends('layouts.basico')

@section('titulo', 'HomeProfessor')

@section('conteudo')
    <div class="flexPAluno mt-3 ">
        <h4 class="h4Pets">
            Painal do professor > Cursos > {{$curso->st_nome_curso}}
        </h4>
        <a href="{{route('inicio.pagina')}}" class="btnVoltar">
            Voltar
        </a>
    </div>
    <h3 class="text-center mt-5 h4Pets">Alunos cadastrados no curso</h3>
    <table id="table2" class="w-100 mt-4">
        <thead>
            <tr>
                <th class="tamanhoListarAluno text-center p-2">Nome aluno</th>
                <th class="tamanhoListarAluno text-center p-2">E-mail</th>
                <th class="tamanhoListarAluno2 text-center p-2">Ult. acesso</th>
                <th class="tamanhoListarAluno2 text-center p-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alunos as $aluno)
                <tr>
                    <td class="text-center p-2">{{$aluno->st_nome_aluno}}</td>
                    <td class="text-center p-2">{{$aluno->users->email}}</td>
                    <td class="text-center p-2">{{date_format($aluno->updated_at,"d/m/Y  H:i")}}</td>
                    <td class="text-center p-3">
                        <a class="linkHomeVisualizarAluno" href="{{route('vizualizarProgressoAluno.Professor', ['IDCurso'=>$curso->id, 'IDProfessor'=>$IDProfessor,'alunos'=>$aluno->id])}}">
                            vizualizar progresso
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
