<?php
spl_autoload_register(function ($class) {
    require_once "Classes/{$class}.class.php";
});

if (filter_has_var(INPUT_POST, "btnEditar")) {
    $edt = new EditalExterno();
    $id = intval($_POST["id"]);
    $edital = $edt->search("id", $id)[0];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="images/LogoInnovamind.png">
    <link rel="stylesheet" href="CSS/baseSite.css">
    <title>Cadastrar Edital</title>
</head>

<body>

    <?php require_once "_parts/_navbar.php"; ?>

    <main class="cadastro-container my-5 efeito-luzes">

        <h2 class="text-center mb-4">Cadastrar Edital Externo</h2>

        <form action="dbEditalExterno.php" method="post" class="row g-3 mt-3">

            <input type="hidden" name="id" value="<?= $edital->id ?? '' ?>">

            <div class="col-12">
                <label class="form-label">Nome do Edital</label>
                <input type="text" class="form-control" name="nome" value="<?= $edital->nome ?? '' ?>" required>
            </div>

            <div class="col-12 mb-3">
                <label for="tipo" class="form-label">Categoria</label>
                <select name="categoria" id="categoria" class="form-select" required>
                    <option value="">Selecione...</option>

                    <option value="Governo Federal">Governo Federal</option>
                    <option value="Fundações de Pesquisa">Fundações de Pesquisa</option>
                    <option value="Cooperativas">Cooperativas</option>
                    <option value="Startups & Inovação">Startups & Inovação</option>
                    <option value="Educação & Bolsas">Educação & Bolsas</option>
                    <option value="Desenvolvimento Regional">Desenvolvimento Regional</option>
                    <option value="Organizações Privadas">Organizações Privadas</option>

                </select>
            </div>

            <div class="col-12">
                <label class="form-label">Descrição</label>
                <input type="text" class="form-control" name="descricao" value="<?= $edital->descricao ?? '' ?>"
                    required>
            </div>


            <div class="col-12">
                <label class="form-label">Link</label>
                <input type="url" class="form-control" name="link" value="<?= $edital->link ?? '' ?>" required>
            </div>

            <div class="col-12 mt-3">
                <button type="submit" name="btnGravar" class="btn-cad">Salvar</button>
            </div>

        </form>

    </main>

    <?php require_once "_parts/_footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

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