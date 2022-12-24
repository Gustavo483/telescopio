var IdFila = []
var totalQuestoes = []
var respondeuCorretamente = []
var respondeuErrado = []
var idQuestoesRespondidas = []
var valoresDoformulario = []
var ultimaDivAberta = ['nadaEnviado']
var QuestaoForma = ['Nenhuma Atividade cadastrada']

function AbrirQuestao(divParaAbrir){
    var div_questao_id = document.getElementById('div_questao_id_'+divParaAbrir)
    var ajuda_id = document.getElementById('ajuda_id_'+divParaAbrir)
    var btn_questao_final =  document.getElementById('btn_questao_final_'+divParaAbrir)

    if (ultimaDivAberta[0] == 'nadaEnviado'){
        var tresEstrelas= document.getElementById('tresEstrelas')
        var duasestrelas= document.getElementById('duasestrelas')
        var umaestrelas= document.getElementById('umaestrelas')
        var zeroEstrelas = document.getElementById('zeroEstrelas')
        var Questoeszxz = document.getElementById('Questoeszxz')
        var DivResultado = document.getElementById('DivResultado')
        DivResultado.classList.add('none')
        Questoeszxz.classList.remove('none')
        zeroEstrelas.classList.add('none')
        umaestrelas.classList.add('none')
        duasestrelas.classList.add('none')
        tresEstrelas.classList.add('none')
        ultimaDivAberta[0]= divParaAbrir
        div_questao_id.classList.remove('none')
        ajuda_id.classList.remove('none')
        btn_questao_final.classList.add('bgFocus')
    }

    if (ultimaDivAberta[0] != 'nadaEnviado'){
        var div_questao_id_2 = document.getElementById('div_questao_id_'+ultimaDivAberta[0])
        var ajuda_id_2 = document.getElementById('ajuda_id_'+ultimaDivAberta[0])
        var btn_questao_final2 = document.getElementById('btn_questao_final_'+ultimaDivAberta[0])
        btn_questao_final2.classList.remove('bgFocus')
        ultimaDivAberta[0]= divParaAbrir
        div_questao_id_2.classList.add('none')
        ajuda_id_2.classList.add('none')
        div_questao_id.classList.remove('none')
        ajuda_id.classList.remove('none')
        btn_questao_final.classList.add('bgFocus')
    }

}
function enviarFormulario(){
    if (QuestaoForma[0] != 'AtividadeFixacao'){
        var input_int_estrela_obtida = document.getElementById('input_int_estrela_obtida')
        var input_int_acertos = document.getElementById('input_int_acertos')
        var input_int_tempo_execucao = document.getElementById('input_int_tempo_execucao')
        var sub_formulario = document.getElementById('sub_formulario')

        input_int_estrela_obtida.value = valoresDoformulario[0]
        input_int_acertos.value = valoresDoformulario[1]
        input_int_tempo_execucao.value = valoresDoformulario[2]
        sub_formulario.click()
    }

    if (QuestaoForma[0] == 'AtividadeFixacao'){
        var input_int_acertos2 = document.getElementById('input_int_acertos2')
        var input_int_tempo_execucao2 = document.getElementById('input_int_tempo_execucao2')
        var sub_formulario2 = document.getElementById('sub_formulario2')

        input_int_acertos2.value = valoresDoformulario[1]
        input_int_tempo_execucao2.value = valoresDoformulario[2]
        sub_formulario2.click()
    }

}

function porcentagem(){
    var Questoeszxz = document.getElementById('Questoeszxz')
    var DivResultado = document.getElementById('DivResultado')
    var tresEstrelas = document.getElementById('tresEstrelas')
    var duasestrelas = document.getElementById('duasestrelas')
    var umaestrelas = document.getElementById('umaestrelas')
    var zeroEstrelas = document.getElementById('zeroEstrelas')

    var botoesProgresso1 = document.getElementById('botoesProgresso1')
    var botoesProgresso2 = document.getElementById('botoesProgresso2')

    botoesProgresso1.classList.add('none')
    botoesProgresso2.classList.remove('none')
    //DivsTeste
    Questoeszxz.classList.add('none')
    DivResultado.classList.remove('none')
    var porcentagem = (respondeuCorretamente.length/totalQuestoes) * 100
    //console.log(porcentagem)

    if (porcentagem < 20){
        zeroEstrelas.classList.remove('none')
        valoresDoformulario.push(0)
        valoresDoformulario.push(porcentagem)
        valoresDoformulario.push(0)
        //console.log(valoresDoformulario)
    }

    if (porcentagem >= 20 && porcentagem <= 40){
        umaestrelas.classList.remove('none')
        valoresDoformulario.push(1)
        valoresDoformulario.push(porcentagem)
        valoresDoformulario.push(0)
        //console.log(valoresDoformulario)
    }

    if (porcentagem > 40 && porcentagem <= 60){
        duasestrelas.classList.remove('none')
        valoresDoformulario.push(2)
        valoresDoformulario.push(porcentagem)
        valoresDoformulario.push(0)
        //console.log(valoresDoformulario)
    }

    if (porcentagem > 60){
        tresEstrelas.classList.remove('none')
        valoresDoformulario.push(3)
        valoresDoformulario.push(porcentagem)
        valoresDoformulario.push(0)
        //console.log(valoresDoformulario)
    }
    //console.log(respondeuCorretamente.length)
    //console.log(respondeuErrado)
    //console.log(totalQuestoes)
}

