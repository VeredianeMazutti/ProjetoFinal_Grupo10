<?php
require_once __DIR__ . "/verifica_acesso.php";

spl_autoload_register(function ($class) {
    require_once __DIR__ . "/Classes/{$class}.class.php";
});

// ID do usuário logado
$idUsuario = $_SESSION['idUsuario'];

// Carregar dados do user
$u = new Usuario();
$dados = $u->search("id", $idUsuario);

if (!$dados || count($dados) == 0) {
    echo "<script>alert('Usuário não encontrado.'); window.location.href='index.php';</script>";
    exit;
}

$usuario = $dados[0];
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/baseAdministracao.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="CSS/baseAdministracao.css">
    <link rel="shortcut icon" href="images/logoInnovamind.png" type="image/x-icon">
    <title>Editar Perfil</title>
</head>

<body>

    <navbar>
        <?php require_once "_parts/_navbar.php"; ?>
    </navbar>

    <main class="container my-5">
        <h3 class="titulo-cad  text-center mb-4">Editar Perfil</h3>

        <form action="dbUsuario.php" method="post" enctype="multipart/form-data" class="row g-3">

            <input type="hidden" name="id" value="<?= $usuario->id ?>">

            <div class="col-md-6">
                <label class="form-label">Nome Completo</label>
                <input type="text" class="form-control" name="nomeCompleto" required
                    value="<?= htmlspecialchars($usuario->nomeCompleto) ?>">
            </div>

            <div class="col-md-6">
                <label class="form-label">Nome de Exibição</label>
                <input type="text" class="form-control" name="nomeExibicao" required
                    value="<?= htmlspecialchars($usuario->nomeExibicao) ?>">
            </div>

            <div class="col-md-6">
                <label class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" name="dataNascimento" required
                    value="<?= $usuario->dataNascimento ?>">
            </div>

            <div class="col-md-6">
                <label class="form-label">Telefone</label>
                <input type="text" id="telefone" class="form-control" name="telefone" required
                    value="<?= htmlspecialchars($usuario->telefone) ?>">
            </div>

            <div class="col-md-6">
                <label class="form-label">Área de Atuação</label>
                <input type="text" class="form-control" name="areaAtuacao" required
                    value="<?= htmlspecialchars($usuario->areaAtuacao) ?>">
            </div>

            <div class="col-md-6">
                <label class="form-label">E-mail</label>
                <input type="email" class="form-control" name="email" required
                    value="<?= htmlspecialchars($usuario->email) ?>">
            </div>

            <div class="col-12 mb-3 text-center">
                <label for="fotoPerfil" class="form-label d-block">Foto de Perfil</label>

                <img id="previewFoto"
                    src="<?= !empty($usuario->foto) ? 'uploads/fotoUsuario/' . $usuario->foto : 'images/default-user.png' ?>"
                    alt="Foto de Perfil" class="rounded-circle mb-3" width="140" height="140"
                    style="object-fit: cover;">

                <input type="file" class="form-control mt-2" id="fotoPerfil" name="fotoPerfil" accept="image/*">
            </div>

            <div class="col-md-6">
                <label for="senha" class="form-label">Nova Senha (opcional)</label>
                <div class="input-group">
                    <input type="password" class="form-control" name="senha" id="senha"
                        placeholder="Digite uma nova senha (opcional)">
                    <button type="button" id="toggleSenha" class="btn btn-outline-secondary">👁️</button>
                </div>
            </div>

            <div class="col-md-6">
                <label for="confirmar" class="form-label">Confirmar Nova Senha</label>
                <div class="input-group">
                    <input type="password" class="form-control" name="confirmarSenha" id="confirmar"
                        placeholder="Digite novamente a nova senha">
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

            <div class="col-12 mt-4 d-flex gap-3">
                <button type="submit" name="btnGravar" class="btn-cad">
                    Salvar Alterações
                </button>

                <a href="index.php" class="btn-voltar">
                    Voltar
                </a>
            </div>

        </form>
    </main>

    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="JS/senhaForte.js"></script>
    <script src="JS/formTheme.js"></script>
    <script src="JS/foto.js"></script>

    <script>
        $('#telefone').mask('(00) 00000-0000');
    </script>


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