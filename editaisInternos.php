<?php
spl_autoload_register(function ($class) {
    require_once "Classes/{$class}.class.php";
});

$Edital = new EditalInterno();
$lista = $Edital->searchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/baseSite.css">
    <link rel="icon" href="images/LogoInnovamind.png" type="image/png">
    <title>Editais</title>

    <style>
        .card-edital {
            border-bottom: 1px solid #ddd;
            padding: 20px 5px;
        }

        .status-aberto {
            color: #1a8c2e;
            font-weight: bold;
        }

        .status-encerrado {
            color: #b60000;
            font-weight: bold;
        }

        .status-analise {
            color: #d49200;
            font-weight: bold;
        }

        .icone {
            color: #2d7a94;
            margin-right: 6px;
        }

        .titulo-edital {
            font-weight: 600;
            font-size: 1.2rem;
        }

        .desc {
            font-size: 0.95rem;
            color: #444;
        }
    </style>
</head>

<body>

    <navbar>
        <?php require_once "_parts/_navbar.php"; ?>
    </navbar>

    <main class="container my-5 efeito-luzes">
        <h2>Editais Internos</h2>

        <?php if (count($lista) == 0): ?>
            <p class="text-muted mt-4">Nenhum edital cadastrado.</p>
        <?php endif; ?>

        <?php foreach ($lista as $Edital): ?>

            <?php
            $statusClass = "";
            if ($Edital->status == "Aberto")
                $statusClass = "status-aberto";
            elseif ($Edital->status == "Encerrado")
                $statusClass = "status-encerrado";
            else
                $statusClass = "status-analise";

            $dataAbertura = date("d/m/y", strtotime($Edital->dataAbertura));
            $horaAbertura = date("H:i", strtotime($Edital->dataAbertura));

            $dataEncerramento = date("d/m/y", strtotime($Edital->dataEncerramento));
            $horaEncerramento = date("H:i", strtotime($Edital->dataEncerramento));
            ?>

            <div class="card-edital">

                <p class="mb-1 <?= $statusClass ?>">
                    <i class="bi bi-check-circle"></i> <?= strtoupper($Edital->status) ?>
                </p>

                <p class="titulo-edital mt-2">
                    <?= htmlspecialchars($Edital->titulo) ?>
                </p>

                <p class="desc">
                    <?= htmlspecialchars($Edital->descResumida) ?>
                </p>

                <p class="small text-secondary mb-1">
                    <strong>Organização responsável:</strong> <?= htmlspecialchars($Edital->organizacao) ?>
                </p>

                <p class="small text-secondary">
                    <strong>De:</strong> <?= $dataAbertura ?> |
                    <strong>Até:</strong> <?= $dataEncerramento ?>
                </p>

                <a href="editalinterno.php?id=<?= $Edital->idEditalInterno ?>" class="btn btn-dark mt-2">
                    Saiba mais
                </a>
            </div>
        <?php endforeach; ?>
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