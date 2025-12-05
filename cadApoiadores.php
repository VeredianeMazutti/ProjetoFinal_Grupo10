<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/baseAdministracao.css">
    <link rel="shortcut icon" href="images/logoInnovamind.png" type="image/x-icon">
    <title>Cadastrar Parceiro</title>
</head>

<body>
    <navbar>
        <?php require_once "_parts/_navbar.php"; ?>
    </navbar>

    <main class="cadastro-container my-5">

        <?php
        spl_autoload_register(function ($class) {
            require_once "Classes/{$class}.class.php";
        });

        $ap = null;

        if (isset($_GET["id"])) {
            $obj = new Apoiadores();
            $ap = $obj->findById($_GET["id"]);
        }
        ?>

        <h2 class="titulo-cad text-center"><?= $ap ? "Editar Parceiro" : "Cadastre-se como Parceiro!" ?></h2>

        <form action="dbApoiadores.php" method="post" class="row g-3 mt-3" enctype="multipart/form-data">

            <input type="hidden" name="idApoiadores" value="<?= $ap->idApoiadores ?? "" ?>">

            <div class="col-12 mb-3">
                <label for="tipo" class="form-label">Tipo de Parceiro</label>
                <select class="form-select" name="tipo" id="tipo" required>
                    <option value="">Selecione...</option>
                    <option value="pessoa" <?= ($ap && $ap->tipo == "pessoa") ? "selected" : "" ?>>Pessoa Física</option>
                    <option value="empresa" <?= ($ap && $ap->tipo == "empresa") ? "selected" : "" ?>>Empresa</option>
                    <option value="instituicao" <?= ($ap && $ap->tipo == "instituicao") ? "selected" : "" ?>>Instituição
                    </option>
                </select>
            </div>

            <div class="col-12">
                <label for="nome" class="form-label">Nome do Apoiador</label>
                <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite o nome do apoiador"
                    value="<?= $ap->nome ?? "" ?>" required>
            </div>

            <div class="col-12">
                <label for="descricao" class="form-label">Descrição / Biografia</label>
                <input type="text" class="form-control" name="descricao" id="descricao"
                    placeholder="Digite a descrição/biografia do apoiador" value="<?= $ap->descricao ?? "" ?>" required
                    maxlength="500">
            </div>

            <div class="col-12">
                <label class="form-label" for="imagem">Foto / Logo</label>
                <input type="file" class="form-control" name="imagem" id="imagem" accept="image/*">
                <img id="previewImagem"
                    src="<?= $ap && $ap->imagem ? 'uploads/parceiros/' . $ap->imagem : 'images/default.png' ?>"
                    width="140" class="mt-2">
            </div>

            <div class="col-md-4">
                <label class="form-label">Website</label>
                <input type="url" class="form-control" name="site" placeholder="Adicione o link do site do apoiador"
                    value="<?= $ap->site ?? "" ?>">
            </div>

            <div class="col-md-4">
                <label class="form-label">Instagram</label>
                <input type="url" class="form-control" name="instagram"
                    placeholder="Adicione o link do Instagram do apoiador" value="<?= $ap->instagram ?? "" ?>">
            </div>

            <div class="col-md-4">
                <label class="form-label">LinkedIn</label>
                <input type="url" class="form-control" name="linkedin" placeholder="Adicione o Linkedin do apoiador"
                    value="<?= $ap->linkedin ?? "" ?>">
            </div>

            <div class="col-12 mt-4">
                <button type="submit" name="btnGravar" class="btn-cad">
                    <?= $ap ? "Salvar Alterações" : "Cadastrar" ?>
                </button>
            </div>

        </form>
    </main>

    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script src="JS/formTheme.js"></script>
    <script src="JS/foto.js"></script>

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