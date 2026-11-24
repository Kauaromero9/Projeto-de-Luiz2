document.addEventListener('DOMContentLoaded', () => {
    
    const inputCpf = document.querySelector('input[name="cpf"]');
    if (inputCpf) {
        inputCpf.setAttribute('maxlength', '14');
        inputCpf.placeholder = '000.000.000-00';
        inputCpf.addEventListener('input', (e) => {
            let v = e.target.value.replace(/\D/g, '');
            v = v.replace(/(\d{3})(\d)/, '$1.$2');
            v = v.replace(/(\d{3})(\d)/, '$1.$2');
            v = v.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            e.target.value = v;
        });
    }

    const inputTelefone = document.querySelector('input[name="telefone"]');
    if (inputTelefone) {
        inputTelefone.setAttribute('maxlength', '15');
        inputTelefone.placeholder = '(00) 00000-0000';
        inputTelefone.addEventListener('input', (e) => {
            let v = e.target.value.replace(/\D/g, '');
            v = v.replace(/^(\d{2})(\d)/g, '($1) $2');
            v = v.replace(/(\d)(\d{4})$/, '$1-$2');
            e.target.value = v;
        });
    }
    const formCadastro = document.querySelector('form[action="cadastro.php"]');
    if (formCadastro) {
        formCadastro.addEventListener('submit', (e) => {
            const senha = formCadastro.querySelector('input[name="senha"]').value;
            if (senha.length < 6) {
                e.preventDefault();
                alert('A senha deve ter pelo menos 6 caracteres para sua segurança.');
            }
        });
    }

    const botoesPerigo = document.querySelectorAll('.btn-perigo');
    botoesPerigo.forEach(botao => {
        botao.addEventListener('click', (e) => {
            const acao = botao.textContent.trim().toLowerCase();
            if (!confirm(`Tem certeza que deseja ${acao}?`)) {
                e.preventDefault();
            }
        });
    });

    const btnFinalizar = document.querySelector('button[name="finalizar"]');
    if (btnFinalizar) {
        btnFinalizar.addEventListener('click', (e) => {
            const listaCarrinho = document.querySelectorAll('#carrinho + ul li');
            if (listaCarrinho.length === 0) {
                e.preventDefault();
                alert('Seu carrinho está vazio! Adicione produtos antes de finalizar.');
            } else if (!confirm('Deseja confirmar e finalizar o seu pedido agora?')) {
                e.preventDefault();
            }
        });
    }

    const navCategorias = document.querySelector('.categorias-nav');
    if (navCategorias) {
        const inputBusca = document.createElement('input');
        inputBusca.type = 'text';
        inputBusca.placeholder = '🔍 Filtrar produto nesta página...';
        inputBusca.style.marginBottom = '1rem';
        navCategorias.parentNode.insertBefore(inputBusca, navCategorias.nextSibling);

        const listaProdutos = navCategorias.nextElementSibling.nextElementSibling;
        inputBusca.addEventListener('keyup', () => {
            const termo = inputBusca.value.toLowerCase();
            const itens = listaProdutos.querySelectorAll('li');
            itens.forEach(li => {
                const texto = li.textContent.toLowerCase();
                li.style.display = texto.includes(termo) ? 'flex' : 'none';
            });
        });
    }

   
    const mensagens = document.querySelectorAll('.msg-sucesso, .msg-erro');
    mensagens.forEach(msg => {
        setTimeout(() => {
            msg.style.transition = 'opacity 0.6s ease';
            msg.style.opacity = '0';
            setTimeout(() => msg.remove(), 600);
        }, 5000);
    });
});
