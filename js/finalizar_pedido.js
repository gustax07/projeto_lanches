{
let diasemana = [];
async function BuscarDadosDoBanco() {
    try {

        const resposta = await fetch('./actions/horario_dias/buscar_horarios.php');
        diasemana = await resposta.json();

        AtualizarStatus();
    } catch (erro) {
        console.error("Erro ao atualizar dados do banco:", erro);
    }
}

function AtualizarStatus() {
    if (diasemana.length == 0) return;
    const data = new Date();
    const dia = data.getDay();

    const h = String(data.getHours()).padStart(2, '0');
    const m = String(data.getMinutes()).padStart(2, '0');
    const hora_minuto = `${h}:${m}:00`;

    const horario_inicio = diasemana[dia].horario_inicio;
    const horario_fim = diasemana[dia].horario_fim;

    const btnFinalizar = document.getElementById('btnFinalizar');
    if (hora_minuto >= horario_inicio && hora_minuto <= horario_fim) {
        btnFinalizar.removeAttribute('disabled');
        btnFinalizar.textContent = 'Finalizar Pedido';
    } else {
        btnFinalizar.setAttribute('disabled', 'true');
        btnFinalizar.textContent = 'Lanchonete Fechado';
    }
}

setInterval(BuscarDadosDoBanco, 60000);

BuscarDadosDoBanco();
}