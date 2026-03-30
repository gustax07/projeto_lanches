const iconSave = `<svg class="svg" viewBox="0 0 448 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M434.8 70.1c14.3 10.4 17.5 30.4 7.1 44.7l-256 352c-5.5 7.6-14 12.3-23.4 13.1s-18.5-2.7-25.1-9.3l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l101.5 101.5 234-321.7c10.4-14.3 30.4-17.5 44.7-7.1z"/></svg>`;
const iconCancel = `<svg class="svg" viewBox="0 0 512 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M256 64c-56.8 0-107.9 24.7-143.1 64l47.1 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 192c-17.7 0-32-14.3-32-32L0 32C0 14.3 14.3 0 32 0S64 14.3 64 32l0 54.7C110.9 33.6 179.5 0 256 0 397.4 0 512 114.6 512 256S397.4 512 256 512c-87 0-163.9-43.4-210.1-109.7-10.1-14.5-6.6-34.4 7.9-44.6s34.4-6.6 44.6 7.9c34.8 49.8 92.4 82.3 157.6 82.3 106 0 192-86 192-192S362 64 256 64z"/></svg>`;

const iconAlter = `<svg viewBox="0 0 512 512" class="svg"><path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path></svg>`;
const iconClose = `<svg class="svg" viewBox="0 0 512 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--> <path d="M183.1 137.4C170.6 124.9 150.3 124.9 137.8 137.4C125.3 149.9 125.3 170.2 137.8 182.7L275.2 320L137.9 457.4C125.4 469.9 125.4 490.2 137.9 502.7C150.4 515.2 170.7 515.2 183.2 502.7L320.5 365.3L457.9 502.6C470.4 515.1 490.7 515.1 503.2 502.6C515.7 490.1 515.7 469.8 503.2 457.3L365.8 320L503.1 182.6C515.6 170.1 515.6 149.8 503.1 137.3C490.6 124.8 470.3 124.8 457.8 137.3L320.5 274.7L183.1 137.4z"/></svg>`;

//funcao para editar o horario usando ajax fetch via post
function editar_horario(id) {
    //pegar os ids
    let linha = document.querySelector(`div[data-id="${id}"]`);
    let td_inicio = linha.querySelector('.col-inicio');
    let td_fim = linha.querySelector('.col-fim');
    let td_botoes = linha.querySelector('.col-botoes');

    //pegar os valores
    let valor_inicio = td_inicio.innerText;
    let valor_fim = td_fim.innerText;

    //salva todos os valores para voltar no modo que estavaa
    td_inicio.dataset.antigo = valor_inicio;
    td_fim.dataset.antigo = valor_fim;
    td_botoes.dataset.antigo = `
                            <div class="btn-wrapper">
                                <button type="button" class="Btn" style="background-color: #17a2b8;" onclick="editar_horario(${id})">Alterar <svg viewBox="0 0 512 512" class="svg">
                                        <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path>
                                    </svg></button><!-- botao de fechar o sistema -->
                                <button type="button" class="Btn" style="background-color: #6c757d;" onclick="fechar_horario(${id})">Fechar <svg class="svg" viewBox="0 0 512 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M183.1 137.4C170.6 124.9 150.3 124.9 137.8 137.4C125.3 149.9 125.3 170.2 137.8 182.7L275.2 320L137.9 457.4C125.4 469.9 125.4 490.2 137.9 502.7C150.4 515.2 170.7 515.2 183.2 502.7L320.5 365.3L457.9 502.6C470.4 515.1 490.7 515.1 503.2 502.6C515.7 490.1 515.7 469.8 503.2 457.3L365.8 320L503.1 182.6C515.6 170.1 515.6 149.8 503.1 137.3C490.6 124.8 470.3 124.8 457.8 137.3L320.5 274.7L183.1 137.4z"></path></svg></button>                            
                                </div>
`;
    //tranforma em input
    td_inicio.innerHTML = `<input type="time" id="horario_inicio_${id}" value="${valor_inicio}">`;
    td_fim.innerHTML = `<input type="time" id="horario_fim_${id}" value="${valor_fim}">`;
    td_botoes.innerHTML = `<div class="btn-wrapper">
            <button type="button" id="btn_salvar" class="Btn btn-save" onclick="salvar_horario(${id})">Salvar ${iconSave} </button>
            <button type="button" class="Btn btn-cancel" onclick="cancelar_edicao(${id})">Cancelar ${iconCancel} </button>
            </div>`;
}

