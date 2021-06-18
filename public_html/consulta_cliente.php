<?php require_once '../App/Components/Header.php'; ?>
<div class="container">

    <div class="pagetitle">
        <h1>Consultar Cliente</h1>
    </div>
    <div class="cliente">
        <form action="" method="GET">
            <div class="form-group">
                <div>Consultar por:
                    <input style="margin-left: 10px" onclick="exibecampo()" required type="radio" id="cpf" name="pesquisa" value="cpf">
                    <label for="cpf">CPF</label>
                    <input style="margin-left: 10px" onclick="exibecampo()" required type="radio" id="nome" name="pesquisa" value="nome">
                    <label for="nome">Nome</label>
                </div>
                <div style="display: flex;">
                    <input class="form-control oculto" maxlength="11" onkeypress="return somenteNumeros(event)" placeholder="Somente numeros" id="dadoscpf" name="dadoscpf" />
                    <input class="form-control oculto" placeholder="Digite aqui" id="dadosnome" name="dadosnome" />
                    <input class="oculto" style="margin-left: 10px" type="submit" value="Pesquisar" name="submit" id="pesquisar" />
                </div>
                <div class="cards">
                    <?php
                    require_once('../App/Services/ClienteService.php');
                    if (isset($_GET["submit"])) {
                        consultaCliente();
                    }
                    ?>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
<script src="../App/Services/Cliente.js"></script>

</html>