<?php

// primeiro cadastra o endereço, pra depois cadastrar o cliente com base na FK do endereço
function cadastrarCliente()
{
    require('../App/Services/Conexao.php');

    // pegar dados do endereço
    $cep = $_POST['cep'];
    $logradouro = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];

    // cadastrar dados do endereço no banco
    if (mysqli_query($con, "INSERT INTO endereco (`cep`, `logradouro`, `numero`, `bairro`, `cidade`, `uf`) VALUES ('" . $cep . "', '" . $logradouro . "', '" . $numero . "' , '" . $bairro . "', '" . $cidade . "', '" . $uf . "')")) {
        cadastrarPessoa();
    } else {
        echo "<script>window.location='cadastro_erro.php'</script>";
    }
}

// cadastrar o cliente depois que tiver cadastrado o endereço
function cadastrarPessoa()
{
    require('../App/Services/Conexao.php');
    // Como o endereço foi cadastrado, basta
    // pegar a ultima ID cadastrada no endereço e cadastrar na FK endereço do usuario
    $getIdAdress = mysqli_query($con, "SELECT MAX(idEndereco) AS idEndereco FROM endereco LIMIT 1");

    $result = mysqli_fetch_array($getIdAdress);
    // passar o resultado da stirng para uma variavel
    $adress = $result['idEndereco'];

    // pegar dados do usuário
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $dataNasc = $_POST['data-nascimento'];
    $email = $_POST['email'];

    // cadastrar dados do usuário no banco
    if (mysqli_query($con, "INSERT INTO cliente (`nome`, `cpf`, `dataNasc`, `email`, `endereco_idEndereco`) VALUES ('" . $nome . "', '" . $cpf . "', '" . $dataNasc . "' , '" . $email . "', '" . $adress . "')")) {
        echo "<script>window.location='cadastro_sucesso.php'</script>";
    } else {
        echo "<script>window.location='cadastro_erro.php'</script>";
    }
}

// retornar todos os clientes cadastrados
function getAll()
{
    require('../App/Services/Conexao.php');
    $query = "SELECT * 
    FROM cliente
    INNER JOIN endereco
    ON cliente.endereco_idEndereco = endereco.idEndereco";
    $result = mysqli_query($con, $query);

    // verifica se retorna linhas no array, se não retornar, informa...
    if (!$row = $result->fetch_assoc()) {
?>
        <div class="card">
            Nenhum cliente cadastrado.
        </div>
        <?php


    }
    // ...se retornar, exibe os clientes 
    else {
        $result = mysqli_query($con, $query);
        while ($row = $result->fetch_assoc()) {
        ?>
            <div class="card">
                <div class="items">
                    <div class="item">Nome: </div>
                    <div class="item"><?php echo "" . $row['nome'] ?></div>
                </div>
                <div class="items">
                    <div class="item">CPF:</div>
                    <div class="item"><?php echo $row['cpf'] ?></div>
                </div>
                <div class="items">
                    <div class="item">Data de Nascimento:</div>
                    <!-- formatar saída de data do BD -->
                    <div class="item"><?php echo date_format(new DateTime($row['dataNasc']), "d/m/Y") ?></div>
                </div>
                <div class="items">
                    <div class="item">E-mail:</div>
                    <div class="item"><?php echo $row['email'] ?></div>
                </div>
                <div style="font-weight: bold; margin-top: 30px">Endereço:</div>
                <div class="items">
                    <div class="item">Logradouro:</div>
                    <div class="item"><?php echo $row['logradouro'] ?></div>
                </div>
                <div class="items">
                    <div class="item">Numero:</div>
                    <div class="item"><?php echo $row['numero'] ?></div>
                </div>
                <div class="items">
                    <div class="item">Bairro:</div>
                    <div class="item"><?php echo $row['bairro'] ?></div>
                </div>
                <div class="items">
                    <div class="item">Cidade:</div>
                    <div class="item"><?php echo $row['cidade'] ?></div>
                </div>
                <div class="items">
                    <div class="item">Estado:</div>
                    <div class="item"><?php echo $row['uf'] ?></div>
                </div>
            </div>
        <?php
        }
    }
}

