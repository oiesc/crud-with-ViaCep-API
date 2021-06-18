<?php require_once '../App/Components/Header.php'; ?>
<div class="container">

    <div class="pagetitle">
        <h1>Editar dados do Cliente</h1>
    </div>
    <div class="cliente">
        <div class="cards">
            <?php
            require_once('../App/Services/ClienteService.php');
            editarCliente();
            ?>
        </div>
    </div>
</div>
</body>
<script src="../App/Services/Cliente.js"></script>

</html>