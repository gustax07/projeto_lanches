<?php
session_start();
$idUsuario = $_SESSION['usuario']['id'];

if (!isset($_SESSION['usuario'])) {
    header('Location: logar.php');
    exit;
}
include_once("classes/telefones.class.php");
$telefones = new Telefones();

$telefones->id_usuarios_fk = $idUsuario;
$listar = $telefones->ListarPorID();
$qtdTelefones = count($listar);

include_once("header.php");
include_once("includes/bootstrap_include.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telefones</title>
    <style>
      
    </style>
</head>

<body>
  <h2>Lista de Telefones registrados</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Localização</th>
      <th>Telefone</th>
      <th>Ações</th>
    </tr>
    <tr>
 <?php foreach ($listar as $telefone) { ?>
    <td><?= $telefone['id'] ?></td>
    <td>+ <?= $telefone['DDI'] ?></td>
    <td><?= $telefone['numero'] ?></td>
    <td>
      <a href="editar_telefones.php?id=<?= $telefone['id'] ?>">Editar</a>
      <a href="excluir_telefones.php?id=<?= $telefone['id'] ?>">Excluir</a>
    </td>
  </tr>
  <?php } ?>
  </table>

 <!-- sessao de adicionar telefones -->
  <button onclick="AdicionarNovosTelefones()" id="criar">Adicionar Telefones</button>
    <div id="form-telefones"></div>


  <script>
    let telExistente = <?= $qtdTelefones ?>;

    function AdicionarNovosTelefones(){
        telExistente++;
        //criar labels
        const label = document.createElement('label');
        label.for = 'telefone' + telExistente;
        label.textContent = 'Telefone' + telExistente;
        document.getElementById('form-telefones').appendChild(label);

        //criar os inputs
       const input = document.createElement('input');
        input.type = 'text';
        input.name = 'telefone' + telExistente;
        input.placeholder = 'Digite o telefone';
        input.required = true;
        input.id = 'telefone';
        document.getElementById('form-telefones').appendChild(input);

        //limites de inputs
        if (telExistente >= 5) {
            // desabilitar o botao
            document.getElementById('criar').disabled = true;
        }
        //adicionar um botao para remover os campos
        const botaoRemover = document.createElement('button');
        botaoRemover.textContent = 'Remover';
        botaoRemover.onclick = function() {
            telExistente--;
            document.getElementById('form-telefones').removeChild(label);
            document.getElementById('form-telefones').removeChild(input);
            document.getElementById('form-telefones').removeChild(botaoRemover);
            if (telExistente < 5) {
                document.getElementById('criar').disabled = false;
            }
            
            //alterar o id do input e do label caso o telefone seja removido antes do numero maior do que ele
            for (let i = telExistente; i > 0; i--) {
                document.getElementById('telefone' + i).id = 'telefone' + i;
                document.getElementById('telefone' + i).name = 'telefone' + i;

            }
            console.log(telExistente);
            
        }
        botaoRemover.id = 'remover';
        document.getElementById('form-telefones').appendChild(botaoRemover);
    }

  </script>
</body>

</html>