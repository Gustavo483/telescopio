@extends('layouts.basico')

@section('titulo', 'unidade')

@section('conteudo')
    <div>
        <h1>{{$dadosconteudo->st_nome_conteudo}}</h1>
    </div>


    <div class="mt-5 mb-5">
        <h1 class="mt-5 mb-5">cronograma do conteudo</h1>
    </div>
    <div>
        <table class="mb-5">
            <tr class="border12">
                <th class="border12">tipo ativide</th>
                <th class="border12">ordem de apresentação</th>
                <th class="border12">excluir atividade do cronograma</th>
            </tr>
            @foreach($cronogramas as $Cronograma)
                <tr class="border12">
                    <td class="border12">
                        {{$Cronograma->st_tipo_atividade}}
                    </td>
                    <td class="border12">
                        {{$Cronograma->st_ordem_apresentacao}}
                    </td>
                    <td class="border12">
                        <form id="form_{{$Cronograma->id}}" method="post" action="{{route('delete.atividadeCronograma',['cronograma'=>$Cronograma->id])}}">
                            @method('DELETE')
                            @csrf
                            <a class="linkedel" href="#" onclick="document.getElementById('form_{{$Cronograma->id}}').submit()">
                                excluir
                            </a>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <div>
        <h1>Adicionar novo tópico ao cronograma do curso</h1>
        <form class="mt-5" method="post" action="{{route('cronograma.store',['dadosconteudo'=>$dadosconteudo])}}">
            @csrf
            <div class="d-flex justify-content-start">
                <div>
                    Selecione o tipo de atividade:
                </div>
                <div class="ms-5">
                    <select id="select1"  name="TipoAtividade" class="form-control">
                        <option value="ConteudoEscrito">Conteúdo Escrito</option>
                        <option value="AtividadeFixacao">Atividade de Fixação</option>
                        <option value="testeConteudo">teste do conteudo</option>
                        <option value="TesteIntermediario">teste Intermediarios da unidade</option>
                        <option value="testeFinalUnidade">teste Final da unidade</option>
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                <div>
                    Digite a ordem de apresentação:
                </div>
                <div class="ms-5">
                    <input type="number" name="st_ordem_apresentacao" value="{{ old('st_ordem_apresentacao') }}" placeholder="Digite a ordem de apresentação">
                </div>
            </div>
            <div>
                {{ $errors->has('st_ordem_apresentacao') ? $errors->first('st_ordem_apresentacao') : '' }}
            </div>
            <button type="submit">Cadastrar</button>
        </form>

        <h1 class="mt-5">Questões Cadastradas para o conteudo</h1>

        <a href="{{route('vizualizar.TodasAtividades',['dadosconteudo'=>$dadosconteudo])}}">
            vizualizar questões do teste do conteudo
        </a>
        <br>
        <a href="{{route('vizualizar.TodasAtividadesFZ',['dadosconteudo'=>$dadosconteudo])}}">
            vizualizar questões da atividade de fização
        </a>
        <br>

        <a href="{{route('vizualizar.atividadeFinalUnidade',['dadosconteudo'=>$dadosconteudo])}}">
            vizualizar teste Final da Unidade
        </a>

        <a href="{{route('vizualizar.atividadeIntermediarioUnidade',['dadosconteudo'=>$dadosconteudo])}}">
            vizualizar teste intermediario da Unidade
        </a>

        <table class="mb-5 mt-5">
            <tr class="border12">
                <th class="border12">Tipo ativide</th>
                <th class="border12">Total de questão do modelo</th>
                <th class="border12">Adicionar nova atividade</th>
            </tr>
            <tr>
                <td>Multipla escolha</td>
                <td class="text-center">{{$arayQuantidade[0]}}</td>
                <td class="text-center">
                    <a class="mt-5 mb-5" href="{{route('criarQuestaoME.conteudo',['dadosconteudo'=>$dadosconteudo])}}">
                        cadastrar questão ME
                    </a>
                </td>
            </tr>
            <tr>
                <td>Resposta breve</td>
                <td class="text-center">{{$arayQuantidade[1]}}</td>
                <td class="text-center">
                    <a class="mt-5 mb-5" href="{{route('criarQuestaoRB.conteudo',['dadosconteudo'=>$dadosconteudo])}}">
                        cadastrar questão RB
                    </a>
                </td>

            </tr>
            <tr>
                <td>Resposta Numérica</td>
                <td class="text-center">{{$arayQuantidade[2]}}</td>
                <td class="text-center">
                    <a class="mt-5 mb-5" href="{{route('criarQuestaoRN.conteudo',['dadosconteudo'=>$dadosconteudo])}}">
                        cadastrar questão RN
                    </a>
                </td>
            </tr>
            <tr>
                <td>Questão de fização</td>
                <td class="text-center">{{$arayQuantidade[3]}}</td>
                <td class="text-center">
                    <a class="mt-5 mb-5" href="{{route('criarQuestaoFZ.conteudo',['dadosconteudo'=>$dadosconteudo])}}">
                        Cadastrar questões FZ
                    </a>
                </td>
            </tr>
        </table>
    </div>

@endsection
