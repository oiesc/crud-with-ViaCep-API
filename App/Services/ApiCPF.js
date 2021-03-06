// adicionar classe oculta nos elementos
function adicionaOculto(id) {
    document.getElementById(id).classList.add('oculto');
}

// remover classe oculta dos elementos
function removeOculto(id) {
    document.getElementById(id).classList.remove('oculto');
}

function limpa_formulario_cep() {
    //Limpa valores do formulário de cep.
    document.getElementById('rua').value = ("");
    document.getElementById('bairro').value = ("");
    document.getElementById('cidade').value = ("");
    document.getElementById('uf').value = ("");
    document.getElementById('numero').value = ("");
}

function apiCallback(conteudo) {
    if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
        document.getElementById('rua').value = (conteudo.logradouro);
        document.getElementById('bairro').value = (conteudo.bairro);
        document.getElementById('cidade').value = (conteudo.localidade);
        document.getElementById('uf').value = (conteudo.uf);
        document.getElementById('numero').value = ('');
        // ativa o submit do form quando o CEP for informado
        document.getElementById('cadastrar').setAttribute('type', 'submit')
        removeOculto('adress');
        adicionaOculto('cepinvalido');
        adicionaOculto('cepnaoencontrado');
    } //end if.
    else {
        //CEP não Encontrado.
        // remove o submit do form, para evitar de enviar caso o usuario pressione enter
        document.getElementById('cadastrar').setAttribute('type', 'button')
        limpa_formulario_cep();
        removeOculto('cepnaoencontrado');
        adicionaOculto('adress');
        adicionaOculto('cepinvalido');
    }
}

function pesquisacep(valor) {

    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if (validacep.test(cep)) {

            //Cria um elemento javascript.
            var script = document.createElement('script');

            //Sincroniza com o callback.
            script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=apiCallback';

            //Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);

        } //end if.
        else {
            //cep é inválido.
            limpa_formulario_cep();
            document.getElementById('cadastrar').setAttribute('type', 'button')
            removeOculto('cepinvalido');
            adicionaOculto('adress');
            adicionaOculto('cepnaoencontrado');
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        document.getElementById('cadastrar').setAttribute('type', 'button')
        limpa_formulario_cep();
        adicionaOculto('adress');
        adicionaOculto('cepnaoencontrado');
        removeOculto('cepinvalido');
    }
};