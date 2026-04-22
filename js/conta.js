 {
            const imgPerfil = document.getElementById('imgPerfi');
            const nomePerfil = document.getElementById('nomePerfil');
            const emailPerfil = document.getElementById('emailPerfil');
            const cargoPerfil = document.getElementById('cargoPerfil');
            const dataCadastroPergil = document.getElementById('dataCadastroPerfil');
            const inputEmail = document.getElementById('email');
            const inputNome = document.getElementById('nome');

            async function ListarPerfil() {
                try {
                    const response = await fetch('actions/clientes/listar_clientes.php');
                    const data = await response.json();
                 
                    if (data.status == 'sucesso') {
                        data.lista.forEach(cliente => {
                            imgPerfil.src = 'images/' + cliente.foto;
                            imgPerfil.classList.remove('placeholder');
                            nomePerfil.innerHTML = "SEJA BEM VINDO " + cliente.nome + "!";
                            emailPerfil.innerHTML = cliente.email;
                            cargoPerfil.innerHTML= cliente.id_tipo_fk == 0 ? 'Cliente' : 'Funcionário';
                            dataCadastroPergil.innerHTML = cliente.data_cadastro;
                            inputEmail.value = cliente.email;
                            inputNome.value = cliente.nome;
                        });
                    } else {
                        alert(data.lista);
                    }
                } catch (erro) {
                    console.error(erro);
                }
            }

            ListarPerfil();

        }