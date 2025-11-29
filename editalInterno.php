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

    <main class="container my-5 efeito-luzes">

        <p class="<?= $statusClass ?>"><?= strtoupper($dados->status) ?></p>

        <h2 class="titulo-edital mb-3"><?= htmlspecialchars($dados->titulo) ?></h2>

        <p class="lead"><?= htmlspecialchars($dados->descResumida) ?></p>

        <p class="campo-label">Organização responsável:</p>
        <p><?= htmlspecialchars($dados->organizacao) ?></p>

        <p class="campo-label">Tipo de apoio:</p>
        <p><?= htmlspecialchars($dados->tipoApoio) ?></p>

        <p class="campo-label">Abertura e Encerramento:</p>
        <p><?= $dataAbertura ?> até <?= $dataEncerramento ?></p>

        <p class="campo-label">Vagas disponíveis:</p>
        <p><?= htmlspecialchars($dados->vagas) ?></p>

        <p class="campo-label">Quem pode participar:</p>
        <p><?= nl2br(htmlspecialchars($dados->participantes)) ?></p>

        <p class="campo-label">Critérios de avaliação:</p>
        <p><?= nl2br(htmlspecialchars($dados->criterios)) ?></p>

        <p class="campo-label">Cronograma / Etapas</p>
        <p><?= nl2br(htmlspecialchars($dados->etapas)) ?></p>

        <p class="campo-label">Benefícios oferecidos:</p>
        <p><?= nl2br(htmlspecialchars($dados->beneficios)) ?></p>

        <p class="campo-label">Responsável pelo edital:</p>
        <p><?= htmlspecialchars($dados->responsavel) ?></p>

        <p class="campo-label">Contato:</p>
        <p><?= htmlspecialchars($dados->contato) ?></p>

        <p class="campo-label">Observações:</p>
        <p><?= nl2br(htmlspecialchars($dados->observacoes)) ?></p>

        <p class="campo-label">Descrição completa:</p>
        <p><?= nl2br(htmlspecialchars($dados->descCompleta)) ?></p>

        <?php if ($dados->status === "Aberto"): ?>
            <a href="cadInscricaoEdital.php?id=<?= $dados->idEditalInterno ?>" class="btn btn-dark mt-2">
                Inscrever-se neste Edital
            </a>
        <?php endif; ?>

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