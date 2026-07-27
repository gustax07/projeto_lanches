{
    
    var imported = document.createElement('script');
    imported.src = 'includes/usuario_nao_encontrado.js';
    document.head.appendChild(imported);

    
   window.ListarPerfil = async function() {

        var imgPerfil = document.getElementById('imgPerfi');
        var nomePerfil = document.getElementById('nomePerfil');
        var emailPerfil = document.getElementById('emailPerfil');
        var cargoPerfil = document.getElementById('cargoPerfil');
        var dataCadastroPergil = document.getElementById('dataCadastroPerfil');
        var inputEmail = document.getElementById('email');
        var inputNome = document.getElementById('nome');

        try {
            const response = await fetch('actions/clientes/listar_clientes.php');
            const data = await response.json();

            if (data.status == 'sucesso') {
                data.lista.forEach(cliente => {
                    imgPerfil.src = 'images/' + cliente.foto;
                    imgPerfil.classList.remove('placeholder');
                    nomePerfil.innerHTML = "SEJA BEM VINDO " + cliente.nome + "!";
                    emailPerfil.innerHTML = cliente.email;
                    cargoPerfil.innerHTML = cliente.id_tipo_fk == 0 ? 'Cliente' : 'Funcionário';
                    dataCadastroPergil.innerHTML = cliente.data_cadastro;
                    inputEmail.value = cliente.email;
                    inputNome.value = cliente.nome;
                });
            } else if (data.lista == '0x1') {
                // sweet alert para mover o usuario para tela de cadastro ou login
                usuarioNaoEncontrado(data.message);
            } else {
                alert('erro');
            }
        } catch (erro) {
            console.error(erro);
        }
    }
}