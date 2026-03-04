<?php
session_start();
$idUsuario = $_SESSION['usuario']['id'];

include_once("classes/telefones.class.php");
$telefones = new Telefones();

$telefones->id_usuarios_fk = $idUsuario;
$listar = $telefones->ListarPorID();
include_once("header.php");
include_once("includes/bootstrap_include.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telefones</title>
</head>

<body>
    <div class="container-fluid">
        <div class="d-flex justify-content-center align-items-center h-75 ">
            <div class="card shadow p-3 bg-body rounded w-50">
                <div class="card-body">
                    <h5 class="card-title text-center fs-4 fw-bold mb-4 mt-3">Telefones Cadastrados</h5>
                        <div 
                        <div class="col-12 mt-3" id="telefone"></div>

                        <div class="col-12 mb-3" id="novos_telefones">
                            <div class="row">
                                <div class="col-6" id="Input_telefone"></div>
                                <div class="col-1" id="remover_telefone"></div>
                            </div>
                        </div> 
                  
                        <div class="d-flex justify-content-start">
                        <button type="button" class="btn btn-primary" onclick="AddNovosTelefones()"><i class="bi bi-plus-circle-fill" ></i> Adicionar Telefone</button>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <a href="cadastrar_telefone.php" class="btn btn-primary">Salvar</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        const telefones = [<?php echo json_encode($listar) ?>];

        document.getElementById('telefone').onload = criarInputTelefone();

        function criarInputTelefone() {

            telefones.forEach(telefone => { telefone.forEach(element => {
                document.getElementById('telefone').insertAdjacentHTML('beforeend', `
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control mb-3" value="${element.numero}" readonly>
                    </div>
                    <div class="col">
                        <a href="editar_telefone.php?id=${element.id}" class="btn btn-lg btn-primary"><i class="bi bi-pencil-square"></i></a>
                        <a href="excluir_telefone.php?id=${element.id}" class="btn btn-lg btn-danger"><i class="bi bi-trash"></i></a>
                    </div>
                </div>
                `)
            })  
        })

        }
        let count = 0
        function AddNovosTelefones(){
            count++
            var telefoness = document.createElement('input')

            telefoness.setAttribute('type','text')
            telefoness.setAttribute('class','form-control mb-3')
            telefoness.setAttribute('name','telefones' + count)
            telefoness.setAttribute('id','telefones' + count)
            telefoness.setAttribute('placeholder','Telefone ' + count)

            var remover = document.createElement('button')
            remover.setAttribute('type','button')
            remover.setAttribute('onclick','RemoveNovosTelefones()')
            remover.setAttribute('id','remover' + count)
            remover.setAttribute('class','btn btn-danger btn-lg mb-3')
            remover.innerHTML = '<i class="bi bi-trash"></i>'

            document.getElementById('Input_telefone').appendChild(telefoness)
            document.getElementById('remover_telefone').appendChild(remover)

            if (count > 4) {
                document.getElementById('remover_telefone').removeChild(document.getElementById('remover_telefone').lastChild)
                document.getElementById('Input_telefone').removeChild(document.getElementById('Input_telefone').lastChild)
                count = 4
            }
        }
        function RemoveNovosTelefones(){
            count--
            document.getElementById('Input_telefone').removeChild(document.getElementById('Input_telefone').lastChild)
            document.getElementById('remover_telefone').removeChild(document.getElementById('remover_telefone').lastChild)
        }
    </script>
</body>

</html>