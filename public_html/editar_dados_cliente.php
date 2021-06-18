<?php require_once '../App/Components/Header.php'; ?>
<div class="container">

    <div class="pagetitle">
        <h1>Editar dados do Cliente</h1>
    </div>

    <?php
    require_once('../App/Services/ClienteService.php');
    dadosCliente();
    ?>

</div>
</body>
<script src="../App/Services/Cliente.js"></script>

</html>