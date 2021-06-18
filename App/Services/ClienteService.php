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
// página que exibe os dados do cliente a ser excluido, com as opções de cancelar ou confirmar a exclusão
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
                <button class="cancel" onclick="location.href='../public_html/excluir_cliente.php'" type="button" style="margin: 0px;">Cancelar</button>
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

// página que confirma a exclusão dos dados no banco
function confirmaExclusao()
{
    require('../App/Services/Conexao.php');
    $id = $_GET['idCliente'];
    $adressId = $_GET['idEndereco'];

    // primeiro exclui o cliente e depois exclui o endereço relacionado
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

// página que retorna as páginas com todos os clientes e a opção de editar
function editarCliente()
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
                <form action="editar_dados_cliente.php" method="GET">
                    <input style="display: none" name="idCliente" value="<?php echo $row['idCliente'] ?>" />
                    <button type="submit" class="botaoeditar" alt="Excluir cliente" title="Excluir cliente">
                        <img src="../App/images/icone-editar.png" alt="Editar Cliente" title="Editar Cliente" />
                    </button>
                </form>
            </div>
        <?php
        }
    }
}

// pagina de editar que exibe os dados a serem alterados
function dadosCliente()
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
            Nenhum cliente encontrado com esses dados.
        </div>
        <?php

        // ...se retornar, exibe o cliente
    } else {
        $result = mysqli_query($con, $query);
        while ($row = $result->fetch_assoc()) {
        ?>
            <div class="cliente">
                <form action="" method="POST">
                    <div class="form-group">
                        <div style="font-weight: bold">Dados Pessoais:</div>
                        <div style="margin-top: 10px;">
                            <label for="nome">Nome:</label>
                            <input id="nome" value="<?php echo $row['nome'] ?>" name="nome" required type="texto" class="form-control" placeholder="Nome completo" />
                        </div>
                        <div>
                            <label for="cpf">CPF:</label>
                            <input id="cpf" value="<?php echo $row['cpf'] ?>"" name=" cpf" required maxlength="11" type="texto" class="form-control" placeholder="CPF (somente numeros)" onkeypress="return somenteNumeros(event)" />
                        </div>
                        <div>
                            <label for="data-nascimento">Data de Nascimento:</label>
                            <input id="data-nascimento" value="<?php echo $row['dataNasc'] ?>" required name="data-nascimento" type="date" class="form-control" />
                        </div>
                        <div>
                            <label for="email">E-mail:</label>
                            <input id="email" value="<?php echo $row['email'] ?>" name="email" required type="email" class="form-control" placeholder="email@exemplo.com" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div style="font-weight: bold">Endereço:</div>
                        <div style="margin-top: 10px;">
                            <label for="cep" style="width: 100%;">CEP:</label>
                            <div style="display: flex; margin: 0">
                                <input id="cep" value="<?php echo $row['cep'] ?>" maxlength="8" required name="cep" class="form-control" placeholder="00000000 (somente numeros)" onkeypress="return somenteNumeros(event)" />
                                <button type="button" class="botao" onClick="pesquisacep(cep.value)" style="margin: 0; margin-left: 10px;">Buscar</button>
                            </div>
                        </div>
                        <div id="cepinvalido" class="oculto" style="color: red">
                            *Por favor, informe um CEP válido.
                        </div>
                        <div id="cepnaoencontrado" class="oculto" style="color: red">
                            *CEP não encontrado.
                        </div>
                        <div id="adress">
                            <div>
                                <label for="rua">Lougradouro:</label>
                                <input id="rua" value="<?php echo $row['logradouro'] ?>" required name="rua" type="text" class="form-control" placeholder="Nome da Rua" />
                            </div>
                            <div>
                                <label for="numero">Número:</label>
                                <input id="numero" value="<?php echo $row['numero'] ?>" name="numero" type="text" class="form-control" />
                            </div>
                            <div>
                                <label for="bairro">Bairro:</label>
                                <input id="bairro" value="<?php echo $row['bairro'] ?>" required name="bairro" type="text" class="form-control" />
                            </div>
                            <div>
                                <label for="cidade">Cidade:</label>
                                <input id="cidade" value="<?php echo $row['cidade'] ?>" required name="cidade" type="text" class="form-control" />
                            </div>
                            <div>
                                <label for="uf">Estado:</label>
                                <input id="uf" required value="<?php echo $row['uf'] ?>" name="uf" type="text" class="form-control" />
                            </div>
                            <div style="display: flex; justify-content: center; gap: 20px">
                                <button class="cancel" onclick="location.href='../public_html/editar_cliente.php'" type="button" style="margin: 0px;">Cancelar</button>
                                <input id="cadastrar" name="submit" type="submit" value="Confirmar" onclick="return confirma('editar')" />
                            </div>
                        </div>
                        <script src="../App/Services/Cliente.js"></script>
                    </div>
                </form>
                <?php
                if (isset($_POST["submit"])) {
                    // pegar id do cliente e do endereço a ser atualizado
                    $id = $row['idCliente'];
                    $adress = $row['idEndereco'];

                    // obter novos valores
                    $nome = $_POST['nome'];
                    $cpf = $_POST['cpf'];
                    $dataNasc = $_POST['data-nascimento'];
                    $email = $_POST['email'];
                    $cep = $_POST['cep'];
                    $logradouro = $_POST['rua'];
                    $numero = $_POST['numero'];
                    $bairro = $_POST['bairro'];
                    $cidade = $_POST['cidade'];
                    $uf = $_POST['uf'];

                    // comando de update
                    $query = "UPDATE cliente AS c, endereco AS e
                    SET
                    c.nome = '$nome',
                    c.cpf = $cpf,
                    c.dataNasc = '$dataNasc',
                    c.email = '$email',
                    e.cep = '$cep',
                    e.logradouro = '$logradouro',
                    e.numero = $numero,
                    e.bairro = '$bairro',
                    e.cidade = '$cidade',
                    e.uf = '$uf'
                    WHERE c.idCliente = $id AND e.idEndereco = $adress";

                    // retorna pagina de sucesso ou erro
                    if (mysqli_query($con, $query)) {
                        echo "<script>window.location='editar_cliente_sucesso.php'</script>";
                    } else {
                        echo "<script>window.location='editar_cliente_erro.php'</script>";
                    }
                }
                ?>
            </div>

<?php
        }
    }
}
