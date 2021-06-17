<?php require_once '../App/Components/Header.php'; ?>
<div class="container">

    <div class="pagetitle">
        <h1>Cadastrar Cliente</h1>
    </div>

    <div class="cliente">
        <form method="get" action=".">
            <div class="form-group">
                <div style="font-weight: bold">Dados Pessoais:</div>
                <div style="margin-top: 10px;">
                    <label for="nome">Nome:</label>
                    <input name="nome" required type="texto" class="form-control" placeholder="Digite seu nome completo" />
                </div>
                <div>
                    <label for="cpf">CPF:</label>
                    <input name="cpf" required type="texto" class="form-control" placeholder="Digite seu CPF" />
                </div>
                <div>
                    <label for="data-nascimento">Data de Nascimento:</label>
                    <input name="data-nascimento" required type="date" class="form-control" />
                </div>
                <div>
                    <label for="email">E-mail:</label>
                    <input name="email" type="email" required class="form-control" placeholder="Digite seu email" />
                </div>
            </div>
            <div class="form-group">
                <div style="font-weight: bold">Endereço:</div>
                <div style="margin-top: 10px;">
                    <label for="cep" style="width: 100%;">CEP:</label>
                    <div style="display: flex; margin: 0">
                        <input id="cep" maxlength="9" name="cep" required class="form-control" placeholder="00000-000" onKeyPress="getEnterKey()" />
                        <button type="button" class="botao" onClick="pesquisacep(cep.value)" style="margin: 0; margin-left: 10px;">Buscar</button>
                    </div>
                </div>
                <div id="cepinvalido" class="oculto" style="color: red">
                    *Por favor, informe um CEP válido.
                </div>
                <div id="cepnaoencontrado" class="oculto" style="color: red">
                    *CEP não encontrado.
                </div>
                <div id="adress" class="oculto">
                    <div>
                        <label for="rua">Lougradouro:</label>
                        <input id="rua" name="rua" type="text" class="form-control" placeholder="Nome da Rua" />
                    </div>
                    <div>
                        <label for="numero">Número:</label>
                        <input id="numero" name="numero" type="text" class="form-control" />
                    </div>
                    <div>
                        <label for="bairro">Bairro:</label>
                        <input id="bairro" name="bairro" type="text" class="form-control" />
                    </div>
                    <div>
                        <label for="cidade">Cidade:</label>
                        <input id="cidade" name="cidade" type="text" class="form-control" />
                    </div>
                    <div>
                        <label for="estado">Estado:</label>
                        <input id="uf" name="estado" type="text" class="form-control" />
                    </div>
                    <div style="display: flex; justify-content: center;">
                        <input style="width: 100%" type="submit" value="Cadastrar" />
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
<script>
    // verificar se o input esta vazio, para ocultar ou exibir campos
    var inputs = document.querySelectorAll('#cep');
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].addEventListener('input', function() {
            if (this.value === '') {
                adicionaOculto('adress')
                adicionaOculto('cepinvalido')
                adicionaOculto('cepnaoencontrado')
                limpa_formulario_cep()
            }
        });
    }
</script>
</body>

</html>