// verificar se o input esta vazio, para ocultar ou exibir campos
let inputs = document.querySelectorAll('#cep');
for (let i = 0; i < inputs.length; i++) {
    inputs[i].addEventListener('input', function () {
        if (this.value === '') {
            document.getElementById('cadastrar').setAttribute('type', 'button')
            adicionaOculto('adress')
            adicionaOculto('cepinvalido')
            adicionaOculto('cepnaoencontrado')
            limpa_formulario_cep()
        }
    });
}

// debugger: para não usar 2 submits no furmulario, o botão de buscar é acionado
// caso o usuário aperte enter, sendo assim, o submit fica somente para o botão cadastrar
let pressenter = document.getElementById('cep')
pressenter && pressenter.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') {
        e.preventDefault()
        pressenter.focus()
        pesquisacep(pressenter.value)
    }
});

// receber somente numeros nos campos CPF e CEP
function somenteNumeros(e) {

    // Only ASCII character in that range allowed
    var ASCIICode = (e.which) ? e.which : e.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false;
    return true;
}

// confirma a ação do usuário
function confirma(value) {
    // retorna true se confirmado, ou false se cancelado
    if (value === "adicionar")
        return confirm('Tem certeza que deseja cadastrar este cliente?');
}

// alternar entre campo de pesquisa por CPF ou por Nome
function exibecampo() {
    let checkbox = document.getElementById('cpf')
    checkbox.checked ?
        (
            document.getElementById('dadoscpf').setAttribute('required', 'required'),
            document.getElementById('dadoscpf').classList.remove('oculto'),
            document.getElementById('dadosnome').classList.add('oculto'),
            document.getElementById('pesquisar').classList.remove('oculto'),
            document.getElementById('dadosnome').removeAttribute('required', 'required'))
        :
        (
            document.getElementById('dadosnome').setAttribute('required', 'required'),
            document.getElementById('dadoscpf').classList.add('oculto'),
            document.getElementById('dadosnome').classList.remove('oculto'),
            document.getElementById('pesquisar').classList.remove('oculto'),
            document.getElementById('dadoscpf').removeAttribute('required', 'required'))
}

// pagina excluir - estilização da div (não usado --)
function mudaDiv(el) {
    let pai = el.closest(".card")
    if (el.checked) {
        pai.classList.remove('excluir')
        pai.classList.add('excluirborda')
    } else {
        pai.classList.add('excluir')
        pai.classList.remove('excluirborda')
    }
}