<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/baseAdministracao.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="images/logoInnovamind.png" type="image/x-icon">
    <title>Login</title>
</head>

<body>

    <?php if (isset($_GET['expirou']) && $_GET['expirou'] == 1): ?>
        <div class="alert alert-warning text-center">
            Sua sessão expirou por inatividade. Faça login novamente.
        </div>
    <?php endif; ?>


    <navbar>
        <?php require_once "_parts/_navbar.php"; ?>
    </navbar>

    <main class="d-flex align-items-center justify-content-center my-4">
        <div class="login-card">
            <section class="login-ilustracao text-center p-4">
                <img src="images/login.png" alt="Ideia" class="login-img mb-4">
                <div class="login-frase-box">
                    <blockquote class="login-frase">
                        “A vida está cheia de desafios que, se aproveitados de forma criativa, transformam-se em
                        oportunidades.”
                    </blockquote>
                    <p class="login-autor">
                        <strong>Maxwell Maltz</strong><br>
                        Cirurgião que desenvolveu a psicocibernética
                    </p>
                </div>
            </section>

            <section class="login-right p-5">
                <h2 class="login-title text-center mb-4">Conecte-se</h2>

                <form method="post" action="dbUsuario.php" class="row">
                    <div class="mb-3 col-12">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Digite seu e-mail"
                            required>
                    </div>
                    <div class="mb-3 col-12">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha"
                            required>
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn-login" name="btnLogar">Entrar</button>
                    </div>
                </form>
                <p class=" mt-3">Não tem cadastro? <a href="cadUsuario.php" class="link-criar">Criar conta</a></p>
                <p class="">Esqueceu a senha?
                    <a href="redefinir_senha.php" class="link-criar">Recuperar senha</a>
                </p>
        </div>
        </div>
    </main>
    <footer class="footer mt-auto">
        <?php require_once "_parts/_footer.php"; ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script src="JS/formTheme.js"></script>

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