<?php
require 'conexao2/conexaoo.php';
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome     = $_POST['nome'];
    $cpf      = $_POST['cpf'];
    $email = trim($_POST['email']);
    $senha = password_hash(trim($_POST['senha']), PASSWORD_DEFAULT);
    $telefone = $_POST['telefone'];

    try {
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, cpf, email, senha, telefone) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nome, $cpf, $email, $senha, $telefone]);
        $usuario_id = $pdo->lastInsertId();

        $itens_padrao = ['Maçã', 'Uva', 'Refrigerante', 'Banana', 'Pão'];
        $stmt_lista = $pdo->prepare("INSERT INTO lista_compras (usuario_id, item) VALUES (?, ?)");
        foreach ($itens_padrao as $item) {
            $stmt_lista->execute([$usuario_id, $item]);
        }

        header("Location: login.php?cadastrado=1");
        exit;
    } catch (PDOException $e) {
        $erro = "Erro ao cadastrar: CPF ou E-mail já existem no sistema.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Mercado Verde</title>
   <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header>
        <h1>🌿 Mercado Verde</h1>
        <nav>
            <ul>
                <li><a href="index.php">Início</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <h1>Crie sua conta</h1>
        <p>Preencha suas informações para se cadastrar.</p>

        <?php if ($erro): ?>
            <p class="msg-erro"><?= $erro ?></p>
        <?php endif; ?>

        <form method="POST" action="cadastro.php">
            <label>Nome completo:</label>
            <input type="text" name="nome" required>

            <label>CPF:</label>
            <input type="text" name="cpf" required>

            <label>E-mail:</label>
            <input type="email" name="email" required>

            <label>Senha:</label>
            <input type="password" name="senha" required>

            <label>Telefone:</label>
            <input type="text" name="telefone" required>

            <button type="submit">Cadastrar</button>
        </form>

        <br>
        <a href="index.php">Voltar ao menu principal</a>
    </main>

    <footer>
        <p>© 2026 Mercado Verde. Todos os direitos reservados.</p>
    </footer>
           <script src="js/scripts.js"></script>
</body>
</html>
