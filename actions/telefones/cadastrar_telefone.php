<?php
session_start();

if (!isset($_SESSION['usuario']['id'])) {
    header('Location: ../../logar.php');
    exit;
}

require_once('../../classes/telefones.class.php');

$telefones = new Telefones();
$idUsuario = $_SESSION['usuario']['id'];
$sucesso = 0;
$erros = 0;

// Processar telefones enviados
for ($i = 1; $i <= 3; $i++) {
    $telefoneKey = 'telefone' . $i;
    $ddiKey = 'ddi' . $i;

    if (isset($_POST[$telefoneKey]) && !empty(trim($_POST[$telefoneKey]))) {
        $numero = trim($_POST[$telefoneKey]);
        $ddi = isset($_POST[$ddiKey]) ? trim($_POST[$ddiKey]) : '+55';

        // Remover caracteres não numéricos do telefone
        $numeroLimpo = preg_replace('/\D/', '', $numero);

        // Validar se tem pelo menos 10 dígitos
        if (strlen($numeroLimpo) >= 10) {
            $telefones->numero = $numero;
            $telefones->ddi = $ddi;
            $telefones->id_usuarios_fk = $idUsuario;

            if ($telefones->Cadastrar()) {
                $sucesso++;
            } else {
                $erros++;
            }
        } else {
            $erros++;
        }
    }
}

// Redirecionar com mensagem
if ($sucesso > 0) {
    $_SESSION['sucesso'] = $sucesso . ' telefone(s) cadastrado(s) com sucesso!';
    if ($erros > 0) {
        $_SESSION['erro'] = $erros . ' telefone(s) não puderam ser cadastrados.';
    }
} elseif ($erros > 0) {
    $_SESSION['erro'] = 'Erro ao cadastrar os telefones. Verifique os dados e tente novamente.';
} else {
    $_SESSION['aviso'] = 'Nenhum telefone foi adicionado.';
}

header('Location: ../../telefones.php');
exit;
?>
