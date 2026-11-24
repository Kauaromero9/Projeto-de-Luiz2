<?php
session_start();
require 'conexao2/conexaoo.php';

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

if (isset($_GET['add'])) {
    $id_prod = (int)$_GET['add'];
    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
    $stmt->execute([$id_prod]);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($produto) {
        $_SESSION['carrinho'][] = $produto;
    }
    header("Location: produtos.php");
    exit;
}

if (isset($_GET['limpar'])) {
    $_SESSION['carrinho'] = [];
    header("Location: produtos.php");
    exit;
}

$mensagem_pedido = '';
if (isset($_POST['finalizar']) && !empty($_SESSION['carrinho'])) {
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: login.php");
        exit;
    }

    $total_pedido = array_sum(array_column($_SESSION['carrinho'], 'preco'));
    $stmt = $pdo->prepare("INSERT INTO pedidos (usuario_id, valor_total) VALUES (?, ?)");
    $stmt->execute([$_SESSION['usuario_id'], $total_pedido]);

    $_SESSION['carrinho'] = [];
    $mensagem_pedido = "Pedido finalizado e registrado com sucesso!";
}

$categoria = $_GET['categoria'] ?? 'Todos';
if ($categoria !== 'Todos') {
    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE categoria = ?");
    $stmt->execute([$categoria]);
} else {
    $stmt = $pdo->query("SELECT * FROM produtos");
}
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total_carrinho = array_sum(array_column($_SESSION['carrinho'], 'preco'));
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - Mercado Verde</title>
  <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header>
        <h1>🌿 Mercado Verde</h1>
        <nav>
            <ul>
                <li><a href="index.php">Início</a></li>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="#carrinho">🛒 Carrinho (<?= count($_SESSION['carrinho']) ?>)</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <h1>Boas escolhas começam aqui!</h1>
        <p>Encontre frutas, bebidas, lanches e produtos para o seu dia a dia.</p>

        <?php if ($mensagem_pedido): ?>
            <p class="msg-sucesso"><?= $mensagem_pedido ?></p>
        <?php endif; ?>

        <h2>Nossos produtos</h2>
        <nav class="categorias-nav">
            <a href="produtos.php?categoria=Todos">Todos</a>
            <a href="produtos.php?categoria=Frutas">Frutas</a>
            <a href="produtos.php?categoria=Bebidas">Bebidas</a>
            <a href="produtos.php?categoria=Lanches">Lanches</a>
            <a href="produtos.php?categoria=Mercearia">Mercearia</a>
        </nav>

        <ul>
            <?php foreach ($produtos as $p): ?>
                <li>
                    <div>
                        <strong><?= htmlspecialchars($p['nome']) ?></strong> 
                        <small>(<?= htmlspecialchars($p['categoria']) ?>)</small> - 
                        <span>R$ <?= number_format($p['preco'], 2, ',', '.') ?></span>
                    </div>
                    <a href="produtos.php?add=<?= $p['id'] ?>" class="btn" style="padding: 0.4rem 0.9rem; font-size: 0.9rem;">+ Adicionar</a>
                </li>
            <?php endforeach; ?>
        </ul>

        <h2 id="carrinho">🛒 Meu carrinho</h2>
        <?php if (empty($_SESSION['carrinho'])): ?>
            <p>Seu carrinho está vazio no momento.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($_SESSION['carrinho'] as $item): ?>
                    <li>
                        <span><?= htmlspecialchars($item['nome']) ?></span>
                        <strong>R$ <?= number_format($item['preco'], 2, ',', '.') ?></strong>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <h3>Total: R$ <?= number_format($total_carrinho, 2, ',', '.') ?></h3>

        <div style="display: flex; gap: 0.8rem; flex-wrap: wrap;">
            <form method="POST" action="produtos.php" style="margin: 0;">
                <button type="submit" name="finalizar">Finalizar pedido</button>
            </form>
            <a href="produtos.php?limpar=1" class="btn btn-perigo">Limpar carrinho</a>
        </div>
    </main>

    <footer>
        <p>Mercado Verde — Qualidade e frescor para você.</p>
    </footer>
     <script src="js/scripts.js"></script>
</body>
</html>
