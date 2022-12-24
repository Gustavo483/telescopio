@extends('layouts.CadastrarQuestoes')

@section('titulo', 'Questão RB')

@section('conteudo')
    @if(count($errors->all()) > 1)
        <div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">
            Não foi possível salvar a questão. Verifique os dados enviados e envie novamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="flexPAluno mt-3 ">
        <h4 class="h4Pets">
            Painal do Administrador > Unidades > Conteudos > Acrescentar questão fização
        </h4>
        <a class="btnVoltar" href="{{route('vizualizar.conteudo',['conteudo'=>$dadosconteudo])}}">
            Voltar
        </a>
    </div>

    <h3 class=" mt-5 h4Pets text-center mb-5">
        Acrescentar questão de fização ao conteúdo {{$dadosconteudo->st_nome_conteudo}}
    </h3>
    <div>
        <label class="form-label">Selecione o tipo de atividade:</label>
        <select id="language" name="TipoAtividade" class="form-control">
            <option value="selecione">Selecione</option>
            <option value="ME">Multipla escola</option>
            <option value="RB">Resposta breve</option>
            <option value="RN">Resposta numérica</option>
        </select>
        <div class="d-flex justify-content-center my-3">
            <button class="btnVoltar" id="btnTipoAtividade">Selecionar</button>
        </div>
    </div>


    <div id="divME" class="none">
        <h3 class=" mt-5 h4Pets text-center">
            Cadastro de questão ME
        </h3>
        <form method="post" action="{{route('StoreQuestaoFZME.conteudo', ['dadosconteudo'=>$dadosconteudo])}}">
            @csrf
            <label class="mt-5 form-label" for="">Banca atividade</label>
            <input class="form-control" type="text" name="DadosBanca">
            <div class="errosd">
                {{ $errors->has('DadosBanca') ? $errors->first('DadosBanca') : '' }}
            </div>

            <label class="mt-5 form-label" for="">Pergunta:</label>
            <textarea name="st_pergunta" id="st_pergunta_ME" cols="30" rows="10">
                    {{{ old('st_pergunta')}}}
                </textarea>
            <div class="errosd">
                {{ $errors->has('st_pergunta') ? $errors->first('st_pergunta') : '' }}
            </div>

            <label class="mt-5 form-label" for="">alternativa 1:</label>
            <textarea name="st_alternativa1" id="st_alternativa1" cols="30" rows="10">
                    {{{ old('st_alternativa1')}}}
                </textarea>
            <div class="errosd">
                {{ $errors->has('st_alternativa1') ? $errors->first('st_alternativa1') : '' }}
            </div>

            <label class="mt-5 form-label" for="">alternativa 2:</label>
            <textarea name="st_alternativa2" id="st_alternativa2" cols="30" rows="10">
                    {{{ old('st_alternativa2')}}}
                </textarea>
            <div class="errosd">
                {{ $errors->has('st_alternativa2') ? $errors->first('st_alternativa2') : '' }}
            </div>


            <label class="mt-5 form-label" for="">alternativa 3:</label>
            <textarea name="st_alternativa3" id="st_alternativa3" cols="30" rows="10">
                    {{{ old('st_alternativa3')}}}
                </textarea>
            <div class="errosd">
                {{ $errors->has('st_alternativa3') ? $errors->first('st_alternativa3') : '' }}
            </div>

            <label class="mt-5 form-label" for="">alternativa 4:</label>
            <textarea name="st_alternativa4" id="st_alternativa4" cols="30" rows="10">
                    {{{ old('st_alternativa4')}}}
                </textarea>
            <div class="errosd">
                {{ $errors->has('st_alternativa4') ? $errors->first('st_alternativa4') : '' }}
            </div>

            <label class="mt-5 form-label" for="">alternativa 5:</label>
            <textarea name="st_alternativa5" id="st_alternativa5" cols="30" rows="10">
                    {{{ old('st_alternativa5')}}}
                </textarea>
            <div class="errosd">
                {{ $errors->has('st_alternativa5') ? $errors->first('st_alternativa5') : '' }}
            </div>

            <label class="mt-5 form-label" for="">Resolução da atividade:</label>
            <textarea name="st_resolusao" id="st_resolusao_ME" cols="30" rows="10">
                    {{{ old('st_resolusao')}}}
                </textarea>
            <div class="errosd">
                {{ $errors->has('st_resolusao') ? $errors->first('st_resolusao') : '' }}
            </div>

            <label class="mt-2 form-label">Digite o número da resposta correta:</label>
            <input class="form-control" type="number" name="st_gabarito" value="{{ old('st_gabarito') }}"
                   placeholder="Digite o número da atividade que está correta">
            <div class="errosd">
                {{ $errors->has('st_gabarito') ? $errors->first('st_gabarito') : '' }}
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btnVoltar5 my-5"> Atualizar </button>
            </div>
        </form>
    </div>

    <div id="divRB" class="none">
        <h1 class="text-center">
            Questão RB
        </h1>
        <form method="post" action="{{route('StoreQuestaoFZRB.conteudo', ['dadosconteudo'=>$dadosconteudo])}}">
            @csrf
            <label class="mt-5 form-label" for="">Banca atividade</label>
            <input class="form-control" type="text" name="DadosBanca">
            <div class="errosd">
                {{ $errors->has('DadosBanca') ? $errors->first('DadosBanca') : '' }}
            </div>

            <label class="mt-5 form-label" for="">Pergunta:</label>
            <textarea name="st_pergunta" id="st_pergunta_RB" cols="30" rows="10">
                    {{{ old('st_pergunta')}}}
                </textarea>
            <div class="errosd">
                {{ $errors->has('st_pergunta') ? $errors->first('st_pergunta') : '' }}
            </div>


            <label class="mt-5 form-label" for="">Resposta da atividade:</label>
            <input class="form-control" type="text" name="st_respostaRB">
            <div class="errosd">
                {{ $errors->has('st_respostaRB') ? $errors->first('st_respostaRB') : '' }}
            </div>


            <label class="mt-5 form-label" for="">Resolução da atividade:</label>
            <textarea name="st_resolusao" id="st_resolusao_RB" cols="30" rows="10">
                {{{ old('st_resolusao')}}}
            </textarea>
            <div class="errosd">
                {{ $errors->has('st_resolusao') ? $errors->first('st_resolusao') : '' }}
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btnVoltar5 my-5"> Atualizar </button>
            </div>
        </form>
    </div>
    <div id="divRN" class="none">
        <h1 class="text-center">
            Cadastro de questão RN
        </h1>
        <form method="post" action="{{route('StoreQuestaoFZRN.conteudo', ['dadosconteudo'=>$dadosconteudo])}}">
            <label class="mt-5 form-label" for="">Banca atividade</label>
            <input class="form-control" type="text" name="DadosBanca">
            <div class="errosd">
                {{ $errors->has('DadosBanca') ? $errors->first('DadosBanca') : '' }}
            </div>
            @csrf

            <label class="mt-5 form-label" for="">Pergunta:</label>
            <textarea name="st_pergunta" id="st_pergunta_RN" cols="30" rows="10">
                    {{{ old('st_pergunta')}}}
                </textarea>
            <div class="errosd">
                {{ $errors->has('st_pergunta') ? $errors->first('st_pergunta') : '' }}
            </div>


            <label class="mt-5 form-label" for="">Resposta da atividade:</label>
            <input class="form-control" type="number" name="st_respostaRN">
            <div class="errosd">
                {{ $errors->has('st_respostaRN') ? $errors->first('st_respostaRN') : '' }}
            </div>


            <label class="mt-5 form-label" for="">Resolução da atividade:</label>
            <textarea name="st_resolusao" id="st_resolusao_RN" cols="30" rows="10">
                    {{{ old('st_resolusao')}}}
                </textarea>
            <div class="errosd">
                {{ $errors->has('st_resolusao') ? $errors->first('st_resolusao') : '' }}
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btnVoltar5 my-5"> Atualizar </button>
            </div>

        </form>
    </div>


    <script>
        var btn = document.getElementById('btnTipoAtividade')
        var divME = document.getElementById('divME')
        var divRB = document.getElementById('divRB')
        var divRN = document.getElementById('divRN')

        btn.addEventListener("click", function () {
            var select = document.getElementById('language');
            var value = select.options[select.selectedIndex].value;
            if (value == 'ME') {
                divME.classList.remove('none');
                divRB.classList.add('none');
                divRN.classList.add('none');
            }
            if (value == 'RB') {
                divRB.classList.remove('none');
                divME.classList.add('none');
                divRN.classList.add('none');
            }
            if (value == 'RN') {
                divRN.classList.remove('none');
                divRB.classList.add('none');
                divME.classList.add('none');
            }
        })
    </script>

    <script>
        $('#st_pergunta_RN').summernote({
            placeholder: 'escreva aqui',
            tabsize: 2,
            height: 100
        });
        $('#st_respostaRN').summernote({
            placeholder: 'escreva aqui',
            tabsize: 2,
            height: 100
        });
        $('#st_resolusao_RN').summernote({
            placeholder: 'Hescreva aqui',
            tabsize: 2,
            height: 100
        });
        $('#st_pergunta_RB').summernote({
            placeholder: 'escreva aqui',
            tabsize: 2,
            height: 100
        });
        $('#st_resolusao_RB').summernote({
            placeholder: 'escreva aqui',
            tabsize: 2,
            height: 100
        });

        $('#st_pergunta_ME').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,
            height: 100
        });
        $('#st_alternativa1').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,
            height: 100
        });
        $('#st_alternativa2').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,
            height: 100
        });
        $('#st_alternativa3').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,
            height: 100
        });
        $('#st_alternativa4').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,
            height: 100
        });
        $('#st_alternativa5').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,
            height: 100
        });
        $('#st_resolusao_ME').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,
            height: 100
        });
    </script>
@endsection
