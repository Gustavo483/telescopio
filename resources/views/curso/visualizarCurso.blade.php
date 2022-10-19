@extends('layouts.basico')

@section('titulo', 'unidadesCurso')

@section('conteudo')
<div>
    <div>
        <h1 class="mb-5 text-center">
            {{$NomeCurso12->st_nome_curso}}
        </h1>
    </div>
    <div>
        <h1>
            <ul>
                <li>unidades Cadastradas</li>
            </ul>
        </h1>
    </div>

    <div class="d-block">
        <table class="mb-5">
            <tr class="border12">
                <th class="border12">Nome Unidade</th>
                <th class="border12">visualizar unidade</th>
                <th class="border12">excluir unidade do curso</th>
            </tr>
            @if($Unidades != 'nenhum curso cadastrado')
                @foreach($Unidades as $Unidade)
                    <tr class="border12">
                        <td class="border12">
                            {{$Unidade->st_nome_unidade}}
                        </td>
                        <td class="border12">
                            <a href="{{route('vizualizar.unidade',['unidade'=>$Unidade->id])}}">
                                visualizar
                            </a>
                        </td>
                        <td class="border12">
                            <a href="{{route('excluir.unidadeDoCurso',['UnidadeId'=>$Unidade->id,'CursoId'=>$NomeCurso12->id,'UnidadeNome'=>$Unidade->st_nome_unidade])}}">
                                excluir
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endif

        </table>
    </div>

    <div>
        <h1>
            <ul>
                <li>Cadastrar unidade já existente no banco para este curso</li>
            </ul>
        </h1>
        <form action="{{route('Unidade.VincularCursoUnidade')}}" method="post">
            @csrf
                <select id="select1"  name="DadosParaSalvar" class="form-control">
                    <option value="null">Selecione</option>
                    @foreach ($todasUnidades as $UmaUnidade)
                        <option value="{{$NomeCurso12->id}}-and12897*-{{$UmaUnidade->id}}">
                            {{$UmaUnidade->st_nome_unidade}}
                        </option>
                    @endforeach
                </select>

            <button class="mt-3 mb-3 " id="button1" type="submit">cadastrar unidade</button>
        </form>

    </div>

    <div class="mt-5 mb-5">
        <h1>Criar nova unidade e vincula-la a este curso</h1>
        <div class="divCadastroCurso">
            <form action="{{route('unidade.storeVinculacao',['IDCurso'=>$NomeCurso12->id])}}" method="post">
                @csrf
                <div class="d-flex justify-content-start">
                    <div>
                        digite o nome da nova unidade:
                    </div>
                    <div class="ms-5">
                        <input type="text" name="st_nome_unidade" value="{{ old('st_nome_unidade') }}" placeholder="Digite o nome da unidade">
                    </div>
                </div>
                <div>
                    {{ $errors->has('st_nome_unidade') ? $errors->first('st_nome_unidade') : '' }}
                </div>
                <button type="submit">Cadastrar</button>
            </form>
        </div>
    </div>

</div>


@endsection