// retornar resultados por chaves (nome ou cpf)
function consultaCliente()
{
    require('../App/Services/Conexao.php');
    $pesquisa = $_GET['pesquisa'];

    // gerar pesquisa por cpf
    if ($pesquisa == 'cpf') {
        $dados = $_GET['dadoscpf'];
        $query = "SELECT * 
        FROM cliente
        INNER JOIN endereco
        ON cliente.endereco_idEndereco = endereco.idEndereco
        WHERE cpf = $dados";
    }
    // gerar pesquisa pelo nome
    else {
        $dados = $_GET['dadosnome'];
        $query = "SELECT * 
        FROM cliente
        INNER JOIN endereco
        ON cliente.endereco_idEndereco = endereco.idEndereco
        WHERE LOWER(nome) LIKE LOWER('%$dados%')";
    }
    $result = mysqli_query($con, $query);
    // verifica se retorna linhas no array, se não retornar, informa...
    if (!$row = $result->fetch_assoc()) {
        ?>
        <div class="card">
            <hr />
            Nenhum cliente cadastrado com esses dados.
        </div>
        <?php

        // ...se retornar, exibe os clientes
    } else {
        $result = mysqli_query($con, $query);
        while ($row = $result->fetch_assoc()) {
        ?>
            <hr />
            <div class="card">
                <div class="items">
                    <div class="item">Nome: </div>
                    <div class="item"><?php echo "" . $row['nome'] ?></div>
                </div>
                <div class="items">
                    <div class="item">CPF:</div>
                    <div class="item"><?php echo $row['cpf'] ?></div>
                </div>
                <div class="items">
                    <div class="item">Data de Nascimento:</div>
                    <!-- formatar saída de data do BD -->
                    <div class="item"><?php echo date_format(new DateTime($row['dataNasc']), "d/m/Y") ?></div>
                </div>
                <div class="items">
                    <div class="item">E-mail:</div>
                    <div class="item"><?php echo $row['email'] ?></div>
                </div>
                <div style="font-weight: bold">Endereço:</div>
                <div class="items">
                    <div class="item">Logradouro:</div>
                    <div class="item"><?php echo $row['logradouro'] ?></div>
                </div>
                <div class="items">
                    <div class="item">Numero:</div>
                    <div class="item"><?php echo $row['numero'] ?></div>
                </div>
                <div class="items">
                    <div class="item">Bairro:</div>
                    <div class="item"><?php echo $row['bairro'] ?></div>
                </div>
                <div class="items">
                    <div class="item">Cidade:</div>
                    <div class="item"><?php echo $row['cidade'] ?></div>
                </div>
                <div class="items">
                    <div class="item">Estado:</div>
                    <div class="item"><?php echo $row['uf'] ?></div>
                </div>
            </div>

        <?php
        }
    }
}

// pagina de excluir cliente
function excluirCliente()
{
    require('../App/Services/Conexao.php');
    $query = "SELECT * 
    FROM cliente
    INNER JOIN endereco
    ON cliente.endereco_idEndereco = endereco.idEndereco";
    $result = mysqli_query($con, $query);

    // verifica se retorna linhas no array, se não retornar, informa...
    if (!$row = $result->fetch_assoc()) {
        ?>
        <div class="card">
            Nenhum cliente cadastrado.
        </div>
        <?php
    }
    // ...se retornar, exibe os clientes 
    else {
        $result = mysqli_query($con, $query);
        while ($row = $result->fetch_assoc()) {
        ?>
            <div class="card excluir">
                <div class="items">
                    <div class="item">Nome: </div>
                    <div class="item"><?php echo "" . $row['nome'] ?></div>
                </div>
                <div class="items">
                    <div class="item">CPF:</div>
                    <div class="item"><?php echo $row['cpf'] ?></div>
                </div>
                <form action="confirma_exclusao.php" method="GET">
                    <input style="display: none" name="idCliente" value="<?php echo $row['idCliente'] ?>" />
                    <button type="submit" class="botaoexcluir" alt="Excluir cliente" title="Excluir cliente">
                        X
                    </button>
                </form>
            </div>
        <?php
        }
    }
}

