@extends('layouts.basico')

@section('titulo', 'HomeProfessor')

@section('conteudo')
    <h1 class="text-center mt-5">Alunos cadastrados no curso {{$curso->st_nome_curso}}</h1>
        <table>
            <thead>
                <tr>
                    <th class="p-4">#</th>
                    <th class="p-4">Nome aluno</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alunos as $aluno)
                    <tr>
                        <td class="p-4">
                            {{$aluno->id}}
                        </td>
                        <td class="p-4">
                            <a href="{{route('vizualizarProgressoAluno.Professor', ['IDCurso'=>$curso->id, 'IDProfessor'=>$IDProfessor,'alunos'=>$aluno->id])}}">
                                {{$aluno->st_nome_aluno}}
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </table>
@endsection
