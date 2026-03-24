document.querySelectorAll('.link-spa').forEach(link => {
    link.addEventListener('click', async (e) => {
        e.preventDefault(); // Impede a página de recarregar
        
        const url = e.target.getAttribute('href');
        const container = document.getElementById('conteudo-principal');

        try {
            // Adiciona um efeito de carregamento (Spinner)
            container.innerHTML = '<div class="spinner-border text-warning"></div>';

            const response = await fetch(url);
            const html = await response.text();

            // Troca o conteúdo da div sem dar F5 no site todo
            container.innerHTML = html;
            
            // (Opcional) Muda a URL no navegador para o usuário poder dar "voltar"
            window.history.pushState({}, '', url);
            
        } catch (erro) {
            console.error("Erro ao carregar página:", erro);
        }
    });
});