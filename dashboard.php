<?php
require_once "verifica_acesso.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/baseSite.css">
    <title>Dashboard</title>
</head>

<body class="p-5">

    <?php include "_parts/_navbar.php"; ?>

    <div class="container mt-4">

        <h1 class="mb-3">Bem-vindo, <?= htmlspecialchars($_SESSION['nomeUsuario']); ?>!</h1>
        <p class="text-muted">Perfil: <?= htmlspecialchars($_SESSION['perfil']); ?></p>

        <?php if ($_SESSION['perfil'] === 'admin'): ?>
            <div class="alert alert-success">
                Você é <strong>admin</strong>. Acesse:<br>
                <a href="usuario.php">Gerenciar Usuários</a>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                Você é <strong>usuário</strong>. Acesse:<br>
                <a href="cadProjeto.php">Cadastrar Projeto</a>
            </div>
        <?php endif; ?>

    </div>

</body>
</html>
