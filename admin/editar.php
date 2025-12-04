<?php

require_once('../classes/cargos.class.php');
$cargos = new Cargos();
$cargos_listar = $cargos->Listar();

require_once('../classes/funcionarios.class.php');
$funcionarios = new funcionarios();
$funcionarios->id = $_GET['id'];
$funcionarios_listar = $funcionarios->ListarPorID();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Funcionarios</title>
</head>
<body>
    <h1>Editar Funcionarios</h1>
    <form action="../actions/funcionarios/editar_funcionarios.php" method="post">
    <label for="nome">Nome</label>
    <br>
    <input type="text" name="nome" id="nome" value="<?= $funcionarios_listar[0]['nome'] ?>">
    <br>
    <label for="email">Email</label>
    <br>
    <input type="text" name="email" id="email" value="<?= $funcionarios_listar[0]['email'] ?>">
    <br>
    <label for="senha">Senha</label>
    <br>
    <input type="text" name="senha" id="senha">
    <br>
    <label for="data_contratacao">Data Contratacao</label>
    <br>
    <input type="date" name="data_contratacao" id="data_contratacao" value="<?= $funcionarios_listar[0]['data_contratacao'] ?>">
    <br>
    <label for="id_cargos">Cargo</label>
    <br>
    <select name="id_cargos" id="id_cargos">
        <?php foreach ($cargos_listar as $c) {?>
            <option value="<?= $c['id_cargo'] ?>" <?= ($c['id_cargo'] == $funcionarios_listar[0]['id_cargos_fk']) ? 'selected' : ''?>> <?= $c['nome_cargo'] ?></option>
       <?php } ?>
    </select>
    <br>
    <br>
    <button type="submit">Editar</button>
    </form>    


</body>
</html>