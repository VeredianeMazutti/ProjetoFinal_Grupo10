<?php
spl_autoload_register(function ($class) {
    require_once "Classes/{$class}.class.php";
});

$Edital = new EditalInterno();
$lista = $Edital->searchAll();

/* Separando por status */
$abertos = [];
$analise = [];
$encerrados = [];

foreach ($lista as $e) {
    if ($e->status === "Aberto") {
        $abertos[] = $e;
    } elseif ($e->status === "Em análise" || $e->status === "Em analise") {
        $analise[] = $e;
    } elseif ($e->status === "Encerrado") {
        $encerrados[] = $e;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/baseSite.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="images/logoInnovamind.png" type="image/x-icon">
    <title>Editais Internos</title>
</head>

<body>

    <navbar>
        <?php require_once "_parts/_navbar.php"; ?>
    </navbar>

    <main class="container my-5">
        <h2 class="titulo-editais text-center my-3">Editais Internos</h2>

        <ul class="nav nav-tabs justify-content-center mb-4">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab1">Abertos</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab2">Em análise</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab3">Encerrados</button>
            </li>
        </ul>

        <div class="tab-content">

            <div class="tab-pane fade show active apoiadores-grid" id="tab1">
                <?php foreach ($abertos as $Edital): ?>

                    <?php
                    $statusClass = "status-aberto";
                    $dataAbertura = date("d/m/y", strtotime($Edital->dataAbertura));
                    $dataEncerramento = date("d/m/y", strtotime($Edital->dataEncerramento));
                    ?>

                    <div class="card-edital">
                        <p class="mb-1 <?= $statusClass ?>"><i class="bi bi-check-circle"></i>
                            <?= strtoupper($Edital->status) ?></p>
                        <p class="titulo-edital mt-2"><?= htmlspecialchars($Edital->titulo) ?></p>
                        <p class="desc"><?= htmlspecialchars($Edital->descResumida) ?></p>
                        <p class="small text-secondary"><strong>De:</strong> <?= $dataAbertura ?> | <strong>Até:</strong>
                            <?= $dataEncerramento ?></p>
                        <a href="editalinterno.php?id=<?= $Edital->idEditalInterno ?>" class="btn btn-dark mt-2">Saiba
                            mais</a>
                    </div>

                <?php endforeach; ?>

                <?php if (count($abertos) == 0)
                    echo '<p class="text-center text-muted">Nenhum edital aberto.</p>'; ?>
            </div>

            <div class="tab-pane fade apoiadores-grid" id="tab2">
                <?php foreach ($analise as $Edital): ?>

                    <?php
                    $statusClass = "status-analise";
                    $dataAbertura = date("d/m/y", strtotime($Edital->dataAbertura));
                    $dataEncerramento = date("d/m/y", strtotime($Edital->dataEncerramento));
                    ?>

                    <div class="card-edital">
                        <p class="mb-1 <?= $statusClass ?>"><i class="bi bi-clock"></i> <?= strtoupper($Edital->status) ?>
                        </p>
                        <p class="titulo-edital mt-2"><?= htmlspecialchars($Edital->titulo) ?></p>
                        <p class="desc"><?= htmlspecialchars($Edital->descResumida) ?></p>
                        <p class="small text-secondary"><strong>De:</strong> <?= $dataAbertura ?> | <strong>Até:</strong>
                            <?= $dataEncerramento ?></p>
                        <a href="editalinterno.php?id=<?= $Edital->idEditalInterno ?>" class="btn btn-dark mt-2">Saiba
                            mais</a>
                    </div>

                <?php endforeach; ?>

                <?php if (count($analise) == 0)
                    echo '<p class="text-center text-muted">Nenhum edital em análise.</p>'; ?>
            </div>

            <div class="tab-pane fade apoiadores-grid" id="tab3">
                <?php foreach ($encerrados as $Edital): ?>

                    <?php
                    $statusClass = "status-encerrado";
                    $dataAbertura = date("d/m/y", strtotime($Edital->dataAbertura));
                    $dataEncerramento = date("d/m/y", strtotime($Edital->dataEncerramento));
                    ?>

                    <div class="card-edital">
                        <p class="mb-1 <?= $statusClass ?>"><i class="bi bi-x-circle"></i>
                            <?= strtoupper($Edital->status) ?></p>
                        <p class="titulo-edital mt-2"><?= htmlspecialchars($Edital->titulo) ?></p>
                        <p class="desc"><?= htmlspecialchars($Edital->descResumida) ?></p>
                        <p class="small text-secondary"><strong>De:</strong> <?= $dataAbertura ?> | <strong>Até:</strong>
                            <?= $dataEncerramento ?></p>
                        <a href="editalinterno.php?id=<?= $Edital->idEditalInterno ?>" class="btn btn-dark mt-2">Saiba
                            mais</a>
                    </div>

                <?php endforeach; ?>

                <?php if (count($encerrados) == 0)
                    echo '<p class="text-center text-muted">Nenhum edital encerrado.</p>'; ?>
            </div>

        </div>
    </main>

    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

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