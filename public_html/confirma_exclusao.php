<?php require_once '../App/Components/Header.php'; ?>
<div class="container">

    <div class="pagetitle">
        <h1>Excluir Cliente</h1>
    </div>
    <div class="cliente">
        <form action="">
            <div class="form-group">
                <div class="cards" style="justify-content: center">
                    <?php
                    require_once('../App/Services/ClienteService.php');
                    exibeExclusao();
                    ?>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
<script src="../App/Services/Cliente.js"></script>

</html>