@extends('layouts.basico')

@section('titulo', 'Listar alunos cursos')

@section('conteudo')
    <div>
        <table>
            <thead>
            <tr>
                <th class="p-4">#</th>
                <th class="p-4">Nome professor</th>
                <th class="p-4">Nome do curso</th>
                <th class="p-4">Excluir curso do aluno</th>
            </tr>
            </thead>
            <tbody>
            @foreach($dados as $dado)
                @foreach($dado->cursos as $values)
                    <tr>
                        <td class="text-center">
                            {{$dado->id}}
                        </td>
                        <td class="text-center">
                            {{$dado->st_nome_professor}}
                        </td>
                        <td class="text-center">
                            {{$values->st_nome_curso}}
                        </td>
                        <td>
                            <form id="form_{{$dado->id}}{{$values->id}}" method="post" action="{{route('deleteProfessorCurso',['professor'=>$dado->id, 'curso'=>$values->id])}}">
                                @method('DELETE')
                                @csrf
                                <a class="linkedel" href="#" onclick="document.getElementById('form_{{$dado->id}}{{$values->id}}').submit()">
                                    excluir
                                </a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
