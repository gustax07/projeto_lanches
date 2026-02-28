<?php

if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once("../../classes/itens.class.php");
    $itens = new Itens();

    // Coletar dados do formulário
    $id_item = $_GET['id'];
    $nome = strip_tags($_POST['nome'] ?? '');
    $descricao = strip_tags($_POST['descricao'] ?? '');
    $id_categoria_fk = strip_tags($_POST['id_categoria_fk'] ?? '');
    $preco = strip_tags($_POST['preco'] ?? '');
    $nomeImagem = '';

     $itens->id = $id_item;
        $imagemAntiga = $itens->ListarPorID()[0]['imagem'];

    if (!empty($_FILES['foto']['name'])) {


        $arquivo = $_FILES['foto'];

        // Validar tipo de arquivo
        $tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($arquivo['type'], $tiposPermitidos)) {
            header('Location: ../../admin/gerenciar_produtos.php?err=itens_imagem_invalida');
            exit;
        }

        //Apagar a imagem antiga
       
        unlink('../../images/' . $imagemAntiga);

        // Gerar nome único para a imagem
        $nomeImagem = strip_tags(uniqid('produto_') . '.' . pathinfo($arquivo['name'], PATHINFO_EXTENSION));
        $caminhoDestino = '../../images/' . $nomeImagem;

        if (!move_uploaded_file($arquivo['tmp_name'], $caminhoDestino)) {
            header('Location: ../../admin/gerenciar_produtos.php?err=itens_mover_imagem_falha');
            exit;
        }
    }else{
        $nomeImagem = $imagemAntiga;
    }


    if (empty($id_item) || empty($nome) || empty($descricao) || empty($id_categoria_fk) || empty($preco)) {
        header('Location: ../../admin/gerenciar_produtos');
    }

    $preco = str_replace(',', '.', $preco);
    if (!is_numeric($preco)) {
        header('Location: ../../admin/gerenciar_produtos.php?err=itens_preco_invalido');
        exit;
    }

    $itens->id = $id_item;
    $itens->nome = $nome;
    $itens->descricao = $descricao;
    $itens->id_categoria_fk = $id_categoria_fk;
    $itens->preco = $preco;
    $itens->imagem = $nomeImagem ?? $imagemAntiga;

    if ($itens->Editar()) {
        header('Location: ../../admin/gerenciar_produtos.php?msg=itens_editados');

        exit;
    } else {
        header('Location: ../../admin/gerenciar_produtos.php?err=itens_editar_falha');
        exit;
    }
}
