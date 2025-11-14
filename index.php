<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index - Validação</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-5">

    <div class="container">

        <?php if (isset($_SESSION['idUsuario'])): ?>

            <h1>Bem-vindo, <?= htmlspecialchars($_SESSION['nomeUsuario']); ?>!</h1>
            <p>Seu perfil: <?= htmlspecialchars($_SESSION['perfil']); ?></p>

            <?php if ($_SESSION['perfil'] === 'admin'): ?>
                <div class="alert alert-success">
                    Você é administrador. Pode acessar:
                    <a href="admin/dashboard.php">Dashboard Admin</a>
                </div>
            <?php else: ?>
                <div class="alert alert-info">
                    Você é usuário cadastrado. Pode acessar:
                    <a href="cadProjeto.php">Home do Usuário</a>
                </div>
            <?php endif; ?>

            <a href="logout.php" class="btn btn-danger">Sair</a>

        <?php else: ?>

            <h1>Bem-vindo, visitante!</h1>
            <p>Faça login para acessar funcionalidades.</p>
            <a href="login.php" class="btn btn-primary">Login / Cadastro</a>

        <?php endif; ?>

    </div>

</body>

</html>