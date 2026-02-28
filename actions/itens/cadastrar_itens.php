<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once('../../classes/itens.class.php');

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itens = new Itens();

    // Coletar dados do formulário
    $nome = strip_tags($_POST['nome'] ?? '');
    $descricao = strip_tags($_POST['descricao'] ?? '');
    $id_categoria_fk = strip_tags($_POST['id_categoria_fk'] ?? '');
    $preco = strip_tags($_POST['preco'] ?? '');
    $nomeImagem = '';

    // Processar a imagem
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $arquivo = $_FILES['foto'];

        // Validar tipo de arquivo
        $tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($arquivo['type'], $tiposPermitidos)) {
            header('Location: ../../admin/gerenciar_produtos.php?err=itens_imagem_invalida');
            exit;
        }

        // Gerar nome único para a imagem
        $nomeImagem = strip_tags(uniqid('produto_') . '.' . pathinfo($arquivo['name'], PATHINFO_EXTENSION));
        $caminhoDestino = '../../images/' . $nomeImagem;
    } else {
        header('Location: ../../admin/gerenciar_produtos.php?err=itens_imagem_vazia');
        exit;
    }

    // Validar dados obrigatórios
    if (empty($nome) || empty($descricao) || empty($id_categoria_fk) || empty($preco)) {
        header('Location: ../../admin/gerenciar_produtos.php?err=itens_campos_vazios');
        exit;
    }

    // Converter preço para formato correto
    $preco = str_replace(',', '.', $preco);
    if (!is_numeric($preco)) {
        header('Location: ../../admin/gerenciar_produtos.php?err=itens_preco_invalido');
        exit;
    }

    if (move_uploaded_file($arquivo['tmp_name'], $caminhoDestino)) {

        // 2. SE O ARQUIVO FOI MOVIDO, SALVA NO BANCO
        $itens->nome = $nome;
        $itens->descricao = $descricao;
        $itens->id_categoria_fk = $id_categoria_fk;
        $itens->preco = $preco;
        $itens->imagem = $nomeImagem;

        if ($itens->Cadastrar()) {
            // Sucesso total: arquivo movido e banco gravado
            header('Location: ../../admin/gerenciar_produtos.php?msg=itens_cadastrados');
            exit;
        } else {
            // Se o banco falhar, tentamos apagar a imagem que subiu para não ocupar espaço à toa
            unlink($caminhoDestino);
            header('Location: ../../admin/gerenciar_produtos.php?err=itens_cadastro_falha');
            exit;
        }
    } else {
        // Se cair aqui, é PERMISSÃO DE PASTA no Linux ou caminho errado
        header('Location: ../../admin/gerenciar_produtos.php?err=itens_mover_imagem_falha');
        exit;
    }
}
