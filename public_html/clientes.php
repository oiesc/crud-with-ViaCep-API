<?php require_once '../App/Components/Header.php'; ?>
<div class="container">

    <div class="pagetitle">
        <h1>Lista de Clientes</h1>
    </div>
    <div class="cliente">
        <div class="cards">
            <?php
            require_once('../App/Services/ClienteService.php');
            echo getAll();
            ?>
        </div>
    </div>
</div>
</body>

</html>