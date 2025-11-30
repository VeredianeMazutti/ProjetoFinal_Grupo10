<?php
spl_autoload_register(function ($class) {
    require_once "Classes/{$class}.class.php";

});
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Edital não encontrado.");
}

$id = intval($_GET['id']);

$Edital = new EditalInterno();
$dados = $Edital->searchById($id);

if (!$dados) {
    die("Edital não encontrado.");
}

$dataAbertura = date("d/m/Y", strtotime($dados->dataAbertura));
$dataEncerramento = date("d/m/Y", strtotime($dados->dataEncerramento));

// Estilização do status
$statusClass = "";
if ($dados->status == "Aberto")
    $statusClass = "status-aberto";
elseif ($dados->status == "Encerrado")
    $statusClass = "status-encerrado";
else
    $statusClass = "status-analise";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/baseSite.css">
    <link rel="shortcut icon" href="images/logoInnovamind.png" type="image/x-icon">
    <title><?= htmlspecialchars($dados->titulo) ?></title>
</head>

<body>

    <navbar>
        <?php require_once "_parts/_navbar.php"; ?>
    </navbar>
    <main class="edital-container">

        <div class="editais-container">

            <h2 class="titulo-editais text-center my-3"><?= htmlspecialchars($dados->titulo) ?></h2>
            <p class="subtitulo text-center"><?= htmlspecialchars($dados->descResumida) ?></p>

            <div class="info-section">
                <div class="info-grid">

                    <div class="bloco-info">
                        <p class="label">Status:</p>
                        <p class="texto"><?= htmlspecialchars($dados->status) ?></p>
                    </div>

                    <div class="bloco-info">
                        <p class="label">Organização:</p>
                        <p class="texto"><?= htmlspecialchars($dados->organizacao) ?></p>
                    </div>

                    <div class="bloco-info">
                        <p class="label">Tipo de apoio:</p>
                        <p class="texto"><?= htmlspecialchars($dados->tipoApoio) ?></p>
                    </div>

                    <div class="bloco-info">
                        <p class="label">Período:</p>
                        <p class="texto"><?= $dataAbertura ?> até <?= $dataEncerramento ?></p>
                    </div>

                    <div class="bloco-info">
                        <p class="label">Vagas:</p>
                        <p class="texto"><?= htmlspecialchars($dados->vagas) ?></p>
                    </div>

                    <div class="bloco-info">
                        <p class="label">Responsável:</p>
                        <p class="texto"><?= htmlspecialchars($dados->responsavel) ?></p>
                    </div>

                    <div class="bloco-info">
                        <p class="label">Contato:</p>
                        <p class="texto"><?= htmlspecialchars($dados->contato) ?></p>
                    </div>

                </div>
            </div>

            <div class="card-detalhado">

                <div class="divisor"></div>

                <h2 class="titulo-editais text-center my-3">Informações Detalhadas</h2>

                <p class="label">Quem pode participar:</p>
                <p class="texto"><?= nl2br(htmlspecialchars($dados->participantes)) ?></p>

                <p class="label">Critérios de avaliação:</p>
                <p class="texto"><?= nl2br(htmlspecialchars($dados->criterios)) ?></p>

                <p class="label">Cronograma / Etapas:</p>
                <p class="texto"><?= nl2br(htmlspecialchars($dados->etapas)) ?></p>

                <p class="label">Benefícios oferecidos:</p>
                <p class="texto"><?= nl2br(htmlspecialchars($dados->beneficios)) ?></p>

                <p class="label">Observações:</p>
                <p class="texto"><?= nl2br(htmlspecialchars($dados->observacoes)) ?></p>

                <p class="label">Descrição completa:</p>
                <p class="texto"><?= nl2br(htmlspecialchars($dados->descCompleta)) ?></p>

                <?php if ($dados->status === "Aberto"): ?>
                    <a href="cadInscricaoEdital.php?id=<?= $dados->idEditalInterno ?>" class="btn-inscricao">
                        Inscrever-se neste Edital
                    </a>
                <?php endif; ?>
            </div>

    </main>

    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

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