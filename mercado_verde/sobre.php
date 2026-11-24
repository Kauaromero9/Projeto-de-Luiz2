<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre - Mercado Verde</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header>
        <h1>🌿 Mercado Verde</h1>
        <nav>
            <ul>
                <li><a href="index.php">Início</a></li>
                <li><a href="produtos.php">Produtos</a></li>
                <li><a href="dashboard.php">Dashboard</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <h1>Sobre o Projeto</h1>

        <h2>Lista de Compras</h2>
        <p>O projeto possui uma lista de compras com os seguintes itens iniciais:</p>
        <ul>
            <li>Maçã</li>
            <li>Uva</li>
            <li>Refrigerante</li>
            <li>Banana</li>
            <li>Pão</li>
        </ul>

        <h2>Cadastro</h2>
        <p>O cadastro possui campos para as seguintes informações:</p>
        <ul>
            <li>Nome</li>
            <li>CPF</li>
            <li>Email</li>
            <li>Telefone</li>
        </ul>

        <h2>Dashboard</h2>
        <p>O dashboard apresenta informações de nome, CPF, email e telefone, além de opções para acessar a página de compras e produtos.</p>

        <br>
        <a href="compras.php">Ir para Compras</a> | 
        <a href="login.php">Fazer login</a> | 
        <a href="dashboard.php">Ir para o dashboard</a>
    </main>

    <footer>
        <p>© 2026 Mercado Verde. Todos os direitos reservados.</p>
    </footer>
     <script src="js/scripts.js"></script>
</body>
</html>
