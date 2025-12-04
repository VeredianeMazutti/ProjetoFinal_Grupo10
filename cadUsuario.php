<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/logoInnovamind.png" type="image/x-icon">
    <link rel="stylesheet" href="CSS/baseAdministracao.css">
    <title>Cadastrar Usuário</title>
    <style>
/* ====== CHECKBOX PERSONALIZADO INNOVAMIND ====== */
.form-check-input {
  width: 1.2em;
  height: 1.2em;
  border: 2px solid #b387ff;
  background-color: transparent;
  cursor: pointer;
  transition: all 0.2s ease-in-out;
}

.form-check-input:checked {
  background-color: #b387ff !important; /* lilás */
  border-color: #b387ff !important;
  box-shadow: 0 0 5px #c59cff;
}

.form-check-input:focus {
  box-shadow: 0 0 5px #b387ff !important;
  outline: none;
}

.form-check-label {
  color: #e0d8f7;
  margin-left: 5px;
}
</style>

</head>

<body>

    <nav>
        <?php require_once "_parts/_navbar.php"; ?>
    </nav>

    <main class="cadastro-container my-5">

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

        <h2 class="titulo-cad text-center">Cadastre-se e faça parte!</h2>

        <form action="dbUsuario.php" method="post" enctype="multipart/form-data" class="row g-3 mt-3">

            <input type="hidden" name="id" value="<?= $usuario->id ?? '' ?>">

            <div class="col-12">
                <label for="nomeCompleto" class="form-label">Nome Completo</label>
                <input type="text" class="form-control" name="nomeCompleto" id="nomeCompleto"
                    placeholder="Digite seu nome completo" required value="<?= $usuario->nomeCompleto ?? '' ?>">
            </div>

            <div class="col-md-6">
                <label for="dataNascimento" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" name="dataNascimento" id="dataNascimento" required
                    value="<?= $usuario->dataNascimento ?? '' ?>">
            </div>

            <div class="col-md-6">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="tel" class="form-control" name="telefone" id="telefone"
                    placeholder="Digite seu número de telefone" required value="<?= $usuario->telefone ?? '' ?>">
            </div>

            <div class="col-md-6">
                <label for="areaAtuacao" class="form-label">Área de Atuação</label>
                <input type="text" class="form-control" name="areaAtuacao" id="areaAtuacao"
                    placeholder="Digite sua área de atuação" required value="<?= $usuario->areaAtuacao ?? '' ?>">
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
                    alt="Foto de Perfil" class="rounded-circle mb-3" width="140" height="140"
                    style="object-fit: cover;">

                <input type="file" class="form-control mt-2" id="fotoPerfil" name="fotoPerfil" accept="image/*">
            </div>

            <div class="col-12">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Digite seu e-mail"
                    required value="<?= $usuario->email ?? '' ?>">
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

            <!-- ===================================================== -->
<!--          LGPD - Termos e Política (Com Modais)        -->
<!-- ===================================================== -->
<div class="col-12 mt-4 p-4 rounded" 
     style="background-color: #2c1b47; border: 1px solid #5e2ca5; color: #e0d8f7;">

    <h5 class="mb-3" style="color: #b387ff;">📜 Termos e Privacidade</h5>

    <div class="form-check mb-2">
        <input class="form-check-input" type="checkbox" id="aceitarTermos" name="aceitarTermos" required
               style="border-color: #b387ff; background-color: transparent;">
        <label class="form-check-label" for="aceitarTermos" style="color: #e0d8f7;">
            Declaro que li e aceito os 
            <a href="#" data-bs-toggle="modal" data-bs-target="#modalTermos"
               style="color: #8ab4ff; text-decoration: underline;">Termos de Uso</a>.
        </label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="aceitarPolitica" name="aceitarPolitica" required
               style="border-color: #b387ff; background-color: transparent;">
        <label class="form-check-label" for="aceitarPolitica" style="color: #e0d8f7;">
            Concordo com a 
            <a href="#" data-bs-toggle="modal" data-bs-target="#modalPolitica"
               style="color: #8ab4ff; text-decoration: underline;">Política de Privacidade (LGPD)</a>.
        </label>
    </div>

</div>

<!-- ===================================================== -->
<!--              MODAL - TERMOS DE USO                    -->
<!-- ===================================================== -->
<div class="modal fade" id="modalTermos" tabindex="-1" aria-labelledby="modalTermosLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background-color:#2c1b47; color:#e0d8f7; border:1px solid #5e2ca5;">
      <div class="modal-header" style="border-bottom:1px solid #5e2ca5;">
        <h5 class="modal-title" id="modalTermosLabel" style="color:#b387ff;">📄 Termos de Uso — Innovamind</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body" style="max-height:70vh; overflow-y:auto;">
        <?php include "termos.php"; ?>
      </div>
      <div class="modal-footer" style="border-top:1px solid #5e2ca5;">
        <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<!-- ===================================================== -->
<!--              MODAL - POLÍTICA DE PRIVACIDADE          -->
<!-- ===================================================== -->
<div class="modal fade" id="modalPolitica" tabindex="-1" aria-labelledby="modalPoliticaLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background-color:#2c1b47; color:#e0d8f7; border:1px solid #5e2ca5;">
      <div class="modal-header" style="border-bottom:1px solid #5e2ca5;">
        <h5 class="modal-title" id="modalPoliticaLabel" style="color:#b387ff;">🔒 Política de Privacidade — LGPD</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body" style="max-height:70vh; overflow-y:auto;">
        <?php include "politica.php"; ?>
      </div>
      <div class="modal-footer" style="border-top:1px solid #5e2ca5;">
        <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<!-- ===================================================== -->
<!--           FIM DOS MODAIS - TERMOS E POLÍTICA          -->
<!-- ===================================================== -->


            <div class="col-12 mt-4">
                <button type="submit" name="btnGravar" id="btnSalvar" class="btn-cad" disabled>
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
    <script src="JS/formTheme.js"></script>

    <script>
        document.getElementById('fotoPerfil').addEventListener('change', function (event) {
            const img = document.getElementById('previewFoto');
            img.src = URL.createObjectURL(event.target.files[0]);
        });

        // HABILITAR BOTÃO SOMENTE SE OS CHECKBOXES DE LGPD FOREM MARCADOS
        const btn = document.getElementById("btnSalvar");
        const termos = document.getElementById("aceitarTermos");
        const politica = document.getElementById("aceitarPolitica");

        function validarLGPD() {
            btn.disabled = !(termos.checked && politica.checked);
        }

        termos.addEventListener("change", validarLGPD);
        politica.addEventListener("change", validarLGPD);
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
