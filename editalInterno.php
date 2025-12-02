<?php
spl_autoload_register(function ($class) {
    require_once "Classes/{$class}.class.php";
});

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Edital não encontrado.");
}

$id = intval($_GET['id']);

$Edital = new EditalInterno();
$EditalInterno = $Edital->searchById($id);

if (!$EditalInterno) {
    die("Edital não encontrado.");
}

$dataAbertura = date("d/m/Y", strtotime($EditalInterno->dataAbertura));
$dataEncerramento = date("d/m/Y", strtotime($EditalInterno->dataEncerramento));

// Estilização do status
$statusClass = "";
if ($EditalInterno->status == "Aberto")
    $statusClass = "status-aberto";
elseif ($EditalInterno->status == "Encerrado")
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
    <title><?= htmlspecialchars($EditalInterno->titulo) ?></title>
</head>

<body>

    <navbar>
        <?php require_once "_parts/_navbar.php"; ?>
    </navbar>

    <main class="edital-container d-flex justify-content-center align-items-center">

        <div>
            <h2 class="titulo-editais text-center my-3">
                <?= htmlspecialchars($EditalInterno->titulo) ?>
            </h2>
            <p class="subtitulo text-center">
                <?= htmlspecialchars($EditalInterno->descResumida) ?>
            </p>

            <section class="info-section">

                <h4 class="subtitulo-editalinterno text-center my-4">Informações Gerais</h4>

                <div class="info-grid">

                    <div class="bloco-info">
                        <p class="label">Status:</p>
                        <p class="texto <?= $statusClass ?>"><?= htmlspecialchars($EditalInterno->status) ?></p>
                    </div>

                    <div class="bloco-info">
                        <p class="label">Organização:</p>
                        <p class="texto"><?= htmlspecialchars($EditalInterno->organizacao) ?></p>
                    </div>

                    <div class="bloco-info">
                        <p class="label">Tipo de apoio:</p>
                        <p class="texto"><?= htmlspecialchars($EditalInterno->tipoApoio) ?></p>
                    </div>

                    <div class="bloco-info">
                        <p class="label">Período:</p>
                        <p class="texto"><?= $dataAbertura ?> até <?= $dataEncerramento ?></p>
                    </div>

                    <div class="bloco-info">
                        <p class="label">Vagas:</p>
                        <p class="texto"><?= htmlspecialchars($EditalInterno->vagas) ?></p>
                    </div>

                    <div class="bloco-info">
                        <p class="label">Responsável:</p>
                        <p class="texto"><?= htmlspecialchars($EditalInterno->responsavel) ?></p>
                    </div>

                    <div class="bloco-info">
                        <p class="label">Contato:</p>
                        <p class="texto"><?= htmlspecialchars($EditalInterno->contato) ?></p>
                    </div>

            </section>

            <section>

                <h2 class="subtitulo-editalinterno text-center my-3">Informações Detalhadas</h2>

                <div class="bloco-info">
                    <p class="label">Quem pode participar:</p>
                    <p class="texto"><?= nl2br(htmlspecialchars($EditalInterno->participantes)) ?></p>
                </div>

                <div class="bloco-info">
                    <p class="label">Critérios de avaliação:</p>
                    <p class="texto"><?= nl2br(htmlspecialchars($EditalInterno->criterios)) ?></p>
                </div>

                <div class="bloco-info">
                    <p class="label">Cronograma / Etapas:</p>
                    <p class="texto"><?= nl2br(htmlspecialchars($EditalInterno->etapas)) ?></p>
                </div>

                <div class="bloco-info">
                    <p class="label">Benefícios oferecidos:</p>
                    <p class="texto"><?= nl2br(htmlspecialchars($EditalInterno->beneficios)) ?></p>
                </div>

                <div class="bloco-info">
                    <p class="label">Observações:</p>
                    <p class="texto"><?= nl2br(htmlspecialchars($EditalInterno->observacoes)) ?></p>
                </div>

                <div class="bloco-info">
                    <p class="label">Descrição completa:</p>
                    <p class="texto"><?= nl2br(htmlspecialchars($EditalInterno->descCompleta)) ?></p>
                </div>


                <?php if ($EditalInterno->status === "Aberto"): ?>
                    <a href="cadInscricaoEdital.php?id=<?= $EditalInterno->idEditalInterno ?>" class="btn-inscricao">
                        Inscrever-se neste Edital
                    </a>
                <?php endif; ?>
            </section>

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