function exibeExclusao()
{
    require('../App/Services/Conexao.php');
    $id = $_GET['idCliente'];

    $query = "SELECT * 
    FROM cliente
    INNER JOIN endereco
    ON cliente.endereco_idEndereco = endereco.idEndereco
    WHERE idCliente = $id";

    $result = mysqli_query($con, $query);
    // verifica se retorna linhas no array, se não retornar, informa...
    if (!$row = $result->fetch_assoc()) {
        ?>
        <div class="card">
            <hr />
            Nenhum cliente cadastrado com esses dados.
        </div>
        <?php

        // ...se retornar, exibe os clientes
    } else {
        $result = mysqli_query($con, $query);
        while ($row = $result->fetch_assoc()) {
        ?>
            <div class="card" style="min-width: 500px;">
                <div class="items">
                    <div class="item">Nome: </div>
                    <div class="item"><?php echo "" . $row['nome'] ?></div>
                </div>
                <div class="items">
                    <div class="item">CPF:</div>
                    <div class="item"><?php echo $row['cpf'] ?></div>
                </div>
                <div class="items">
                    <div class="item">Data de Nascimento:</div>
                    <!-- formatar saída de data do BD -->
                    <div class="item"><?php echo date_format(new DateTime($row['dataNasc']), "d/m/Y") ?></div>
                </div>
                <div class="items">
                    <div class="item">E-mail:</div>
                    <div class="item"><?php echo $row['email'] ?></div>
                </div>
                <div style="font-weight: bold; margin-top: 15px;">Endereço:</div>
                <div class="items">
                    <div class="item">Logradouro:</div>
                    <div class="item"><?php echo $row['logradouro'] ?></div>
                </div>
                <div class="items">
                    <div class="item">Numero:</div>
                    <div class="item"><?php echo $row['numero'] ?></div>
                </div>
                <div class="items">
                    <div class="item">Bairro:</div>
                    <div class="item"><?php echo $row['bairro'] ?></div>
                </div>
                <div class="items">
                    <div class="item">Cidade:</div>
                    <div class="item"><?php echo $row['cidade'] ?></div>
                </div>
                <div class="items">
                    <div class="item">Estado:</div>
                    <div class="item"><?php echo $row['uf'] ?></div>
                </div>
            </div>
            <hr />
            <div style="display: flex; justify-content: center; color: red">
                <h4>Tem certeza que deseja excluir?</h4>
            </div>
            <div style="display: flex; justify-content: center; margin-top: 5px; gap: 20px">
                <input style="display: none" name="idCliente" value="<?php echo $row['idCliente'] ?>" />
                <input style="display: none" name="idEndereco" value="<?php echo $row['idEndereco'] ?>" />
                <button onclick="location.href='../public_html/excluir_cliente.php'" type="button" style="margin: 0px;">Cancelar</button>

                <button type="submit" name="confirma" style="margin: 0 0px;">Confirmar</button>
                <?php
                if (isset($_GET["confirma"])) {
                    confirmaExclusao();
                }
                ?>
            </div>

<?php
        }
    }
}

function confirmaExclusao()
{
    require('../App/Services/Conexao.php');
    $id = $_GET['idCliente'];
    $adressId = $_GET['idEndereco'];

    $query1 = "DELETE FROM cliente WHERE idCliente = $id";
    $query2 = "DELETE FROM endereco WHERE idEndereco = $adressId";

    if (mysqli_query($con, $query1)) {
        if (mysqli_query($con, $query2)) {
            echo "<script>window.location='excluir_sucesso.php'</script>";
        } else {
            echo "<script>window.location='excluir_erro.php'</script>";
        }
    } else {
        echo "<script>window.location='excluir_erro.php'</script>";
    }
}
