document.addEventListener("DOMContentLoaded", () => {
    if ('scrollRestoration' in history) {
        history.scrollRestoration = 'manual';
    }
   const carregarPagina = async (url, salvarNoHistorico = true) => {
    const root = document.getElementById('root');
    
    // 1. Criamos objetos de URL para comparar
    const novaURL = new URL(url, window.location.origin);
    const urlAtual = new URL(window.location.href);

    // 2. Verifica se mudou a página ou só o parâmetro (ID)
    // Se o pathname for igual (ex: ambos são '/'), é apenas um filtro!
    const MesmaPagina = novaURL.pathname === urlAtual.pathname;

    try {
        root.style.opacity = '0.4';

        const response = await fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });
        
        if (!response.ok) throw new Error("Erro de servidor");
        
        const html = await response.text();
        root.innerHTML = html;

        if (salvarNoHistorico) {
            window.history.pushState({}, "", url);
        }
        
        // --- MOTOR DE SCRIPTS ---
        const scripts = root.querySelectorAll('script');
        scripts.forEach(oldScript => {
            const newScript = document.createElement('script');
            Array.from(oldScript.attributes).forEach(attr => {
                newScript.setAttribute(attr.name, attr.value);
            });
            if (oldScript.textContent) {
                newScript.textContent = oldScript.textContent;
            }
            if (oldScript.parentNode) {
                oldScript.parentNode.replaceChild(newScript, oldScript);
            }
        });

        // 3. O PULO DO GATO: Só scrolla se NÃO for a mesma página
        if (!MesmaPagina) {
            window.scrollTo(0, 0);
        }
        
    } catch (erro) {
        console.error("SPA Quebrou:", erro);
        window.location.href = url; 
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
