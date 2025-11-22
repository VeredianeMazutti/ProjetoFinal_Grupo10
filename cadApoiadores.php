<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="images/LogoInnovamind.png" type="image/png">
    <link rel="stylesheet" href="CSS/baseSite.css">
    <title>Cadastrar Parceiro</title>
</head>

<body>
    <navbar>
        <?php require_once "_parts/_navbar.php"; ?>
    </navbar>

    <main class="cadastro-container my-5 efeito-luzes">

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

        <h2 class="text-center"><?= $ap ? "Editar Parceiro" : "Cadastre-se como Parceiro!" ?></h2>

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
                <label for="nome" class="form-label">Nome / Razão Social</label>
                <input type="text" class="form-control" name="nome" id="nome" value="<?= $ap->nome ?? "" ?>" required>
            </div>

            <div class="col-12">
                <label for="descricao" class="form-label">Descrição / Biografia</label>
                <input type="text" class="form-control" name="descricao" id="descricao"
                    value="<?= $ap->descricao ?? "" ?>" required maxlength="500">
            </div>

            <div class="col-12">
                <label class="form-label" for="imagem">Foto / Logo</label>
                <input type="file" class="form-control" name="imagem" accept="image/*">
                <?php if ($ap && $ap->imagem): ?>
                    <p class="mt-2">Imagem atual: <img src="uploads/parceiros/<?= $ap->imagem ?>" width="120"></p>
                <?php endif; ?>
            </div>
            ]
            <div class="col-md-4">
                <label class="form-label">Website</label>
                <input type="url" class="form-control" name="site" value="<?= $ap->site ?? "" ?>">
            </div>

            <div class="col-md-4">
                <label class="form-label">Instagram</label>
                <input type="url" class="form-control" name="instagram" value="<?= $ap->instagram ?? "" ?>">
            </div>

            <div class="col-md-4">
                <label class="form-label">LinkedIn</label>
                <input type="url" class="form-control" name="linkedin" value="<?= $ap->linkedin ?? "" ?>">
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

</body>

</html>