//funcao para salvar o horario usando ajax fetch via post
async function salvar_horario(id) {
    let linha = document.querySelector(`div[data-id="${id}"]`);
    let td_inicio = linha.querySelector('.col-inicio');
    let td_fim = linha.querySelector('.col-fim');
    let td_botoes = linha.querySelector('.col-botoes');
    let btnSalvar = td_botoes.querySelector('#btn_salvar');

    btnSalvar.dataset.antigo = btnSalvar.innerHTML;
    let btnBackup = btnSalvar.innerHTML;

    //adicionar uma bolinha de carregamento dentro do botao
    let valor_inicio = linha.querySelector(`#horario_inicio_${id}`).value;
    let valor_fim = linha.querySelector(`#horario_fim_${id}`).value;

    if (valor_inicio >= valor_fim) {
        Swal.fire({
            icon: 'error',
            tile: 'ERRO!',
            text: 'Digite um horário válido!',
            confirmButtonText: 'OK',
            confirmButtonColor: '#a31818'
        });
        btnSalvar.innerHTML = btnBackup;
        btnSalvar.removeAttribute('disabled');
        return;
    }

    btnSalvar.innerHTML = `<div class="container">
    <div class="spinner-border spinner-border-sm" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
    </div>`;
    btnSalvar.setAttribute('disabled', 'true');
    try {
        const response = await fetch('../actions/horario_dias/editar_horario.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id: id,
                horario_inicio: valor_inicio,
                horario_fim: valor_fim
            })
        })
        const data = await response.json();

        if (data.status == 'sucesso') {
            td_inicio.innerText = valor_inicio;
            td_fim.innerText = valor_fim;
            td_botoes.innerHTML = td_botoes.dataset.antigo;

            td_inicio.dataset.antigo = valor_inicio;
            td_fim.dataset.antigo = valor_fim;
            btnSalvar.innerHTML = btnBackup;
            btnSalvar.removeAttribute('disabled');

        } else {
            Swal.fire({
                icon: 'warning',
                tile: 'AVISO!',
                text: data.mensagem + ',' + valor_inicio + '-' + valor_fim + "=" + id,
                confirmButtonText: 'OK',
                confirmButtonColor: '#a31818'
            });
            btnSalvar.innerHTML = btnBackup;
            btnSalvar.removeAttribute('disabled');
            
        }
    } catch (error) {
        console.error('Erro:', error);
    };
}

function cancelar_edicao(id) {
    let linha = document.querySelector(`div[data-id="${id}"]`);
    let td_inicio = linha.querySelector('.col-inicio');
    let td_fim = linha.querySelector('.col-fim');
    let td_botoes = linha.querySelector('.col-botoes');

    // Restaura os textos e o HTML dos botões salvos no dataset
    td_inicio.innerText = td_inicio.dataset.antigo;
    td_fim.innerText = td_fim.dataset.antigo;
    td_botoes.innerHTML = td_botoes.dataset.antigo;
}

async function fechar_horario(id) {
    const result = await Swal.fire({
        title: "AVISO!",
        text: "Deseja realmente fechar o sistema?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sim",
        cancelButtonText: "Não"
    });

    if (result.isConfirmed) {
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
            });

            const data = await response.json();

            if (data.status === 'sucesso') {
                let linha = document.querySelector(`div[data-id="${id}"]`);
                let td_inicio = linha.querySelector('.col-inicio');
                let td_fim = linha.querySelector('.col-fim');
                let td_botoes = linha.querySelector('.col-botoes');
                td_inicio.innerText = 'Fechado';
                td_fim.innerText = 'Fechado';
                td_botoes.innerHTML = `<div class="btn-wrapper"><button type="button" class="Btn" style="background-color: #17a2b8;" onclick="editar_horario(${id})">Alterar ${iconAlter}</button></div>`;
                
                Swal.fire({ icon: 'success', title: 'SUCESSO!', text: 'Atualização realizada com sucesso!', confirmButtonText: 'OK', confirmButtonColor: '#a31818' });
            } else {
                Swal.fire({ icon: 'error', title: 'ERRO!', text: 'Ocorreu um problema para fechar o sistema.', confirmButtonText: 'OK', confirmButtonColor: '#a31818' });
            }
        } catch (error) {
            console.error('Erro:', error);
        }
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

    const h = String(data.getHours()).padStart(2, '0');
    const m = String(data.getMinutes()).padStart(2, '0');
    const hora_minuto = `${h}:${m}:00`;

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