function AcertouQuestaoMasErrouAntes(IdQuestao){
    if (IdFila.length == 0){
        // info questao acertada
        var BtnVerificarQuestaoAcertada = document.getElementById('btn_verificacao'+IdQuestao)
        var btnAcertou = document.getElementById('btn_questao_'+ IdQuestao)
        var btnAcertou2 = document.getElementById('btn_questao_final_'+ IdQuestao)
        var btnDivQuestaoAcertada = document.getElementById('div_questao_id_'+IdQuestao)

        //removendo os dados da div que estava em aberto
        btnAcertou.classList.add('btnErrou')
        btnAcertou2.classList.add('btnErrou')
        btnAcertou.classList.remove('bgFocus')
        BtnVerificarQuestaoAcertada.classList.add('none')
        btnDivQuestaoAcertada.classList.add('none')


        var ResultadoAtividade = document.getElementById('ResultadoAtividade')
        var divPaginacaoNormal = document.getElementById('btn_verificacao'+IdQuestao)
        divPaginacaoNormal.classList.add('none')
        ResultadoAtividade.classList.remove('none')
        porcentagem()
    }

    if (IdFila.length != 0){
        // info questao acertada
        var BtnVerificarQuestaoAcertada = document.getElementById('btn_verificacao'+IdQuestao)
        var btnAcertou = document.getElementById('btn_questao_'+ IdQuestao)
        var btnAcertou2 = document.getElementById('btn_questao_final_'+ IdQuestao)
        var btnDivQuestaoAcertada = document.getElementById('div_questao_id_'+IdQuestao)

        // info prox. questao
        var proximoBtn = document.getElementById('btn_questao_'+ IdFila[0])
        var BtnVerificarProxQuestao = document.getElementById('btn_verificacao'+ IdFila[0])
        var btnDivProxQuestao = document.getElementById('div_questao_id_'+ IdFila[0])

        //removendo os dados da div que estava em aberto
        btnAcertou.classList.add('btnErrou')
        btnAcertou2.classList.add('btnErrou')
        btnAcertou.classList.remove('bgFocus')
        BtnVerificarQuestaoAcertada.classList.add('none')
        btnDivQuestaoAcertada.classList.add('none')

        //Adicionando focos na nova div
        proximoBtn.classList.remove('SemResposta')
        proximoBtn.classList.add('bgFocus')
        BtnVerificarProxQuestao.classList.remove('none')
        btnDivProxQuestao.classList.remove('none')
    }
}

function tentarNovamente(IdQuestao){
    var DivRespondeuErrado = document.getElementById('DivRespondeuErrado'+IdQuestao)
    DivRespondeuErrado.classList.add('none')
}

function ObterAjuda(IdQuestao){
    var DivRespondeuErrado = document.getElementById('DivRespondeuErrado'+IdQuestao)
    var ajuda = document.getElementById('ajuda_id_'+IdQuestao)
    DivRespondeuErrado.classList.add('none')
    ajuda.classList.remove('none')
}

function ErrouQuestao(IdQuestao){
    respondeuErrado.push(IdQuestao)
    //console.log(respondeuErrado)
    //console.log(IdFila)
    var DivRespondeuErrado = document.getElementById('DivRespondeuErrado'+IdQuestao)
    DivRespondeuErrado.classList.remove('none')
}

function AcertouQuestao(IdQuestaoAcerto,jsonsd){
    //console.log(IdFila)
    if (IdFila.length == 0){
        // info questao acertada
        var BtnVerificarQuestaoAcertada = document.getElementById('btn_verificacao'+IdQuestaoAcerto)
        var btnAcertou = document.getElementById('btn_questao_'+ IdQuestaoAcerto)
        var btnAcertou2 = document.getElementById('btn_questao_final_'+ IdQuestaoAcerto)
        var btnDivQuestaoAcertada = document.getElementById('div_questao_id_'+IdQuestaoAcerto)

        //removendo os dados da div que estava em aberto
        btnAcertou.classList.add('btnAcertou')
        btnAcertou2.classList.add('btnAcertou')
        btnAcertou.classList.remove('bgFocus')
        BtnVerificarQuestaoAcertada.classList.add('none')
        btnDivQuestaoAcertada.classList.add('none')

        var ResultadoAtividade = document.getElementById('ResultadoAtividade')
        var divPaginacaoNormal = document.getElementById('btn_verificacao'+IdQuestaoAcerto)
        divPaginacaoNormal.classList.add('none')
        ResultadoAtividade.classList.remove('none')
        porcentagem()
    }

    if (IdFila.length != 0){
        // info questao acertada
        var BtnVerificarQuestaoAcertada = document.getElementById('btn_verificacao'+IdQuestaoAcerto)
        var btnAcertou = document.getElementById('btn_questao_'+ IdQuestaoAcerto)
        var btnAcertou2 = document.getElementById('btn_questao_final_'+ IdQuestaoAcerto)
        var btnDivQuestaoAcertada = document.getElementById('div_questao_id_'+IdQuestaoAcerto)

        // info prox. questao
        var proximoBtn = document.getElementById('btn_questao_'+ IdFila[0])
        var BtnVerificarProxQuestao = document.getElementById('btn_verificacao'+ IdFila[0])
        var btnDivProxQuestao = document.getElementById('div_questao_id_'+ IdFila[0])

        //removendo os dados da div que estava em aberto
        btnAcertou.classList.add('btnAcertou')
        btnAcertou2.classList.add('btnAcertou')
        btnAcertou.classList.remove('bgFocus')
        BtnVerificarQuestaoAcertada.classList.add('none')
        btnDivQuestaoAcertada.classList.add('none')

        //Adicionando focos na nova div
        proximoBtn.classList.remove('SemResposta')
        proximoBtn.classList.add('bgFocus')
        BtnVerificarProxQuestao.classList.remove('none')
        btnDivProxQuestao.classList.remove('none')
    }
}

