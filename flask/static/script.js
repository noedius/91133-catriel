async function cadastrarProduto(produto) {
    try {
        const response = await fetch('/api/produtos', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(produto)
        });
        
        const data = await response.json();
        
        const mensagem = document.getElementById('mensagem');
        mensagem.style.display = 'block';
        
        if (response.status === 201) {
            mensagem.textContent = 'Produto cadastrado com sucesso! ID: ' + data.id;
            mensagem.className = 'alert alert-success';
            document.getElementById('formProduto').reset();
        } else {
            mensagem.textContent = 'Erro ao cadastrar produto: ' + (data.mensagem || 'Erro desconhecido');
            mensagem.className = 'alert alert-danger';
        }
    } catch (error) {
        console.error('Erro:', error);
        const mensagem = document.getElementById('mensagem');
        mensagem.style.display = 'block';
        mensagem.textContent = 'Erro ao conectar com o servidor';
        mensagem.className = 'alert alert-danger';
    }
}

async function carregarProdutos() {
    try {
        const response = await fetch('/api/produtos');
        const produtos = await response.json();
        
        const tabela = document.getElementById('tabelaProdutos');
        tabela.innerHTML = '';
        
        produtos.forEach(produto => {
            const row = document.createElement('tr');
            
            row.innerHTML = `
                <td>${produto.id}</td>
                <td>${produto.nome}</td>
                <td>${produto.descricao || '-'}</td>
                <td>R$ ${produto.preco.toFixed(2)}</td>
                <td>${produto.quantidade}</td>
            `;
            
            tabela.appendChild(row);
        });
    } catch (error) {
        console.error('Erro ao carregar produtos:', error);
        alert('Erro ao carregar produtos');
    }
}