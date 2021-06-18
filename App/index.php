<?php require_once '../App/Components/Header.php'; ?>
<div class="container">

    <div class="pagetitle">
        <h1>Gestão de Clientes</h1>
    </div>
    <div class="opcoes">

        <div class="opcao">
            <img src="../App/Images/mostrar-todos.png" />
            <a href="../public_html/clientes.php">
                <div>Mostrar todos</div>
            </a>
        </div>

        <div class="opcao">
            <img src="../App/Images/add-cliente.png" />
            <a href="../public_html/cadastro_cliente.php">
                <div>Cadastrar</div>
            </a>
        </div>

        <div class="opcao">
            <img src="../App/Images/editar-cliente.png" />
            <a href="#">
                <div> Alterar</div>
            </a>
        </div>

        <div class="opcao">
            <img src="../App/Images/buscar-cliente.png" />
            <a href="../public_html/consulta_cliente.php">
                <div>Consultar</div>
            </a>
        </div>

        <div class="opcao">
            <img src="../App/Images/remover-cliente.png" />
            <a href="../public_html/excluir_cliente.php">
                <div>Excluir</div>
            </a>
        </div>
    </div>
</div>
</body>

</html>