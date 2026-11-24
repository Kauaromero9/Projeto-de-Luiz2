<?php
session_start();
require 'conexao2/conexaoo.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['novo_item'])) {
    $stmt = $pdo->prepare("INSERT INTO lista_compras (usuario_id, item) VALUES (?, ?)");
    $stmt->execute([$usuario_id, trim($_POST['novo_item'])]);
    header("Location: compras.php");
    exit;
}

if (isset($_GET['remover'])) {
    $stmt = $pdo->prepare("DELETE FROM lista_compras WHERE id = ? AND usuario_id = ?");
    $stmt->execute([$_GET['remover'], $usuario_id]);
    header("Location: compras.php");
    exit;
}

$stmt = $pdo->prepare("SELECT id, item FROM lista_compras WHERE usuario_id = ?");
$stmt->execute([$usuario_id]);
$itens = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compras - Mercado Verde</title>
   <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header>
        <h1>🌿 Mercado Verde</h1>
        <nav>
            <ul>
                <li><a href="index.php">Início</a></li>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="produtos.php">Produtos</a></li>
                <li><a href="logout.php">Sair</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <h1>Lista de Compras</h1>

        <form method="POST" action="compras.php" style="display: flex; gap: 0.5rem; align-items: flex-start;">
            <input type="text" name="novo_item" placeholder="Digite um novo item..." required style="margin-bottom: 0;">
            <button type="submit">Adicionar</button>
        </form>

        <ul>
            <?php foreach ($itens as $row): ?>
                <li>
                    <span><?= htmlspecialchars($row['item']) ?></span>
                    <a href="compras.php?remover=<?= $row['id'] ?>" class="btn btn-perigo" style="padding: 0.3rem 0.7rem; font-size: 0.85rem;">Remover</a>
                </li>
            <?php endforeach; ?>
        </ul>

        <br>
        <a href="produtos.php">Ir para produtos</a> | 
        <a href="dashboard.php">Ir para o dashboard</a> | 
        <a href="logout.php">Sair</a>
    </main>

    <footer>
        <p>© 2026 Mercado Verde. Todos os direitos reservados.</p>
    </footer>
     <script src="js/scripts.js"></script>
</body>
</html>
