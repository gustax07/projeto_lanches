document.addEventListener("DOMContentLoaded", () => {
    if ('scrollRestoration' in history) {
        history.scrollRestoration = 'manual';
    }

    const rotasSemLayout = ['/pages/cadastrar.html', '/pages/login.html'];

    function verificarLayout() {
        const path = window.location.pathname;
        const header = document.querySelector('header');
        const footer = document.querySelector('footer');

        // Se a rota atual estiver na lista negra, esconde. Se não, mostra.
        const esconder = rotasSemLayout.some(rota => path.includes(rota));

        if (header) header.style.display = esconder ? 'none' : 'block';
        if (footer) footer.style.display = esconder ? 'none' : 'block';
    }

    function executarDataInit(container) {
        console.log("🔍 SPA: Procurando a tag [data-init] dentro do HTML novo...");

        const elementoPagina = container.querySelector('[data-init]');

        if (elementoPagina) {
            const nomeFuncao = elementoPagina.getAttribute('data-init');
            console.log("🎯 SPA: Achou o data-init! Tentando executar a função: " + nomeFuncao);

            if (typeof window[nomeFuncao] === 'function') {
                window[nomeFuncao]();
                console.log("▶️ SPA SUCESSO ABSOLUTO: " + nomeFuncao + " ativada.");
            } else {
                console.error("❌ SPA FALHA CRÍTICA: O HTML pediu a função '" + nomeFuncao + "', mas ela não existe no window. Esqueceu do window." + nomeFuncao + " = function() ?");
            }
        } else {
            console.warn("⚠️ SPA AVISO: O HTML que acabou de ser injetado NÃO TEM a tag [data-init]. Nenhuma função foi ativada. É assim mesmo?");
        }
    }

    const carregarPagina = async (url, salvarNoHistorico = true) => {
        const root = document.getElementById('root');

        // 1. Criamos objetos de URL para comparar
        const novaURL = new URL(url, window.location.origin);
        const urlAtual = new URL(window.location.href);

        // 2. Verifica se mudou a página ou só o parâmetro (ID)
        const MesmaPagina = novaURL.pathname === urlAtual.pathname;

        try {
            root.style.opacity = '0.4';

            // ÚNICO FETCH DA PÁGINA
            const response = await fetch(url, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            if (!response.ok) throw new Error("Erro de servidor");

            const html = await response.text();

            // Injeta o HTML novo
            root.innerHTML = html;

            if (salvarNoHistorico) {
                window.history.pushState({}, "", url);
            }

            await injetarScriptsDinamicos(root);
            executarDataInit(root);
            verificarLayout();

            if (!MesmaPagina) {
                window.scrollTo(0, 0);
            }

        } catch (erro) {
            console.error("SPA Quebrou:", erro);
            window.location.href = url; // Fallback: se o SPA falhar, carrega a página normal
        } finally {
            root.style.opacity = '1';
        }
    };
    verificarLayout();
    executarDataInit(document.body);

    document.addEventListener('click', function (e) {
        const link = e.target.closest('a');
        if (!link) return;

        const href = link.getAttribute('href');

        // Escudo Anti-Loop
        if (!href || href === '#' || href.startsWith('#') || href.startsWith('javascript:')) {
            if (href === '#') {
                e.preventDefault();
            }
            return;
        }

        // Ignora links externos
        if (href.startsWith('http') && !href.includes(window.location.origin)) {
            return;
        }

        e.preventDefault();
        carregarPagina(href);
    });

    // Escuta o botão de "Voltar" do navegador
    window.addEventListener('popstate', () => {
        carregarPagina(window.location.href, false);
    });

    function injetarScriptsDinamicos(containerRoot) {
        return new Promise((resolve) => {
            const scriptsMortos = containerRoot.querySelectorAll('script');

            if (scriptsMortos.length === 0) {
                return resolve();
            }

            let scriptsCarregados = 0;
            const totalScripts = scriptsMortos.length;

            // Função interna para liberar o Roteador
            const verificarConclusao = () => {
                scriptsCarregados++;
                if (scriptsCarregados >= totalScripts) resolve();
            };

            scriptsMortos.forEach(scriptAntigo => {
                const novoScript = document.createElement('script');

                if (scriptAntigo.src) {
                    // O Roteador agora ignora os "scriptsMortos" na hora de checar a memória
                    const jaExiste = Array.from(document.scripts).some(s =>
                        s.src === scriptAntigo.src && !Array.from(scriptsMortos).includes(s)
                    );
                    if (jaExiste) {
                        scriptAntigo.remove();
                        return verificarConclusao();
                    }

                    console.log("⏳ SPA: Baixando novo script ->", scriptAntigo.src);
                    novoScript.src = scriptAntigo.src;

                    novoScript.onload = () => {
                        verificarConclusao();
                    };

                    novoScript.onerror = () => {;
                        verificarConclusao();
                    };
                } else {
                    novoScript.textContent = scriptAntigo.textContent;
                    verificarConclusao();
                }

                Array.from(scriptAntigo.attributes).forEach(attr => {
                    if (attr.name !== 'src') novoScript.setAttribute(attr.name, attr.value);
                });

                document.body.appendChild(novoScript);
                scriptAntigo.remove();
            });

            // ==========================================
            // TRAVA DE SEGURANÇA (Se a rede falhar, libera a tela após 3s)
            // ==========================================
            setTimeout(() => {
                if (scriptsCarregados < totalScripts) {
                    resolve();
                }
            }, 3000);
        });
    }
});