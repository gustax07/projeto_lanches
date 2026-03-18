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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status do Sistema</title>
</head>

<body>
    <h2> Gerenciamento de Abertura do Sistema</h2>
    <form action="processa_abertura.php" method="post">
        <label for="status">Status do Sistema:</label>
        <select name="status" id="status">
            <?php foreach ($status_sistema_listar as $status): ?>
                <option value="<?php echo $status['id']; ?>" <?php echo ($status['id'] == 1) ? 'selected' : ''; ?>>
                    <?php echo $status['status']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>
        <input type="submit" value="Atualizar Status">
    </form>
    <br><br>
    <h3>Horários de Funcionamento:</h3>
    <br><br>
    <table class="table">
        <tr>
            <th>Dia da Semana</th>
            <th>Horário de Início</th>
            <th>Horário de Fim</th>
            <th>Ação</th>
        </tr>
        <tr>
            <?php foreach ($horarios_dias_listar as $horario):
            $botaoFechar = '<button type="button" onclick="fechar_horario(' . $horario['id'] . ')">Fechar</button>';
            // remover os segundos do horário e verificar se é null para mostrar como fechado
                $horario['horario_inicio'] = substr($horario['horario_inicio'], 0, 5);
                $horario['horario_fim'] = substr($horario['horario_fim'], 0, 5);
                $horario['horario_inicio'] == null ? $horario['horario_inicio'] = 'Fechado' : $horario['horario_inicio'] = $horario['horario_inicio'];
                $horario['horario_fim'] == null ? $horario['horario_fim'] = 'Fechado' : $horario['horario_fim'] = $horario['horario_fim']; ?>
                <td id=<?= $horario['id'] ?>><?php echo $horario['dia_semana']; ?></td>
                <td id=<?= $horario['id'] ?>><?php echo $horario['horario_inicio']; ?></td>
                <td id=<?= $horario['id'] ?>><?php echo $horario['horario_fim']; ?></td>
                <td id=<?= $horario['id'] ?>>
                    <button type="button" onclick="editar_horario(<?php echo $horario['id']; ?>)">Alterar</button>
                    <?php if ($horario['horario_inicio'] !== 'Fechado' && $horario['horario_fim'] !== 'Fechado') {
                        echo $botaoFechar;
                    } ?>
                </td>
            
        </tr>
    <?php endforeach; ?>
    </table>

    <script>
        function editar_horario(id) {
            id_semana = document.querySelectorAll(`td[id="${id}"]`)[0].innerText;
            horario_inicio = document.querySelectorAll(`td[id="${id}"]`)[1].innerText;
            horario_fim = document.querySelectorAll(`td[id="${id}"]`)[2].innerText;
            //tranforma em input
            document.querySelectorAll(`td[id="${id}"]`)[1].innerHTML = `<input type="time" id="horario_inicio_${id}" value="${horario_inicio}">`;
            document.querySelectorAll(`td[id="${id}"]`)[2].innerHTML = `<input type="time" id="horario_fim_${id}" value="${horario_fim}">`;
            document.querySelectorAll(`td[id="${id}"]`)[3].innerHTML = `<button type="button" onclick="salvar_horario(${id})">Salvar</button>
            <button type="button" onclick="cancelar_edicao(${id})">Cancelar</button>`;
        }
        //funcao para salvar o horario usando ajax fetch via post
        async function salvar_horario(id) {
            const horario_inicio = document.getElementById(`horario_inicio_${id}`).value;
            const horario_fim = document.getElementById(`horario_fim_${id}`).value;

            try {
                const response = await fetch('../actions/horario_dias/editar_horario.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id: id,
                        horario_inicio: horario_inicio,
                        horario_fim: horario_fim
                    })
                })
                const data = await response.json();

                if (data.status === 'sucesso') {
                    document.querySelectorAll(`td[id="${id}"]`)[1].innerText = horario_inicio;
                    document.querySelectorAll(`td[id="${id}"]`)[2].innerText = horario_fim;
                    document.querySelectorAll(`td[id="${id}"]`)[3].innerHTML = `<button type="button" onclick="editar_horario(${id})">Alterar</button> 
                    <button type="button" onclick="fechar_horario(${id})">Fechar</button>`;
                } else {
                    alert('Ocorreu um erro ao atualizar o horário.');
                }
            } catch (error) {
                console.error('Erro:', error);
            };
        }

        function cancelar_edicao(id) {
            const horario_inicio = document.getElementById(`horario_inicio_${id}`).value;
            const horario_fim = document.getElementById(`horario_fim_${id}`).value;
            document.querySelectorAll(`td[id="${id}"]`)[1].innerText = horario_inicio;
            document.querySelectorAll(`td[id="${id}"]`)[2].innerText = horario_fim;
            document.querySelectorAll(`td[id="${id}"]`)[3].innerHTML = `<button type="button" onclick="editar_horario(${id})">Alterar</button> 
            <button type="button" onclick="fechar_horario(${id})">Fechar</button>`;
        }

       async function fechar_horario(id) {
            const horario_inicio = 'null';
            const horario_fim = 'null';
                try {
                    const response = await fetch('../actions/horario_dias/editar_horario.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            id: id,
                            horario_inicio: horario_inicio,
                            horario_fim: horario_fim
                        })
                    })
                    const data = await response.json();

                    if (data.status === 'sucesso') {
                        alert('Horário fechado com sucesso!');
                        //atualiza a tabela
                        document.querySelectorAll(`td[id="${id}"]`)[1].innerText = 'Fechado';
                        document.querySelectorAll(`td[id="${id}"]`)[2].innerText = 'Fechado';
                        document.querySelectorAll(`td[id="${id}"]`)[3].innerHTML = `<button type="button" onclick="editar_horario(${id})">Alterar</button>`;
                    } else {
                        alert('Ocorreu um erro ao fechar o horário.');
                    }
                } catch (error) {
                    console.error('Erro:', error);
                }
        }
    
                //parte infernal para atualizar o status de abertura do sistema usando ajax fetch via post
        const form = document.querySelector('form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            const status = document.getElementById('status').value;

        });
    </script>


</body>

</html>