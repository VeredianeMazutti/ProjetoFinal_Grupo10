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
    <link rel="shortcut icon" href="images/logoInnovamind.png" type="image/x-icon">
    <title>Dashboard</title>
</head>

<body>
    <navbar>
        <?php require_once "_parts/_navbar.php"; ?>
    </navbar>

    <main class="container mt-3">

        <div class="container mt-4">

            <h1 class="mb-3">Bem-vindo, <?= htmlspecialchars($_SESSION['nomeUsuario']); ?>!</h1>
            <p class="text-perfil">Perfil: <?= htmlspecialchars($_SESSION['perfil']); ?></p>

            <?php if ($_SESSION['perfil'] === 'admin'): ?>
                <div class="alert alert-success">
                    Você é <strong>admin</strong>. Acesse:<br>
                    <a href="listaUsuarios.php">Gerenciar Usuários</a>
                </div>
            <?php else: ?>
                <div class="alert alert-info">
                    Você é <strong>usuário</strong>. Acesse:<br>
                    <a href="cadProjeto.php">Cadastrar Projeto</a>
                </div>
            <?php endif; ?>

        </div>

    </main>

    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

    <!-- VLibras -->
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>

    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>

</body>

</html>