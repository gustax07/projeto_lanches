  

  //Tem objetivo de desativar a promocao para status 0 e ativa-lo para status 1
  async function AtivarPromocao(id) {
            const card = document.querySelector('.id-' + id)
            const chkPromocao = card.querySelector('.chkPromocao')
            const btnSalvar = card.querySelector('.btnSalvar')
            const btnEditar = card.querySelector('.btnEditar')
            const btnExcluir = card.querySelector('.btnExcluir')
            const btnCancelar = card.querySelector('.btnCancelar')

            const response = await fetch('../actions/promocoes/ativar_promocao.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: id,
                    status: chkPromocao.checked ? 1 : 0
                })
            })

            const data = await response.json();

            if (data['status'] == 'sucesso') {
                card.style.opacity = chkPromocao.checked ? "1" : "0.8";
                btnSalvar.disabled = !chkPromocao.checked;
                btnEditar.disabled = !chkPromocao.checked;
                btnEditar.hidden = !chkPromocao.checked;
                btnCancelar.disabled = !chkPromocao.checked;
                btnExcluir.hidden = chkPromocao.checked;
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'ERRO!',
                    text: data['message'],
                })
            }
        }

       //Carregar todos os cards das promocoes existentes
        function CarregarCardsPromocoes() {
            const container = document.getElementById('cards-load');
            container.innerHTML = '';

            listPromocoes.forEach(promocao => {
                const isActive = promocao['status'] == 1;
                const opacity = isActive ? 1 : 0.6;
                const checked = isActive ? 'checked' : '';

                const VdataConvertida = promocao['data_validade'].split('-').reverse().join('/');

                const VprecoConvertida = promocao['preco'].replace('.', ',');
                const VprecoPromocionalConvertida = promocao['preco_promocional'].replace('.', ',');

                container.innerHTML += `
                <div class="d-flex card card-promocao id-${promocao['id']}" style="opacity: ${opacity}" ">
                <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mt-2">
                <h5 id="nome" class="col card-title">${promocao['nome_promocao']}</h5>
                <div class="form-check form-switch">
                <input class="form-check-input chkPromocao" type="checkbox" ${checked} onclick="AtivarPromocao(${promocao['id']})">
                
                </div>
                </div>

                <hr style="">

                <div class="mb-3" style="height: 250px; width: 100%;">
                <img src="../images/${promocao['imagem']}" class="rounded mb-3 border w-100 h-100" alt="...">
                </div>

                <h5 class="fw-bold">Produto: ${promocao['nome']} </h5>
                
                <div class="d-flex flex-wrap align-items-center">
                <span class="me-1 fs-6 fw-bold">Precos:</span>
                <span id="preco" style="color: green;">${VprecoPromocionalConvertida}</span>
                <span class="mx-2"> - </span>
                <span class="precoOriginal" style="text-decoration: line-through; color: red">${VprecoConvertida}</span>
                </div>

                <p class="fw-bold">Validade: <span id="validade" class="fw-normal">${VdataConvertida}</span> </p>
                <hr style="margin: 0; padding: 0;">
                </div>
                <input type="hidden" value="" name="id">
                <div class="container-fluid d-flex justify-content-between mb-3">
                <button type="button" class="btn-tasty btnEditar" onclick="EditarPromocao(${promocao['id']})"><i class="bi bi-pencil-square"></i> Editar</button>
                <button type="button" class="btn btn-success btnSalvar" onclick="SalvarPromocao(${promocao['id']})" hidden><i class="bi bi-check2-square"></i> Salvar</button>
                <button type="button" class="btn-cancel-tasty  btnCancelar" onclick="CancelarPromocao(${promocao['id']})" hidden><i class="bi bi-x-square"></i> Cancelar</button>
                <button type="button" class="btn-cancel-tasty  btnExcluir" onclick="ExcluirPromocao(${promocao['id']})" hidden><i class="bi bi-trash"></i> Excluir</button>
                </div>
                </div>
                `;

                // alteracoes do dados dos cards ao serem criados
                const card = document.querySelector('.id-' + promocao['id'])
                const btnExcluir = card.querySelector('.btnExcluir')
                const btnEditar = card.querySelector('.btnEditar')
                isActive ? btnExcluir.hidden = true : btnExcluir.hidden = false;
                isActive ? btnEditar.hidden = false : btnEditar.hidden = true;


            });
        }
        CarregarCardsPromocoes();

        //Editar as informacoes atraves dos inputs criado no card
        function EditarPromocao(id) {

            const card = document.querySelector('.id-' + id)
            const btnEditar = card.querySelector('.btnEditar')
            const btnSalvar = card.querySelector('.btnSalvar')
            const btnCancelar = card.querySelector('.btnCancelar')
            const chkPromocao = card.querySelector('.chkPromocao')

            chkPromocao.hidden = true;
            btnCancelar.hidden = false;
            btnEditar.hidden = true;
            btnSalvar.hidden = false;

            const idNome = card.querySelector('#nome')
            const idPreco = card.querySelector('#preco')
            const idValidade = card.querySelector('#validade')

            idNome.dataset.antigo = idNome.textContent
            idPreco.dataset.antigo = idPreco.textContent
            idValidade.dataset.antigo = idValidade.textContent


            idNome.innerHTML = `
            <input class="input-nome-promo" type="text" value="${idNome.textContent.trim()}" oninput="VerificarPromocaoNome(${id})" placeholder="Nome da Promoção">
            <p id="errNome" class="text-danger" style="font-size: 12px;" hidden></p>
            `
            idPreco.innerHTML = `
            <input class="input-preco-promo" type="text" style="display:inline-block; width: 80px;" value="${idPreco.textContent.trim()}" placeholder="Preço" oninput="VerificarPromocaoPreco(${id})">
            <p id="errPreco" class="text-danger" style="font-size: 12px;" hidden></p>
            `
            const dataConvertida = idValidade.textContent.split('/').reverse().join('-');

            idValidade.innerHTML = `<input class="input-validade-promo" type="date" value="${dataConvertida}">`
            minDate();

        }

        function minDate() {
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const day = String(today.getDate()).padStart(2, '0');
            const minDate = `${year}-${month}-${day}`;
            document.querySelector('.input-validade-promo').setAttribute('min', minDate);
            document.getElementById('dataPromocao').setAttribute('min', minDate);
        }

        //verificacao de dados e limitacoes dos campos inputs
        function VerificarPromocaoNome(id) {
            const card = document.querySelector('.id-' + id)
            const inputNome = card.querySelector('.input-nome-promo')
            const errNome = card.querySelector('#errNome')
            const btnSalvar = card.querySelector('.btnSalvar')

            let liberar = true;
            if (inputNome.value.length < 3) {
                errNome.innerText = 'Mínimo 3 caracteres';
                liberar = false;
            } else if (inputNome.value.length > 20) {
                errNome.innerText = 'Máximo 25 caracteres';
                liberar = false;
            }

            btnSalvar.disabled = !liberar;
            errNome.hidden = liberar;
            inputNome.style.outline = liberar ? '2px solid green' : '2px solid red';
        }


        function VerificarPromocaoPreco(id) {
            const card = document.querySelector('.id-' + id)
            const inputPreco = card.querySelector('.input-preco-promo')
            const errPreco = card.querySelector('#errPreco')
            const btnSalvar = card.querySelector('.btnSalvar')
            const precoOriginalText = card.querySelector('.precoOriginal').innerText;
            const precoOriginal = parseFloat(precoOriginalText.replace(',', '.'));

            let valorLimpo = inputPreco.value.replace(',', '.');
            let liberar = true;

            if (isNaN(valorLimpo) || valorLimpo === "") {
                errPreco.innerText = 'Preço inválido';
                liberar = false;
            } else if (parseFloat(valorLimpo) < 0.10) {
                errPreco.innerText = 'Mínimo R$ 0,10';
                liberar = false;
            } else if (parseFloat(valorLimpo) >= precoOriginal) {
                errPreco.innerText = 'Deve ser menor que o original';
                liberar = false;
            } else {
                liberar = true;
            }

            btnSalvar.disabled = !liberar;
            errPreco.hidden = liberar;
            inputPreco.style.outline = liberar ? '2px solid green' : '2px solid red';
        }

        //Alterar os valores do card e retornar os botoes para o seu estado normal
        async function SalvarPromocao(id) {
            const card = document.querySelector('.id-' + id);
            const idNome = card.querySelector('.input-nome-promo')
            const idPreco = card.querySelector('.input-preco-promo')
            const idValidade = card.querySelector('.input-validade-promo')
            const precoOriginal = parseFloat(card.querySelector('.precoOriginal').innerText.replace(',', '.'));

            const valorNome = idNome.value.trim();
            const valorPreco = idPreco.value.replace(',', '.');
            const valorValidade = idValidade.value.trim();

            const btnSalvar = document.querySelector('.btnSalvar')
            const btnCancelar = document.querySelector('.btnCancelar')

            btnSalvar.dataset.antigo = btnSalvar.innerHTML;
            btnCancelar.dataset.antigo = btnCancelar.innerHTML;

            btnSalvar.disabled = true;
            btnCancelar.disabled = true;

            btnSalvar.innerHTML = `<div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
            </div>`;

            btnCancelar.innerHTML = `<div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
            </div>`;

            try {
                const response = await fetch('../actions/promocoes/editar_promocoes.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id: id,
                        nome: valorNome,
                        preco: valorPreco,
                        validade: valorValidade,
                        preco_original: precoOriginal,
                    })
                })

                const data = await response.json();
                if (data['status'] == 'sucesso') {
                    Swal.fire({
                        icon: 'success',
                        title: 'SUCESSO!',
                        text: 'Promoção salva com sucesso!',
                    }).then(() => {
                        CarregarCardsPromocoes();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'ERRO!',
                        text: data['message'],
                    }).then(() => {
                        btnSalvar.innerHTML = btnSalvar.dataset.antigo;
                        btnCancelar.innerHTML = btnCancelar.dataset.antigo
                        btnSalvar.disabled = false;
                        btnCancelar.disabled = false;
                    })
                }
            } catch (error) {
                Swal.fire('Erro', 'Não foi possível salvar a promoção.', 'error');
                console.error(error);
                btnSalvar.innerHTML = btnSalvar.dataset.antigo;
                btnCancelar.innerHTML = btnCancelar.dataset.antigo;
                btnSalvar.disabled = false;
                btnCancelar.disabled = false;
            }
        }

        //cancelar alteracoes dos valores do inputs, voltando para estado de leitura
        function CancelarPromocao(id) {
            const card = document.querySelector('.id-' + id)
            const idNome = card.querySelector('#nome')
            const idPreco = card.querySelector('#preco')
            const idValidade = card.querySelector('#validade')
            const btnEditar = card.querySelector('.btnEditar')
            const btnSalvar = card.querySelector('.btnSalvar')
            const btnCancelar = card.querySelector('.btnCancelar')
            const chkPromocao = card.querySelector('.chkPromocao')

            idNome.innerText = idNome.dataset.antigo
            idPreco.innerText = idPreco.dataset.antigo
            idValidade.innerText = idValidade.dataset.antigo

            chkPromocao.hidden = false;
            btnCancelar.hidden = true;
            btnEditar.hidden = false;
            btnSalvar.hidden = true;
        }

        const modal = new bootstrap.Modal(document.getElementById('cadastrarPromocoes'));

        //Mover valores do select para modal sobre o produto
        function AdicionarModal() {
            const select = document.getElementById('select');
            

            itens_listar.forEach(item => {
                if (item.id == select.value) {
                    document.getElementById('item_title').innerText = 'Promocao para ' + item.nome;
                    document.getElementById('Mnome').value = item.nome;
                    document.getElementById('Mimg').src = '../images/' + item.imagem;
                    document.getElementById('Mpreco').value = item.preco;
                    document.getElementById('idItemFk').value = item.id;
                }
            });
            modal.show();
        }

        //Enviar os dados de entrada do usario sobre o informacoes da promocao para banco de dados
        async function CadastrarPromocao() {
            const nomePromocao = document.getElementById('nomePromocao').value;
            const precoPromocional = document.getElementById('precoPromocao').value;
            const dataValidade = document.getElementById('dataPromocao').value;
            const precoOriginal = document.getElementById('Mpreco').value;
            const idItemFk = document.getElementById('idItemFk').value;

            const response = await fetch('../actions/promocoes/cadastrar_promocao.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    nome: nomePromocao,
                    preco: precoPromocional,
                    validade: dataValidade,
                    precoOriginal: precoOriginal,
                    idItemFk: idItemFk
                })
            })

            const data = await response.json();
            if (data['status'] == 'sucesso') {
                Swal.fire({
                    icon: 'success',
                    title: 'SUCESSO!',
                    text: data.message,
                }).then(() => {
                    modal.hide();
                    window.location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'ERRO!',
                    text: data.message,
                })
            }
        }

        function ExcluirPromocao(id) {
       

            Swal.fire({
                title: 'Você tem certeza?',
                text: "Você não poderá reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar!'
            }).then(async (result) => {

                if (result.isConfirmed) {
                    const response = await fetch('../actions/promocoes/excluir_promocao.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            id: id
                        })
                    })

                    const data = await response.json();

                    if (data['status'] == 'sucesso') {
                        Swal.fire({
                            icon: 'success',
                            title: 'SUCESSO!',
                            text: data.message,
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'ERRO!',
                            text: data.message,

                        })
                    }
                }

            })
        }

      async function PesquisarPromocao() {
            const nome = document.getElementById('pesquisa').value;

            const response = await fetch('../actions/promocoes/pesquisar_promocao.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    pesquisa: nome
                })
            })
            const data = await response.json();
            if (data['pesquisa'] == ''){
                listPromocoes = promocoes_listar;
                CarregarCardsPromocoes();
            }
            else if (data['status'] == 'sucesso') {
                listPromocoes = data['promocoes'];
                CarregarCardsPromocoes();
            } else {    
                const cards_load = document.getElementById('cards-load');
                cards_load.innerHTML = `
                <div class="alert alert-danger" role="alert">
                    ${data['message']}
                </div>
                    `;
            
            }
        }