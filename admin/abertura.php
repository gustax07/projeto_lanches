<?php

require_once('../classes/horarios_dias.class.php');
require_once('../classes/status_sistema.class.php');
$horarios_dias = new HorarioDias();
$status_sistema = new StatusSistema();
$horarios_dias_listar = $horarios_dias->Listar();
$status_sistema_listar = $status_sistema->Listar();

require('header.php');

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <script src="../js/abertura.js" defer></script>
    <link rel="stylesheet" href="../css/abertura_admin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status do Sistema</title>
</head>

<body>

    <div class="status">
        <label for="status">Status do Sistema:
        </label>
        <span id="status">
            <div class="spinner-border text-success" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </span>
    </div>

    <div class="wrapper">
        <div class="table">
            <div class="row header">
                <div class="cell">Dia da Semana</div>
                <div class="cell">Horário de Início</div>
                <div class="cell">Horário de Término</div>
                <div class="cell">Ações</div>
            </div>
                <?php foreach ($horarios_dias_listar as $horario):
                    $botaoFechar = '<button type="button" class="Btn" style="background-color: #6c757d;" onclick="fechar_horario(' . $horario['id'] . ')">Fechar <svg class="svg" viewBox="0 0 512 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M183.1 137.4C170.6 124.9 150.3 124.9 137.8 137.4C125.3 149.9 125.3 170.2 137.8 182.7L275.2 320L137.9 457.4C125.4 469.9 125.4 490.2 137.9 502.7C150.4 515.2 170.7 515.2 183.2 502.7L320.5 365.3L457.9 502.6C470.4 515.1 490.7 515.1 503.2 502.6C515.7 490.1 515.7 469.8 503.2 457.3L365.8 320L503.1 182.6C515.6 170.1 515.6 149.8 503.1 137.3C490.6 124.8 470.3 124.8 457.8 137.3L320.5 274.7L183.1 137.4z"/></svg></button>';

                    $horario['horario_inicio'] = substr($horario['horario_inicio'], 0, 5);
                    $horario['horario_fim'] = substr($horario['horario_fim'], 0, 5);
                    $horario['horario_inicio'] == null ? $horario['horario_inicio'] = 'Fechado' : $horario['horario_inicio'] = $horario['horario_inicio'];
                    $horario['horario_fim'] == null ? $horario['horario_fim'] = 'Fechado' : $horario['horario_fim'] = $horario['horario_fim']; ?>

                    <div class="row" data-id="<?= $horario['id'] ?>">
                        <div class="cell col-dia" data-title="Dia da Semana"><?= $horario['dia_semana']; ?></div>
                        <div class="cell col-inicio" data-title="Horário de Início"><?= $horario['horario_inicio']; ?></div>
                        <div class="cell col-fim" data-title="Horário de Término"><?= $horario['horario_fim']; ?></div>
                        <div class="cell col-botoes" data-title="Ações">

                            <div class="btn-wrapper">
                                <button type="button" class="Btn" style="background-color: #17a2b8;" onclick="editar_horario(<?php echo $horario['id']; ?>)">Alterar <svg viewBox="0 0 512 512" class="svg">
                                        <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path>
                                    </svg></button>

                                <!-- botao de fechar o sistema -->
                                <?php if ($horario['horario_inicio'] !== 'Fechado' && $horario['horario_fim'] !== 'Fechado') {
                                    echo $botaoFechar;
                                } ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
        </div>
    </div>
</body>

</html>