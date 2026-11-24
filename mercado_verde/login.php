<?php
session_start();
require 'conexao2/conexaoo.php';
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $email = trim($_POST['email']);
   $senha = trim($_POST['senha']);


    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        header("Location: dashboard.php");
        exit;
    } else {
        $erro = "E-mail ou senha incorretos.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mercado Verde</title>
   <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header>
        <h1>🌿 Mercado Verde</h1>
        <nav>
            <ul>
                <li><a href="index.php">Início</a></li>
                <li><a href="cadastro.php">Cadastro</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <h1>Login</h1>

        <?php if (isset($_GET['cadastrado'])): ?>
            <p class="msg-sucesso">Cadastro realizado! Faça seu login abaixo.</p>
        <?php endif; ?>

        <?php if ($erro): ?>
            <p class="msg-erro"><?= $erro ?></p>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <label>E-mail:</label>
            <input type="email" name="email" required>

            <label>Senha:</label>
            <input type="password" name="senha" required>

            <button type="submit">Entrar</button>
        </form>

        <br>
        <a href="cadastro.php">Criar conta</a> | 
        <a href="index.php">Voltar ao menu principal</a>
    </main>

    <footer>
        <p>© 2026 Mercado Verde. Todos os direitos reservados.</p>
    </footer>
     <script src="js/scripts.js"></script>
</body>
</html>
