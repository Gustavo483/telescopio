@extends('layouts.basico')

@section('titulo', 'HomeProfessor')

@section('conteudo')
    <h3 class="mt-5">Painel do professor> progresso > {{$Aluno->st_nome_aluno}} </h3>
    <div class="d-flex justify-content-between">
        <div>
            <div>
                img. Pets
            </div>
            <div>
                {{$ConquitasAlunos->int_total_pets}}
            </div>
        </div>
        <div>
            <div>
                img. Caderno
            </div>
            <div>
                {{$ConquitasAlunos->int_total_cursos_concluidos}}
            </div>
        </div>
        <div>
            <div>
                img.troveu
            </div>
            <div>
                {{$ConquitasAlunos->int_total_trofeus}}
            </div>
        </div>
        <div>
            <div>
                img. revisao
            </div>
            <div>
                {{$ConquitasAlunos->int_revisoes}}
            </div>
        </div>
        <div>
            <div>
                img. estrelas
            </div>
            <div>
                {{$ConquitasAlunos->int_total_estrelas}}
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between mt-5">
        <div>
            <a href="{{route('atividadesAluno2.professor',['Aluno'=>$Aluno,'IDProfessor'=>$IDProfessor])}}">
                Atividades
            </a>
        </div>
        <div>
            <a href="{{route('CursosAluno2.professor',['Aluno'=>$Aluno,'IDProfessor'=>$IDProfessor])}}">
                Cursos
            </a>
        </div>
        <div>
            <a href="{{route('ProgressoAluno2.professor',['Aluno'=>$Aluno,'IDProfessor'=>$IDProfessor])}}">
                Progresso
            </a>
        </div>
        <div>
            <a href="{{route('TarefasAluno2.professor',['Aluno'=>$Aluno,'IDProfessor'=>$IDProfessor])}}">
                Tarefas
            </a>
        </div>
    </div>

    <h5 class="text-center mt-5">Progresso do aluno nos cursos cadastrados</h5>

    <div class="fdvdd">
        <div>
            {{ $errors->has('QuantidadeAtividades') ? $errors->first('QuantidadeAtividades') : '' }}
        </div>
        <div>
            {{ $errors->has('data') ? $errors->first('data') : '' }}
        </div>
    </div>

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
                <tr class="corCurso">
                    <td >{{$PorcentagemCurso[0]}}</td>
                    <td class="text-center">{{$PorcentagemCurso[1]}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
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
