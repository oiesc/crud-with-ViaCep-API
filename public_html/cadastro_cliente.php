<?php require_once '../App/Components/Header.php'; ?>
<div class="container">

    <div class="pagetitle">
        <h1>Cadastrar Cliente</h1>
    </div>

    <div class="cliente">
        <form action="" method="POST">
            <div class="form-group">
                <div style="font-weight: bold">Dados Pessoais:</div>
                <div style="margin-top: 10px;">
                    <label for="nome">Nome:</label>
                    <input id="nome" name="nome" required type="texto" class="form-control" placeholder="Nome completo" />
                </div>
                <div>
                    <label for="cpf">CPF:</label>
                    <input id="cpf" name="cpf" required maxlength="11" type="texto" class="form-control" placeholder="CPF (somente numeros)" onkeypress="return somenteNumeros(event)" />
                </div>
                <div>
                    <label for="data-nascimento">Data de Nascimento:</label>
                    <input id="data-nascimento" required name="data-nascimento" type="date" class="form-control" />
                </div>
                <div>
                    <label for="email">E-mail:</label>
                    <input id="email" name="email" required type="email" class="form-control" placeholder="email@exemplo.com" />
                </div>
            </div>
            <div class="form-group">
                <div style="font-weight: bold">Endereço:</div>
                <div style="margin-top: 10px;">
                    <label for="cep" style="width: 100%;">CEP:</label>
                    <div style="display: flex; margin: 0">
                        <input id="cep" maxlength="8" required name="cep" class="form-control" placeholder="00000000 (somente numeros)" onkeypress="return somenteNumeros(event)" />
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
                        <input id="rua" required name="rua" type="text" class="form-control" placeholder="Nome da Rua" />
                    </div>
                    <div>
                        <label for="numero">Número:</label>
                        <input id="numero" name="numero" type="text" class="form-control" />
                    </div>
                    <div>
                        <label for="bairro">Bairro:</label>
                        <input id="bairro" required name="bairro" type="text" class="form-control" />
                    </div>
                    <div>
                        <label for="cidade">Cidade:</label>
                        <input id="cidade" required name="cidade" type="text" class="form-control" />
                    </div>
                    <div>
                        <label for="uf">Estado:</label>
                        <input id="uf" required name="uf" type="text" class="form-control" />
                    </div>
                    <div style="display: flex; justify-content: center;">
                        <input id="cadastrar" style="width: 100%" name="submit" type="button" value="Cadastrar" onclick="return confirma('adicionar')" />
                    </div>
                </div>
            </div>
        </form>
        <?php
        require_once('../App/Services/ClienteService.php');
        if (isset($_POST["submit"])) {
            cadastrarCliente();
        }
        ?>
    </div>
</div>
<script src="../App/Services/Cliente.js"></script>
</body>

</html>