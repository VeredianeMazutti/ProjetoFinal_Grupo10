<?php
spl_autoload_register(function ($class) {
    require_once __DIR__ . "/Classes/{$class}.class.php";
});

$idTrilha = filter_input(INPUT_GET, "id_trilha", FILTER_VALIDATE_INT);

if (!$idTrilha) {
    echo "<script>alert('Trilha inválida.');window.location.href='trilhas.php';</script>";
    exit;
}

$Trilha = new EducaCoop();
$resultado = $Trilha->search("id_trilha", $idTrilha);
$trilha = $resultado[0] ?? null;

if (!$trilha) {
    echo "<script>alert('Trilha não encontrada.');window.location.href='trilhas.php';</script>";
    exit;
}

$Trilha->setTitulo($trilha->titulo);
$Trilha->setAutorTrilha($trilha->autorTrilha);
$Trilha->setPontuacaoMinima($trilha->pontuacaoMinima);
$Trilha->setPerguntasTrilha($trilha->perguntasTrilha);



$perguntas = json_decode($trilha->perguntasTrilha ?? '[]', true);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $respostas = $_POST["resposta"] ?? [];
    $acertos = 0;

    foreach ($perguntas as $i => $p) {
        $correta = $p["correta"];
        if (isset($respostas[$i]) && intval($respostas[$i]) === intval($correta)) {
            $acertos++;
        }
    }

    $total = count($perguntas);
    $percentual = $total > 0 ? round(($acertos / $total) * 100) : 0;

    if ($percentual >= intval($trilha->pontuacaoMinima)) {
        echo "<script>alert('Parabéns! Você acertou {$percentual}% e passou na avaliação.');window.location.href='finalizarTrilha.php?id_trilha={$idTrilha}&nota={$percentual}';</script>";
    } else {
        echo "<script>alert('Você fez {$percentual}%. Tente novamente.');window.location.href='avaliacao.php?id_trilha={$idTrilha}';</script>";
    }

    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/baseSite.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="images/logoInnovamind.png" type="image/x-icon">
    <title>Avaliação da Trilha</title>
</head>


<body>

    <nav>
        <?php require_once "_parts/_navbar.php"; ?>
    </nav>

    <main class="container py-4">
        <h3 class="mb-3 text-center"><?= htmlspecialchars($trilha->titulo) ?></h3>
        <p class="text-center"><strong>Pontuação mínima:</strong> <?= htmlspecialchars($trilha->pontuacaoMinima) ?>%</p>

        <?php if (empty($perguntas)): ?>
            <div class="alert alert-warning text-center">
                Nenhuma pergunta cadastrada para esta avaliação.
            </div>
        <?php else: ?>
            <form method="POST">
                <?php foreach ($perguntas as $i => $p): ?>
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <strong>Pergunta <?= $i + 1 ?>:</strong> <?= htmlspecialchars($p["pergunta"]) ?>
                        </div>
                        <div class="card-body">
                            <?php foreach ($p["alternativas"] as $a => $alt): ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="resposta[<?= $i ?>]" value="<?= $a ?>"
                                        id="p<?= $i ?>a<?= $a ?>">
                                    <label class="form-check-label" for="p<?= $i ?>a<?= $a ?>">
                                        <?= chr(65 + $a) ?>) <?= htmlspecialchars($alt) ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="text-center">
                    <button type="submit" class="btn btn-certificado px-4">Salvar Avaliação</button>
                </div>
            </form>
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