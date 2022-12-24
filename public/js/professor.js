function CriarCurso(){
    divCriarCurso = document.getElementById('divCriarCurso')
    divApresentarCursos = document.getElementById('divApresentarCursos')
    btn = document.getElementById('BtnCriarCurso')
    if (divCriarCurso.classList.contains('none')){
        divCriarCurso.classList.remove('none')
        divApresentarCursos.classList.add('none')
        btn.innerHTML = 'Vizualizar cursos'
    }else{
        divCriarCurso.classList.add('none')
        divApresentarCursos.classList.remove('none')
        btn.innerHTML = 'Criar novo curso'
    }
}

function CriarPets(){
    divCriarPet = document.getElementById('divCriarPet')
    divApresentarPets = document.getElementById('divApresentarPets')
    btn = document.getElementById('BtnCriarPet')

    if (divCriarPet.classList.contains('none')){

        divCriarPet.classList.remove('none')
        divApresentarPets.classList.add('none')
        btn.innerHTML = 'Vizualizar Pets'
    }else{
        divCriarPet.classList.add('none')
        divApresentarPets.classList.remove('none')
        btn.innerHTML = 'Criar novo Pet'
    }
}

function CriarTrofeus(){
    divCriarTrofeus = document.getElementById('divCriarTrofeus')
    divApresentarTrofeus = document.getElementById('divApresentarTrofeus')
    btn = document.getElementById('BtnCriarTrofeus')

    if (divCriarTrofeus.classList.contains('none')){

        divCriarTrofeus.classList.remove('none')
        divApresentarTrofeus.classList.add('none')
        btn.innerHTML = 'Vizualizar Trofeus'
    }else{
        divCriarTrofeus.classList.add('none')
        divApresentarTrofeus.classList.remove('none')
        btn.innerHTML = 'Criar novo Trofeu'
    }
}

function CadastrarUnidadeCurso(){
    DivVizualizarUnidadesCadastradas = document.getElementById('DivVizualizarUnidadesCadastradas')
    DivCadastrarUnidade = document.getElementById('DivCadastrarUnidade')
    btn = document.getElementById('BtnCadastrarUnidadeCurso')
    DivEditarUnidade = document.getElementById('DivEditarUnidade')

    if (DivCadastrarUnidade.classList.contains('none')){
        if (! DivEditarUnidade.classList.contains('none')){
            DivEditarUnidade.classList.add('none')
        }
        DivCadastrarUnidade.classList.remove('none')
        DivVizualizarUnidadesCadastradas.classList.add('none')
        btn.innerHTML = 'Vizualizar unidades cadastradas'

    }else{
        if (! DivEditarUnidade.classList.contains('none')){
            DivEditarUnidade.classList.add('none')
        }
        DivCadastrarUnidade.classList.add('none')
        DivVizualizarUnidadesCadastradas.classList.remove('none')
        btn.innerHTML = 'Cadastrar unidade no curso'
    }
}

function CadastrarUnidadeCurso2(){
    DivEditarUnidade = document.getElementById('DivEditarUnidade')
    DivVizualizarUnidadesCadastradas = document.getElementById('DivVizualizarUnidadesCadastradas')
    DivCadastrarUnidade = document.getElementById('DivCadastrarUnidade')

    if (DivEditarUnidade.classList.contains('none')){
        if (! DivVizualizarUnidadesCadastradas.classList.contains('none')){
            DivVizualizarUnidadesCadastradas.classList.add('none')
        }
        if (! DivCadastrarUnidade.classList.contains('none')){
            DivCadastrarUnidade.classList.add('none')
        }
        DivEditarUnidade.classList.remove('none')
    }else{
        if (! DivVizualizarUnidadesCadastradas.classList.contains('none')){
            DivVizualizarUnidadesCadastradas.classList.add('none')
        }
        if (! DivCadastrarUnidade.classList.contains('none')){
            DivCadastrarUnidade.classList.add('none')
        }
        DivEditarUnidade.classList.add('none')
    }

}

function CadastrarConteudoUnidade(){
    DivApresentarConteudos = document.getElementById('DivApresentarConteudos')
    DivCadastrarNovoConteudo = document.getElementById('DivCadastrarNovoConteudo')
    btn = document.getElementById('BtnCadastrarConteudoUnidade')
    DivEditarUnidade = document.getElementById('EditarConteudo')

    if (DivCadastrarNovoConteudo.classList.contains('none')){
        if (! DivEditarUnidade.classList.contains('none')){
            DivEditarUnidade.classList.add('none')
        }
        DivCadastrarNovoConteudo.classList.remove('none')
        DivApresentarConteudos.classList.add('none')
        btn.innerHTML = 'Vizualizar unidades cadastradas'
    }else{
        if (! DivEditarUnidade.classList.contains('none')){
            DivEditarUnidade.classList.add('none')
        }
        DivCadastrarNovoConteudo.classList.add('none')
        DivApresentarConteudos.classList.remove('none')
        btn.innerHTML = 'Cadastrar unidade no curso'
    }
}
function CadastrarConteudoUnidade2(){
    DivEditarUnidade = document.getElementById('EditarConteudo')
    DivVizualizarUnidadesCadastradas = document.getElementById('DivApresentarConteudos')
    DivCadastrarUnidade = document.getElementById('DivCadastrarNovoConteudo')

    if (DivEditarUnidade.classList.contains('none')){
        if (! DivVizualizarUnidadesCadastradas.classList.contains('none')){
            DivVizualizarUnidadesCadastradas.classList.add('none')
        }
        if (! DivCadastrarUnidade.classList.contains('none')){
            DivCadastrarUnidade.classList.add('none')
        }
        DivEditarUnidade.classList.remove('none')
    }else{
        if (! DivVizualizarUnidadesCadastradas.classList.contains('none')){
            DivVizualizarUnidadesCadastradas.classList.add('none')
        }
        if (! DivCadastrarUnidade.classList.contains('none')){
            DivCadastrarUnidade.classList.add('none')
        }
        DivEditarUnidade.classList.add('none')
    }
}

function CadastrarAtividadeConteudo(){
    DivApresentarAtividadeConteudo = document.getElementById('DivApresentarAtividadeConteudo')
    DivCadastrarAtividadeConteudo = document.getElementById('DivCadastrarAtividadeConteudo')
    btn = document.getElementById('BtnCadastrarAtividadeConteudo')

    if (DivCadastrarAtividadeConteudo.classList.contains('none')){

        DivCadastrarAtividadeConteudo.classList.remove('none')
        DivApresentarAtividadeConteudo.classList.add('none')
        btn.innerHTML = 'Vizualizar unidades cadastradas'
    }else{
        DivCadastrarAtividadeConteudo.classList.add('none')
        DivApresentarAtividadeConteudo.classList.remove('none')
        btn.innerHTML = 'Cadastrar unidade no curso'
    }
}
function CriarUnidade(){
    divvizualizarNovaUnidade = document.getElementById('divvizualizarNovaUnidade')
    divCriarNovaUnidade = document.getElementById('divCriarNovaUnidade')
    btn = document.getElementById('BtnCriarNovaUnidade')

    if (divCriarNovaUnidade.classList.contains('none')){

        divCriarNovaUnidade.classList.remove('none')
        divvizualizarNovaUnidade.classList.add('none')
        btn.innerHTML = 'Vizualizar unidades'
    }else{
        divCriarNovaUnidade.classList.add('none')
        divvizualizarNovaUnidade.classList.remove('none')
        btn.innerHTML = 'Criar nova unidade'
    }
}
