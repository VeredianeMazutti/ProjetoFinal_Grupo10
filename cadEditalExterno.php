<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/baseAdministracao.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="images/logoInnovamind.png" type="image/x-icon">
    <title>Cadastrar Edital</title>
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

        $edital = null;

        if (isset($_GET["idEditalExterno"])) {
            $obj = new EditalExterno();
            $edital = $obj->search("idEditalExterno", $_GET["idEditalExterno"])[0] ?? null;
        }
        ?>

        <h2 class="titulo-cad text-center"><?= $edital ? "Editar Edital Externo" : "Cadastrar Novo Edital Externo" ?>
        </h2>

        <form action="dbEditalExterno.php" method="post" class="row g-3 mt-3">

            <input type="hidden" name="idEditalExterno" value="<?= $edital->idEditalExterno ?? "" ?>">

            <div class="col-12 mb-3">
                <label for="nome" class="form-label">Nome do Edital</label>
                <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite o nome do edital"
                    value="<?= $edital->nome ?? "" ?>" required>
            </div>

            <div class="col-12 mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <select class="form-select" name="categoria" id="categoria" required>
                    <option value="">Selecione...</option>
                    <option value="Governo Federal" <?= ($edital && $edital->categoria == "Governo Federal") ? "selected" : "" ?>>Governo Federal</option>
                    <option value="Fundações de Pesquisa" <?= ($edital && $edital->categoria == "Fundações de Pesquisa") ? "selected" : "" ?>>Fundações de Pesquisa</option>
                    <option value="Cooperativas" <?= ($edital && $edital->categoria == "Cooperativas") ? "selected" : "" ?>>Cooperativas</option>
                    <option value="Startups & Inovação" <?= ($edital && $edital->categoria == "Startups & Inovação") ? "selected" : "" ?>>Startups & Inovação</option>
                    <option value="Educação & Bolsas" <?= ($edital && $edital->categoria == "Educação & Bolsas") ? "selected" : "" ?>>Educação & Bolsas</option>
                    <option value="Desenvolvimento Regional" <?= ($edital && $edital->categoria == "Desenvolvimento Regional") ? "selected" : "" ?>>Desenvolvimento Regional</option>
                    <option value="Organizações Privadas" <?= ($edital && $edital->categoria == "Organizações Privadas") ? "selected" : "" ?>>Organizações Privadas</option>
                </select>
            </div>

            <div class="col-12">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" class="form-control" name="descricao" id="descricao"
                    placeholder="Digite a descrição do edital" value="<?= $edital->descricao ?? "" ?>" required
                    maxlength="50">
            </div>

            <div class="col-12">
                <label for="link" class="form-label">Link</label>
                <input type="url" class="form-control" name="link" id="link" placeholder="Adicione o link do edital"
                    value="<?= $edital->link ?? "" ?>" required>
            </div>

            <div class="col-12 mt-4">
                <button type="submit" name="btnGravar" class="btn-cad">
                    <?= $edital ? "Salvar Alterações" : "Cadastrar" ?>
                </button>
            </div>

        </form>
    </main>

    <footer>
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