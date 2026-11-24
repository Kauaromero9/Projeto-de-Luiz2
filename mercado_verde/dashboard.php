<?php
session_start();
require 'conexao2/conexaoo.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

$stmt = $pdo->prepare("SELECT nome, cpf, email, telefone FROM usuarios WHERE id = ?");
$stmt->execute([$usuario_id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt_lista = $pdo->prepare("SELECT item FROM lista_compras WHERE usuario_id = ?");
$stmt_lista->execute([$usuario_id]);
$lista = $stmt_lista->fetchAll(PDO::FETCH_COLUMN);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mercado Verde</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header>
        <h1>🌿 Mercado Verde</h1>
        <nav>
            <ul>
                <li><a href="index.php">Início</a></li>
                <li><a href="compras.php">Compras</a></li>
                <li><a href="produtos.php">Produtos</a></li>
                <li><a href="logout.php">Sair</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <h1>Dashboard</h1>
        <p>Área principal do usuário</p>

        <h2>Atalhos Rápidos</h2>
        <div style="display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 1.5rem;">
            <a href="compras.php" class="btn">Ver compras</a>
            <a href="produtos.php" class="btn">Ver produtos</a>
            <a href="cadastro.php" class="btn">Cadastro</a>
        </div>

        <h2>Informações do usuário</h2>
        <ul>
            <li><strong>Nome:</strong> <span><?= htmlspecialchars($usuario['nome']) ?></span></li>
            <li><strong>CPF:</strong> <span><?= htmlspecialchars($usuario['cpf']) ?></span></li>
            <li><strong>Email:</strong> <span><?= htmlspecialchars($usuario['email']) ?></span></li>
            <li><strong>Telefone:</strong> <span><?= htmlspecialchars($usuario['telefone']) ?></span></li>
        </ul>

        <h2>Lista de compras</h2>
        <ul>
            <?php foreach ($lista as $item): ?>
                <li><?= htmlspecialchars($item) ?></li>
            <?php endforeach; ?>
        </ul>

        <br>
        <a href="compras.php">Ir para Compras</a> | 
        <a href="produtos.php">Ir para Produtos</a> | 
        <a href="logout.php">Sair da conta</a>
    </main>

    <footer>
        <p>© 2026 Mercado Verde. Todos os direitos reservados.</p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>
