<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="images/LogoInnovamind.png" type="image/png">
    <link rel="stylesheet" href="CSS/baseSite.css">
    <title>Cadastrar FAQ</title>
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

        if (filter_has_var(INPUT_POST, "btnEditar")) {
            $edtFaq = new Faq();
            $idFaq = intval(filter_input(INPUT_POST, "id"));
            $faq = $edtFaq->search("idFaq", $idFaq)[0];
        }
        ?>

        <h2 class="text-center">Cadastrar FAQ</h2>

        <form action="dbFaq.php" method="post" class="row g3 mt-3">

            <input type="hidden" value="<?php echo $faq->idFaq ?? ''; ?>" name="idFaq">

            <div class="col-12">
                <label for="pergunta" class="form-label">Pergunta</label>
                <textarea class="form-control" name="pergunta" id="pergunta" placeholder="Digite a pergunta"
                    required><?= $faq->pergunta ?? '' ?></textarea>
            </div>

            <div class="col-12 mt-3">
                <label for="resposta" class="form-label">Resposta</label>
                <textarea class="form-control" name="resposta" idFaq="resposta" placeholder="Digite a resposta"
                    required><?= $faq->resposta ?? '' ?></textarea>
            </div>

            <div class="col-12 mt-4">
                <button type="submit" name="btnGravar" class="btn-cad">Salvar</button>
            </div>

        </form>

    </main>

    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>