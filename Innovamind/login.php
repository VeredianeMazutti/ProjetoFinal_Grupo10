<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/base.css">
    <link rel="icon" href="Images/favicon-32x32F.png">
    <title>Login</title>
</head>

<body>
     <navbar>
        <?php require_once "_parts/_navbarVisitante.php"; ?>
    </navbar>

    <div class="flex-grow-1 d-flex justify-content-center align-items-center my-5">
        <div class="card shadow rounded-3 p-4">
            <h3 class="text-center mb-3">Login</h3>
            <form method="post" action="dbUsuario.php" class="row">
                <div class="mb-3 col-12">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="text" class="form-control" id="email" name="email"
                        placeholder="Digite seu e-mail" required>
                </div>
                <div class="mb-3 col-12">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-dark" name="btnLogar">Entrar</button>
                </div>
            </form>
            <p class="text-center mt-3">Não tem cadastro? <a href="cadUsuario.php">Clique aqui</a></p>
        </div>
    </div>
    <footer class="footer mt-auto">
        <?php require_once "_parts/_footer.php"; ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>