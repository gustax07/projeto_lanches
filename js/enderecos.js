{
    async function ListarEnderecos() {
        
        try {
            const resposta = await fetch('actions/enderecos/listar_enderecos.php');
            const dados = await resposta.json();
            let html = document.getElementById('cards-enderecos');
            html.innerHTML = '';
            if (dados.status == 'sucesso') {
                
                if (dados.lista.length > 0) {
                    dados.lista.forEach(e => {
                    html.innerHTML += `
                    <div class="card mb-3 endereco-item">
                        <div class="card-body d-flex justify-content-between align-items-center">

                            <div>
                                <strong>${e.rua}, ${e.numero}</strong><br>
                                ${e.bairro} - ${e.cidade}/${e.estado}<br>
                                CEP: ${e.cep}
                            </div>

                            <div class="d-flex gap-2">
                                <a href="editar_endereco.php?id=${e.id}" class="btn btn-outline-primary btn-sm"> ✏️ Editar</a>

                                <a href="actions/enderecos/remover_enderecos.php?id=${e.id}" class="btn btn-outline-danger btn-sm"> 🗑 Excluir</a>
                            </div>

                        </div>
                    </div>
                    `;
                        
                        
                    });
                    
                    
                } else {
                    const html = `
                    <p>Nenhum endereço cadastrado.</p>
                    `;

                    
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Algo deu errado!',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                })
            }
        } catch (error) {
            console.error('Erro ao buscar endereços:', error);
        }
    }

    ListarEnderecos();
    
}
    async function BuscarEndereco() {

        try {
            let cep = document.getElementById("cep").value;
            let url = `https://viacep.com.br/ws/${cep}/json/`;

            const response = await fetch(url);
            const endereco = await response.json();

            document.getElementById("logradouro").value = endereco.logradouro;
            document.getElementById("bairro").value = endereco.bairro;
            document.getElementById("localidade").value = endereco.localidade;
            document.getElementById("estado").value = endereco.uf;

        } catch (error) {
            console.error('Erro ao buscar endereço:', error);
        }

    }
