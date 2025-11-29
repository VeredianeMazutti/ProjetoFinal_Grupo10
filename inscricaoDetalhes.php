<?php
/*require_once __DIR__ . "/verifica_acesso.php";*/

spl_autoload_register(function ($class) {
    require_once __DIR__ . "/Classes/{$class}.class.php";
});

$Inscricao = new InscricaoEdital();

$id = filter_input(INPUT_GET, "idInscricao", FILTER_SANITIZE_NUMBER_INT);

if (!$id) {
    echo "<script>alert('Inscrição inválida.');location.href='adminInscricoes.php';</script>";
    exit;
}

$dados = $Inscricao->findById($id);

if (!$dados) {
    echo "<script>alert('Inscrição não encontrada.');location.href='adminInscricoes.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/base.css">
    <link rel="shortcut icon" href="images/logoInnovamind.png" type="image/x-icon">
    <title>Detalhes da Inscrição</title>
</head>

<body>

    <nav>
        <?php include "_parts/_navbar.php"; ?>
    </nav>

    <main class="container mt-4">

        <h3 class="mb-4">Detalhes da Inscrição</h3>

        <div class="card shadow-sm border-0">
            <div class="card-body">

                <h5 class="text-primary mb-3">Informações Gerais</h5>

                <p><strong>ID da Inscrição:</strong> <?= $dados->idInscricao ?></p>
                <p><strong>ID do Edital:</strong> <?= $dados->idEditalInterno ?></p>
                <p><strong>Data da Inscrição:</strong> <?= date("d/m/Y H:i", strtotime($dados->dataInscricao)) ?></p>

                <hr>

                <h5 class="text-primary mb-3">Dados do Responsável</h5>

                <p><strong>Responsável:</strong> <?= htmlspecialchars($dados->responsavel) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($dados->email) ?></p>
                <p><strong>Telefone:</strong> <?= htmlspecialchars($dados->telefone) ?></p>
                <p><strong>Instituição:</strong> <?= htmlspecialchars($dados->instituicao) ?></p>

                <hr>

                <h5 class="text-primary mb-3">Informações do Projeto</h5>

                <p><strong>Título:</strong><br><?= nl2br(htmlspecialchars($dados->titulo)) ?></p>

                <p><strong>Resumo:</strong><br><?= nl2br(htmlspecialchars($dados->resumo)) ?></p>

                <p><strong>Objetivo:</strong><br><?= nl2br(htmlspecialchars($dados->objetivo)) ?></p>

                <p><strong>Relato:</strong><br><?= nl2br(htmlspecialchars($dados->relato)) ?></p>

            </div>
        </div>

        <a href="adminInscricoes.php" class="btn btn-secondary mt-4">
            Voltar
        </a>

    </main>

    <footer class="mt-5">
        <?php include "_parts/_footer.php"; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

    <!-- VLibras -->
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>

</body>

</html>