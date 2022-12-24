@extends('layouts.basicoProfessor')

@section('titulo', 'Histórico')
@section('infoPágina', 'Painel do professor > '.$Aluno->st_nome_aluno.' > Progresso')

@section('conteudo')
    <div class="mb-5">
        <table id="TableProgresso2" class="w-100 mt-4 mb-5">
            <thead>
            <tr>
                <th class="text-center">Nome do dado</th>
                <th class="text-center">Porcentagem</th>
                <th class="text-center">Data de realização</th>
                <th class="text-center">Estrelas obtidas</th>
                <th class="text-center">Adicionar tarefa</th>
            </tr>
            </thead>
            <tbody>
            @foreach($porcentagemCurso as $PorcentagemCurso)
                <tr class="teestr">
                    <td class="p-2" >{{$PorcentagemCurso[0]}}</td>
                    <td class="text-center p-2">{{$PorcentagemCurso[1]}}</td>
                    <td class="p-2"></td>
                    <td class="p-2"></td>
                    <td class="p-2"></td>
                </tr>
                @foreach($PorcentagensUnidadeApresentar as $PorcentagemUnidade )
                    @if($PorcentagemUnidade[0] == $PorcentagemCurso[0])
                        <tr class="espacamento50 corUnidades">
                            <td class="espacamento50">{{$PorcentagemUnidade[1]}}</td>
                            <td class="text-center">{{$PorcentagemUnidade[2]}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @foreach($porcentagemConteudos as $dado)
                            @foreach($dado as $d)
                                @if($PorcentagemCurso[0] == $d[0])
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
                                                    <form method="post" action="{{route('CadastrarAtividadeAluno2.professor',['Aluno'=>$Aluno,'IDCurso'=>$PorcentagemCurso[2],'IDProfessor'=>$IDProfessor,'IDUnidade'=>$PorcentagemUnidade[3],'IDConteudo'=>$d[7]])}}">
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
