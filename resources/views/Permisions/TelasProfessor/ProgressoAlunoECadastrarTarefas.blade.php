@extends('layouts.basicoProfessor')

@section('titulo', 'Histórico')
@section('infoPágina', 'Painel do professor > '.$IDCurso->st_nome_curso.' > '.$dadosAluno->st_nome_aluno.' > Progresso')

@section('conteudo')

    <h4 class="text-center mt-5 h4Pets">Progresso do aluno no curso "{{$porcentagemCurso[0][0]}}"</h4>

    <div>
        <table id="TableProgresso" class="w-100 mt-4 mb-5">
            <thead>
                <tr>
                    <th class="text-center">nome do dado</th>
                    <th class="text-center">porcentagem</th>
                    <th class="text-center">data de realização</th>
                    <th class="text-center">estrelas obtidas</th>
                    <th class="text-center">adicionar tarefa</th>
                </tr>
            </thead>
            <tbody>
                @foreach($porcentagemCurso as $PorcentagemCurso)
                    <tr class="teestr">
                        <td class="">{{$PorcentagemCurso[0]}}</td>
                        <td class="text-center">{{$PorcentagemCurso[1]}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach($PorcentagensUnidadeApresentar as $PorcentagemUnidade )
                        @if($PorcentagemUnidade[0] == $PorcentagemCurso[0])
                            <tr class="espacamento50 trUnidade" >
                                <td class="espacamento50">{{$PorcentagemUnidade[1]}}</td>
                                <td class="text-center">{{$PorcentagemUnidade[2]}}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @foreach($porcentagemConteudos as $dado)
                                @foreach($dado as $d)
                                    @if($d[1] == $PorcentagemUnidade[1] )
                                        <tr>
                                            <td class="espacamento100">{{$d[2]}}</td>
                                            <td class="text-center">{{$d[3]}}</td>
                                            <td class="text-center">
                                                {{$d[5]}}
                                            </td>
                                            <td class="text-center">
                                                {{$d[6]}}
                                            </td>
                                            <td class="text-center">
                                                @if($d[4] == 1)
                                                    <form method="post" action="{{route('CadastrarAtividadeAluno.professor',['Aluno'=>$Aluno,'IDCurso'=>$IDCurso,'IDProfessor'=>$IDProfessor,'IDUnidade'=>$PorcentagemUnidade[3],'IDConteudo'=>$d[7]])}}">
                                                        @csrf
                                                        <div class="d-flex justify-content-center">
                                                            <input class="p-2" name="data" type="date">
                                                            <button type="submit" class="btn btn-primary">
                                                                +
                                                            </button>
                                                        </div>
                                                    </form>
                                                @endif
                                                @if($d[4] == 0)
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        @endif
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
