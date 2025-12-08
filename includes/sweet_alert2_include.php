<?php

$msg = [
    //Funcionarios
    "funcionario_cadastrado" => "Funcionário cadastrado com sucesso!",
    "funcionario_editado" => "Funcionário editado com sucesso!",
    "funcionario_excluido" => "Funcionário excluído com sucesso!",
    "Deslogado" => "Deslogado com sucesso!",
    //Lanches
    "lanches_cadastrados" => "Lanches cadastrados com sucesso!",
    "lanches_editados" => "Lanches editados com sucesso!",
    "lanches_excluidos" => "Lanches excluídos com sucesso!",
];
$err = [
    //Funcionarios
    "funcionario_cadastro_falha" => "Falha ao cadastraro usuario!",
    "funcionario_editar_falha" => "Falha ao editar usuario!",
    "funcionario_excluir_falha" => "Falha ao excluir usuario!",
    "funcionario_email_existente" => "Email já cadastrado!",
    "deslogar_falha" => "Falha ao deslogar!",
    //Logar /Criar conta
    "email_ou_senha_incorretos" => "Email ou senha incorretos!",
    "login_falha" => "Falha ao logar!",
    "email_vazio" => "Email inválido!",
    "senha_vazio" => "Senha inválida!",
    "nome_vazio" => "Nome inválido!",
    //Lanches
    "lanches_cadastro_falha" => "Falha ao cadastrar lanches!",
    "lanches_editar_falha" => "Falha ao editar lanches!",
    "lanches_excluir_falha" => "Falha ao excluir lanches!",


]
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Exibição de mensagem de alerta do SweetAlert2:
    <?php
    // Mensagens de sucesso:
    if (isset($_GET['msg']) && array_key_exists($_GET['msg'], $msg)) {
        $message = $msg[$_GET['msg']];
        echo "Swal.fire({
            icon: 'success',
            title: 'Sucesso',
            text: '$message',
            confirmButtonColor: '#3085d6',
        });";
         // Remover a mensagem da URL para evitar reaparecimento:
         echo "if (history.replaceState) {
            const url = new URL(window.location);
            url.searchParams.delete('msg');
            window.history.replaceState({}, document.title, url.toString());
        }";
    }
    ?>
    <?php
    // Mensagens de erro:
    if (isset($_GET['err']) && array_key_exists($_GET['err'], $err)) {
        $message = $err[$_GET['err']];
        echo "Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: '$message',
            confirmButtonColor: '#d33',
        });";
    }
    // Remover a mensagem da URL para evitar reaparecimento:
    echo "if (history.replaceState) {
        const url = new URL(window.location);
        url.searchParams.delete('err');
        window.history.replaceState({}, document.title, url.toString());
    }";
    ?>
</script>