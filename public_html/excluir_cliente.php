<?php require_once '../App/Components/Header.php'; ?>
<div class="container">

    <div class="pagetitle">
        <h1>Excluir Cliente</h1>
    </div>
    <div class="cliente">
        <div class="cards">
            <?php
            require_once('../App/Services/ClienteService.php');
            excluirCliente();
            ?>
        </div>
    </div>
</div>
</body>
<script src="../App/Services/Cliente.js"></script>

</html>