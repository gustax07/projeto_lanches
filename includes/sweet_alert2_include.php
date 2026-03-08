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
    //pedidos
    "pedido_status_alterado" => "Status do pedido alterado com sucesso!",
    "pedido_cancelado" => "Pedido cancelado com sucesso!",
    "pedido_removido" => "Pedido removido com sucesso!",
    //categorias
    "categoria_cadastrada" => "Categoria cadastrada com sucesso!",
    "categoria_editada" => "Categoria editada com sucesso!",
    "categoria_excluida" => "Categoria excluída com sucesso!",
    //itens
    "itens_cadastrados" => "Itens cadastrados com sucesso!",
    "itens_editados" => "Itens editados com sucesso!",
    "itens_excluidos" => "Itens excluídos com sucesso!",
    //editor de conta
    "conta_editada" => "Conta editada com sucesso!",
    //endereços
    "endereco_cadastrado" => "Endereço cadastrado com sucesso!",
    "endereco_editado" => "Endereço editado com sucesso!",
    "endereco_excluido" => "Endereço excluído com sucesso!",
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
    //Pedidos
    "pedido_status_falha" => "Falha na alteração do status do pedido!",
    "pedido_cancelar_falha" => "Falha ao cancelar o pedido!",
    "pedido_remover_falha" => "Falha ao remover o pedido!",
    //categorias
    "categoria_cadastro_falha" => "Falha ao cadastrar categoria!",
    "categoria_editar_falha" => "Falha ao editar categoria!",
    "categoria_excluir_falha" => "Falha ao excluir categoria!",
    "captcha_invalido" => "Captcha inválido!",
    //itens
    "itens_cadastro_falha" => "Falha ao cadastrar itens!",
    "itens_editar_falha" => "Falha ao editar itens!",
    "itens_excluir_falha" => "Falha ao excluir itens!",
    "itens_imagem_invalida" => "Imagem inválida!",
    "itens_mover_imagem_falha" => "Falha ao mover imagem!",
    "itens_imagem_vazia" => "Nenhuma imagem selecionada!",
    "itens_campos_vazios" => "Preencha todos os campos!",
    "itens_preco_invalido" => "Preco inválido!",
    //editor de conta
    "senha_nao_confere" => "Senhas nao conferem!",
    //endereços
    "rua_vazia" => "Rua nao pode estar vazia!",
    "numero_vazio" => "Numero nao pode estar vazio!",
    "bairro_vazio" => "Bairro nao pode estar vazio!",
    "cidade_vazio" => "Cidade nao pode estar vazia!",
    "estado_vazio" => "Estado nao pode estar vazio!",
    "cep_vazio" => "CEP nao pode estar vazio!",
    "metodo_invalido" => "selecione um endereço valido!",

];
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