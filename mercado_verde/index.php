<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Principal - Mercado Verde</title>
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
                <li><a href="sobre.php">Sobre a loja</a></li>
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <li><a href="logout.php">Sair</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="cadastro.php">Cadastro</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main class="container">
        <h2>Bem-vindo ao Mercado Verde!</h2>
        <p>Encontre produtos de qualidade para o seu dia a dia. Faça suas compras de forma simples e prática.</p>
        <a href="produtos.php" class="btn">Ver produtos</a>
    </main>

    <footer>
        <p>© 2026 Mercado Verde. Todos os direitos reservados.</p>
    </footer>
     <script src="js/scripts.js"></script>
</body>
</html>
