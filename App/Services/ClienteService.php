<?php

function getAll()
{
    require_once('../App/Services/Conexao.php');
    $query = "SELECT * FROM Cliente";
    $result = mysqli_query($con, $query);

    // verifica se retorna linhas no array, se não retornar, informa...
    if (!$row = $result->fetch_assoc()) {
?>
        <div class="card">
            Nenhum usuário cadastrado.
        </div>
        <?php

        // ...se retornar, exibe os clientes
    } else {
        $result = mysqli_query($con, $query);
        while ($row = $result->fetch_assoc()) {
        ?>
            <div class="card">
                <div class="item">Nome:</div>
                <div class="item"><?php echo $row['nome'] ?></div>
                <div class="item">CPF:</div>
                <div class="item"><?php echo $row['cpf'] ?></div>
            </div>
<?php
        }
    }
}
