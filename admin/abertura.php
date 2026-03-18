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
    <style>
        .alert {
            padding: 3px 10px !important;
        }

        h2 {
            text-align: center !important;
            margin: 30px auto !important;
        }

        .label {
            font-weight: bold !important;
            margin-right: 10px !important;
            font-size: 18px !important;
            display: flex;
            justify-content: center;
        }

        .status {
            display: flex;
            justify-content: center;
            margin: 10px 0 !important;
        }
    </style>
</head>

<body>
    <h2> Gerenciamento de Abertura do Sistema</h2>

    <div class="status">
        <label class="label" for="status">Status do Sistema:
        </label>
        <span id="status">
            <div class="spinner-border text-success" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </span>
    </div>

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



        let diassemana = [];
        async function BuscarDadosDoBanco() {
            try {

                const resposta = await fetch('../actions/horario_dias/buscar_horarios.php');
                diassemana = await resposta.json();

                AtualizarStatus();
            } catch (erro) {
                console.error("Erro ao atualizar dados do banco:", erro);
            }
        }

        function AtualizarStatus() {
            if (diassemana.length == 0) return;
            const data = new Date();
            const dia = data.getDay();

            const hora_atual = data.getHours();
            const minuto_atual = data.getMinutes();
            const hora_minuto = hora_atual + ':' + minuto_atual + ':00';

            const horario_inicio = diassemana[dia].horario_inicio;
            const horario_fim = diassemana[dia].horario_fim;

            const status = document.getElementById('status');
            if (hora_minuto >= horario_inicio && hora_minuto <= horario_fim) {
                status.innerText = 'Aberto';
                status.setAttribute('class', 'alert alert-success');
            } else {
                status.innerText = 'Fechado';
                status.setAttribute('class', 'alert alert-danger');
            }
        }

        setInterval(BuscarDadosDoBanco, 60000);

        BuscarDadosDoBanco();
    </script>


</body>

</html>