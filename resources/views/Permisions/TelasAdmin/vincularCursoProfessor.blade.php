@extends('layouts.basico')

@section('titulo', 'Vincular curso professor')

@section('conteudo')
    <div>
        <a href="{{route('inicio.pagina')}}">
            voltar
        </a>
    </div>
    <div class=" mt-5 ">
        <div class="bg-danger">
            <div>
                {{ $errors->has('id_professor') ? $errors->first('id_aluno') : '' }}
            </div>
            <div>
                {{ $errors->has('cursos') ? $errors->first('cursos') : '' }}
            </div>
        </div>

        <form action="{{route('VincularProfessorCurso')}}" method="post">
            @csrf

            <div class="text-center">
                <h5>Selecione o professor e marque os cursos que ele administrará</h5>
            </div>

            <select id="select1"  name="id_professor" class="form-control">
                <option value="">Selecione</option>
                @foreach ($professores as $professor)
                    <option value="{{$professor->id}}">
                        {{$professor->st_nome_professor}}
                    </option>
                @endforeach
            </select>
            <div>
                <button type="submit">enviar</button>
            </div>
            <table>
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
                @foreach ($cursos as $curso)
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