function verificarAcerto(TipoQuestao,IdQuestao,jsonsd, sds){
    var DivRespondeuErrado = document.getElementById('DivRespondeuErrado'+IdQuestao)

    if (IdQuestao == jsonsd[0]){
        //console.log(jsonsd)
        totalQuestoes = jsonsd.length
        QuestaoForma[0] = sds
        //console.log(QuestaoForma[0])
        IdFila = jsonsd
    }

    if(DivRespondeuErrado.classList.contains('none')){

        if (TipoQuestao == 'questaoME'){
            var pacote = document.getElementsByName('questao_id'+IdQuestao)
            var DivResposta = document.getElementById('div_resposta'+IdQuestao).innerHTML
            var values = []
            for (var i = 0; i < pacote.length; i++){
                if ( pacote[i].checked) {
                    values.push(pacote[i].value);
                }
            }
            if (values.length == 1){
                var IndiceResposta = values[0]
                var valorRespostaCorreta = IndiceResposta[IndiceResposta.length - 1]
                //console.log(valorRespostaCorreta,DivResposta)
                if (valorRespostaCorreta == DivResposta){
                    if (respondeuErrado.includes(IdQuestao)){
                        IdFila.shift()
                        AcertouQuestaoMasErrouAntes(IdQuestao)
                    }
                    if (! respondeuErrado.includes(IdQuestao)){
                        var IdQuestaoAcerto = IdQuestao
                        idQuestoesRespondidas.push(IdQuestaoAcerto)
                        respondeuCorretamente.push(IdQuestaoAcerto)
                        IdFila.shift()
                        setTimeout(AcertouQuestao(IdQuestao,jsonsd), 2000);
                    }
                }else{
                    //console.log('errou')
                    ErrouQuestao(IdQuestao)
                }
            }else{
                //console.log('errou')
                ErrouQuestao(IdQuestao)
            }
        }
        if (TipoQuestao == 'questaoRB'){
            var Gabarito = document.getElementById('div_resposta'+IdQuestao).innerHTML
            var RespostaAluno = document.getElementById('resposta_aluno'+IdQuestao).value
            //console.log(Gabarito.toUpperCase(),RespostaAluno.toUpperCase())

            if (Gabarito.toUpperCase() == RespostaAluno.toUpperCase()){
                if (respondeuErrado.includes(IdQuestao)){
                    IdFila.shift()
                    AcertouQuestaoMasErrouAntes(IdQuestao)
                }
                if(! respondeuErrado.includes(IdQuestao)){
                    //console.log('entrei 2')
                    var IdQuestaoAcerto = IdQuestao
                    idQuestoesRespondidas.push(IdQuestaoAcerto)
                    respondeuCorretamente.push(IdQuestaoAcerto)
                    IdFila.shift()
                    setTimeout(AcertouQuestao(IdQuestaoAcerto,jsonsd), 2000);
                }
            }else{
                //console.log('errou')
                ErrouQuestao(IdQuestao)
            }
        }

        if (TipoQuestao == 'questaoRN'){
            var Gabarito = document.getElementById('div_resposta'+IdQuestao).innerHTML
            var RespostaAluno = document.getElementById('resposta_aluno'+IdQuestao).value
            //console.log(Gabarito,RespostaAluno)

            if (Gabarito == RespostaAluno){
                if (respondeuErrado.includes(IdQuestao)){
                    IdFila.shift()
                    AcertouQuestaoMasErrouAntes(IdQuestao)
                }
                if (! respondeuErrado.includes(IdQuestao)){
                    var IdQuestaoAcerto = IdQuestao
                    idQuestoesRespondidas.push(IdQuestaoAcerto)
                    respondeuCorretamente.push(IdQuestaoAcerto)
                    IdFila.shift()
                    setTimeout(AcertouQuestao(IdQuestaoAcerto,jsonsd), 2000);
                }
            }else{
                //console.log('errou')
                ErrouQuestao(IdQuestao)
            }
        }
    }

    if(! DivRespondeuErrado.classList.contains('none')){
        //console.log('errou')
    }
}

