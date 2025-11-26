<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="images/LogoInnovamind.png" type="image/png">
    <link rel="stylesheet" href="CSS/baseSite.css">
    <title>Cadastrar Usuário</title>
</head>

<body>

    <nav>
        <?php require_once "_parts/_navbar.php"; ?>
    </nav>

    <main class="cadastro-container my-5 efeito-luzes">

        <?php
        spl_autoload_register(function ($class) {
            require_once "Classes/{$class}.class.php";
        });

        $usuario = null;

        if (filter_has_var(INPUT_POST, "btnEditar")) {

            $edtUsuario = new Usuario();
            $id = intval(filter_input(INPUT_POST, "id"));

            $resultado = $edtUsuario->search("id", $id);

            if ($resultado && count($resultado) > 0) {
                $usuario = $resultado[0];
            }
        }
        ?>

        <h2 class="text-center">Cadastre-se e faça parte!</h2>

        <form action="dbUsuario.php" method="post" enctype="multipart/form-data" class="row g-3 mt-3">

            <input type="hidden" name="id" value="<?= $usuario->id ?? '' ?>">

            <!-- Nome -->
            <div class="col-12">
                <label for="nomeCompleto" class="form-label">Nome Completo</label>
                <input type="text" class="form-control" name="nomeCompleto" id="nomeCompleto"
                    placeholder="Digite seu nome completo" required
                    value="<?= $usuario->nomeCompleto ?? '' ?>">
            </div>

            <!-- Data e telefone -->
            <div class="col-md-6">
                <label for="dataNascimento" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" name="dataNascimento" id="dataNascimento" required
                    value="<?= $usuario->dataNascimento ?? '' ?>">
            </div>

            <div class="col-md-6">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="tel" class="form-control" name="telefone" id="telefone"
                    placeholder="Digite seu número de telefone" required
                    value="<?= $usuario->telefone ?? '' ?>">
            </div>

            <div class="col-md-6">
                <label for="areaAtuacao" class="form-label">Área de Atuação</label>
                <input type="text" class="form-control" name="areaAtuacao" id="areaAtuacao"
                    placeholder="Digite sua área de atuação" required
                    value="<?= $usuario->areaAtuacao ?? '' ?>">
            </div>

            <div class="col-md-6">
                <label for="nomeExibicao" class="form-label">Nome de Usuário</label>
                <input type="text" class="form-control" name="nomeExibicao" id="nomeExibicao"
                    placeholder="Digite seu nome de usuário que ficará visível" required
                    value="<?= $usuario->nomeExibicao ?? '' ?>">
            </div>

            <div class="col-12 mb-3 text-center">
                <label for="fotoPerfil" class="form-label d-block">Foto de Perfil</label>

                <img id="previewFoto"
                    src="<?= !empty($usuario->foto) ? 'uploads/fotoUsuario/' . $usuario->foto : 'images/default-user.png' ?>"
                    alt="Foto de Perfil" class="rounded-circle mb-3"
                    width="140" height="140" style="object-fit: cover;">

                <input type="file" class="form-control mt-2" id="fotoPerfil" name="fotoPerfil" accept="image/*">
            </div>

            <div class="col-12">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" name="email" id="email"
                    placeholder="Digite seu e-mail" required value="<?= $usuario->email ?? '' ?>">
            </div>

            <div class="col-md-6">
                <label for="senha" class="form-label">Senha</label>
                <div class="input-group">
                    <input type="password" class="form-control" name="senha" id="senha"
                        placeholder="<?= $usuario ? 'Digite uma nova senha (opcional)' : 'Digite uma senha' ?>">
                    <button type="button" id="toggleSenha" class="btn btn-outline-secondary">👁️</button>
                </div>
            </div>

            <div class="col-md-6">
                <label for="confirmar" class="form-label">Confirmar Senha</label>
                <div class="input-group">
                    <input type="password" class="form-control" name="confirmarSenha" id="confirmar"
                        placeholder="Digite novamente a senha">
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

            <!-- Botão salvar -->
            <div class="col-12 mt-3">
                <button type="submit" name="btnGravar" id="btnSalvar"
                    class="btn-cad" disabled>
                    <?= $usuario ? "Salvar Alterações" : "Cadastrar" ?>
                </button>
            </div>

        </form>
    </main>

    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script src="JS/senhaForte.js"></script>

    <script>
        document.getElementById('fotoPerfil').addEventListener('change', function (event) {
            const img = document.getElementById('previewFoto');
            img.src = URL.createObjectURL(event.target.files[0]);
        });
    </script>

</body>
</html>
