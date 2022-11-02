@extends('layouts.basico')

@section('titulo', 'HomeProfessor')

@section('conteudo')
    <h3 class="mt-5">Painel do professor> Curso > Alunos </h3>
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

    <h5 class="text-center mt-5">Progresso do aluno no curso</h5>

    <div>
        <table class="w-100 mt-4">
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
                    <tr>
                        <td >{{$PorcentagemCurso[0]}}</td>
                        <td class="text-center">{{$PorcentagemCurso[1]}}</td>
                        <td></td>
                    </tr>
                    @foreach($PorcentagensUnidadeApresentar as $PorcentagemUnidade )
                        @if($PorcentagemUnidade[0] == $PorcentagemCurso[0])
                            <tr class="espacamento50">
                                <td class="espacamento50">{{$PorcentagemUnidade[1]}}</td>
                                <td class="text-center">{{$PorcentagemUnidade[2]}}</td>
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
                                                    +
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
