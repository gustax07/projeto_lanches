{

    function abrirSeletor() {
        document.getElementById('inputFoto').click();

        document.getElementById('inputFoto').addEventListener('change', function () {
            if (this.files.length > 0) {
                document.getElementById('formFoto').submit();
            }
        });
    }

    let diassemana = [];
    async function BuscarDadosDoBanco() {
        try {

            const resposta = await fetch('actions/horario_dias/buscar_horarios.php');

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

    BuscarDadosDoBanco();


    let itens = [];
    let btnAbrirCarrinho = document.querySelector('.btn-carrinho');

    async function VerificarUsuarioLogado() {
        const response = await fetch('actions/pedidos/listar_pedidos_carrinho.php');
        const data = await response.json();

        if (data.status == 'sucesso') {
            itens = data.lista;

            await CarregarBadgeCarrinho();
            btnAbrirCarrinho.removeAttribute('hidden');
        } else {
            btnAbrirCarrinho.setAttribute('hidden', 'true');

        }
    }

    window.CarregarBadgeCarrinho = async function () {
        let badge = document.querySelector('.badge-carrinho');
        if (itens.length > 0) {
            badge.innerHTML = itens.length;
        }
        else {
            badge.remove();
        }

    }

    VerificarUsuarioLogado();

    //uma function que vai pegar todas as informações usuario usando fetch através do ID e retorna para o front-end
    async function InformacoesLogin() {
        const botoes = `
          <a href="pages/logar.html" target="_parent" class="btn-login">Logar</a>
          <a href="pages/cadastrar.html" target="_parent" class="btn-register">Cadastre-se</a>
        `;

        const perfil = `
        <h3 class="user-greeting">Bem-vindo,
            <strong id="nomeUsuario"></strong>
          </h3>
          <button class="btn rounded-circle profile-btn-header" type="button" data-bs-toggle="dropdown" aria-expanded="true" onclick="statusMobile()";>
          <img id="fotoUsuario" class="rounded-circle" />
          </button>
          <div class="dropdown">
          <ul class="dropdown-menu">
            <li><div id="statusMobile"></div></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/admin">Dashboard</a></li>
            <li><a class="dropdown-item" href="/conta">Configurações da conta</a></li>
            <li><a class="dropdown-item" href="/pedidos">Pedidos</a></li>
            <li><a class="dropdown-item" href="/enderecos">Endereços</a></li>
            <li><a class="dropdown-item" href="/telefones">Telefones</a></li>
          </ul>
        </div>
          `;
        const btnDashboard = `
        <a class="btn btn-warning text-white" href="admin" target="_blank">Dashboard</a>
        `;

        const response = await fetch('actions/clientes/listar_clientes.php');
        const data = await response.json();

        if (data.status == 'sucesso') {
            document.querySelector('.header-buttons').innerHTML = perfil;
            document.getElementById('nomeUsuario').innerHTML = data.lista[0].nome;
            document.getElementById('fotoUsuario').src = 'images/' + data.lista[0].foto;

            //verificar se o cargo do usuario não é cliente para liberar o dashboard
            if (data.lista[0].id_tipo_fk != 0) {
                document.getElementById('dashboard').innerHTML = btnDashboard;
            }

        } else {
            document.querySelector('.header-buttons').innerHTML = botoes;
        }

    }
    InformacoesLogin()

    function statusMobile() {
          if (diassemana.length == 0) return;
        const data = new Date();
        const dia = data.getDay();

        const h = String(data.getHours()).padStart(2, '0');
        const m = String(data.getMinutes()).padStart(2, '0');
        const hora_minuto = `${h}:${m}:00`;

        const horario_inicio = diassemana[dia].horario_inicio;
        const horario_fim = diassemana[dia].horario_fim;

        const status = document.getElementById('statusMobile');
        if (hora_minuto >= horario_inicio && hora_minuto <= horario_fim) {
            status.innerText = 'Aberto';
            status.setAttribute('class', 'alert alert-success');
        } else {
            status.innerText = 'Fechado';
            status.setAttribute('class', 'alert alert-danger w-50 mx-auto text-center p-0');
        }
    }

}