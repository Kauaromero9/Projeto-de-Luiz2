<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sair da sessão - Mercado Verde</title>
  <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header>
        <h1>🌿 Mercado Verde</h1>
    </header>

    <main class="container" style="text-align: center;">
        <h1>Logout</h1>
        <p class="msg-sucesso">Sua sessão foi encerrada com sucesso.</p>
        <br>
        <a href="login.php" class="btn">Voltar para o login</a>
        <a href="index.php" class="btn" style="background-color: var(--verde-escuro);">Menu principal</a>
    </main>

    <footer>
        <p>© 2026 Mercado Verde. Todos os direitos reservados.</p>
    </footer>
     <script src="js/scripts.js"></script>
</body>
</html>
