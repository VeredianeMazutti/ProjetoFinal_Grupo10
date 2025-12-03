<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    spl_autoload_register(function ($class) {
        require_once "Classes/{$class}.class.php";
    });

    $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
    $nova_senha = filter_input(INPUT_POST, 'nova_senha', FILTER_SANITIZE_STRING);
    $confirmar_senha = filter_input(INPUT_POST, 'confirmar_senha', FILTER_SANITIZE_STRING);

    if ($nova_senha !== $confirmar_senha) {
        $mensagem = "<script>window.alert('As senhas não conferem!');</script>";

    } else {
        $usuario = new Usuario;
        $usuario->redefinirSenha($token, $nova_senha);
        $mensagem = "<script>window.alert('Senha alterada com sucesso.'); window.location.href='login.php';</script>";
    }

    echo $mensagem;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/baseAdministracao.css">
    <link rel="shortcut icon" href="images/logoInnovamind.png" type="image/x-icon">
    <title>Redefinir Senha</title>
</head>

<body>

    <main class="flex-grow-1 d-flex justify-content-center align-items-center">
        <div class="form-login">
            <p class="titulo-cad text-center my-4">Redefinir Senha</p>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="row">
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token'] ?? ''); ?>">

                <div class="mb-3 col-12">
                    <label for="nova_senha" class="form-label">Nova Senha</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="nova_senha" name="nova_senha"
                            placeholder="Nova senha" required>
                        <button type="button" id="toggleSenha" class="btn btn-outline-secondary">👁️</button>
                    </div>
                </div>

                <div class="mb-3 col-12">
                    <label for="confirmar_senha" class="form-label">Confirmar Nova Senha</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha"
                            placeholder="Confirmar senha" required>
                        <button type="button" id="toggleConfirmar" class="btn btn-outline-secondary">👁️</button>
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <ul id="requisitos">
                        <li id="minChar">Mínimo 12 caracteres</li>
                        <li id="maiuscula">Pelo menos 1 letra maiúscula</li>
                        <li id="minuscula">Pelo menos 1 letra minúscula</li>
                        <li id="numero">Pelo menos 1 número</li>
                        <li id="especial">Pelo menos 1 caractere especial</li>
                        <li id="comum">Não pode ser uma senha comum. Ex: 123456</li>
                    </ul>

                    <p id="forcaSenha"></p>
                    <p id="msgConfirmacao"></p>
                </div>

                <p id="forcaSenha"></p>
                <p id="msgConfirmacao"></p>

                <div class="text-center my-3">
                    <button type="submit" class="btn-geral" id="btnSalvar" disabled>Redefinir Senha</button>
                </div>

    </main>
    <footer class="footer mt-auto">
        <?php require_once "_parts/_footer.php"; ?>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script src="JS/senhaForte.js"></script>

    <!-- Botão do VLibras -->
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>

    <!-- Script do VLibras -->
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>
</body>

</html>