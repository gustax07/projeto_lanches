<?php
// session_start();
// if (!isset($_SESSION['funcionario'])) {
//     header('Location: ./logar.php');
//     exit();
// }
require_once('../classes/cargos.class.php');
$cargos = new Cargos();
$cargos_listar = $cargos->Listar();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Funcionarios</title>
</head>
<body>
    <h1>Cadastrar Funcionarios</h1>
    <form action="../actions/funcionarios/cadastrar_funcionarios.php" method="post">
    <label for="nome">Nome</label>
    <br>
    <input type="text" name="nome" id="nome">
    <br>
    <label for="email">Email:</label>
    <br>
    <input type="email" name="email" id="email">
    <br>
    <label for="senha">Senha:</label>
    <br>
    <input type="password" name="senha" id="senha">
    <br>
    <label for="data_contratacao">Data de Contratacao:</label>
    <br>
    <input type="date" name="data_contratacao" id="data_contratacao">
    <br>
    <label for="id_cargos">Cargo:</label>
    <br>
    <select name="id_cargos" id="id_cargos">
        <?php foreach ($cargos_listar as $c) {?>
            <option value="<?= $c['id_cargo'] ?>"> <?= $c['nome_cargo'] ?></option>
       <?php } ?>
        
    </select>
    <br>
    <br>
    <button type="submit">Cadastrar</button>
    </form>
</body>
</html>