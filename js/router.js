document.addEventListener("DOMContentLoaded", () => {

   const carregarPagina = async (url, salvarNoHistorico = true) => {
    const root = document.getElementById('root');
    
    try {
        // Efeito de carregamento
        root.style.opacity = '0.4';

        // 1. VOLTAMOS PRO BÁSICO! Sem headers malucos. O navegador já manda a sessão nativamente.
        const response = await fetch(url);
        
        if (!response.ok) throw new Error("Página não encontrada no servidor");
        
        const html = await response.text();
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        
        // 2. Substitui o miolo
        const novoConteudo = doc.getElementById('root');
        if (novoConteudo) {
            root.innerHTML = novoConteudo.innerHTML;
        }

        // 3. Atualiza o botão do carrinho (se existir)
        const novoCarrinho = doc.querySelector('.btn-carrinho');
        const carrinhoAtual = document.querySelector('.btn-carrinho');
        if (novoCarrinho && carrinhoAtual) {
            carrinhoAtual.innerHTML = novoCarrinho.innerHTML;
        }
            
        // 4. Salva a URL nova (Usando o response.url para capturar redirecionamentos do PHP)
        if (salvarNoHistorico) {
            window.history.pushState({}, "", response.url);
        }
        
        // 5. Re-executa os scripts
        const scripts = root.querySelectorAll('script');
        scripts.forEach(oldScript => {
            const newScript = document.createElement('script');
            Array.from(oldScript.attributes).forEach(attr => newScript.setAttribute(attr.name, attr.value));
            newScript.appendChild(document.createTextNode(`{ ${oldScript.innerHTML} }`));
            if (oldScript.parentNode) {
                oldScript.parentNode.replaceChild(newScript, oldScript);
            }
        });

        window.scrollTo(0, 0);
        
    } catch (erro) {
        console.error("Erro na requisição SPA:", erro);
        if (salvarNoHistorico) window.location.href = url; // Dá o F5 de emergência
    } finally {
        root.style.opacity = '1';
    }
};

    document.body.addEventListener('click', e => {
        const link = e.target.closest('a');
        if (link && link.href.startsWith(window.location.origin) && !link.getAttribute('target')) {
            e.preventDefault();
            carregarPagina(link.href);
        }
    });

    window.addEventListener('popstate', () => {
        carregarPagina(window.location.href, false);
    });

});