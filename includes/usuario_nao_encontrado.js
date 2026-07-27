function usuarioNaoEncontrado(message) {
    return Swal.fire({
        title: 'Erro',
        text: message,
        icon: 'error',
        showConfirmButton: true,
        confirmButtonText: 'Login',
        showCancelButton: true,
        cancelButtonText: 'Cadastre-se',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        allowOutsideClick: false,
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '/pages/logar.html';
        } else if (result.isDismissed) {
            window.location.href = '/pages/cadastrar.html';
        }
    });
}