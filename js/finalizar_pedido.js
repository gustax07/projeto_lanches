let diassemana = [];
async function BuscarDadosDoBanco() {
    try {

        const resposta = await fetch('./actions/horario_dias/buscar_horarios.php');
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

    const h = String(data.getHours()).padStart(2, '0');
    const m = String(data.getMinutes()).padStart(2, '0');
    const hora_minuto = `${h}:${m}:00`;

    const horario_inicio = diassemana[dia].horario_inicio;
    const horario_fim = diassemana[dia].horario_fim;

    const status = document.getElementById('btnFinalizar');
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