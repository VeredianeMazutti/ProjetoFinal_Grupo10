<?php
spl_autoload_register(function ($class) {
    require_once __DIR__ . "/Classes/{$class}.class.php";
});

$idTrilha = filter_input(INPUT_GET, "id_trilha", FILTER_VALIDATE_INT);

if ($idTrilha) {
    $trilha = new EducaCoop();
    $resultado = $trilha->search("id_trilha", $idTrilha);

    if ($resultado && count($resultado) > 0) {
        $trilhaData = $resultado[0];
    } else {
        echo "<script>alert('Trilha não encontrada.');window.location.href='trilhas.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Trilha não definida.');window.location.href='trilhas.php';</script>";
    exit;
}

$perguntasSalvas = [];

if (!empty($trilhaData->perguntasTrilha)) {
    $perguntasSalvas = json_decode($trilhaData->perguntasTrilha, true);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $perguntas = [];

    for ($i = 1; $i <= 10; $i++) {
        $pergunta = trim($_POST["pergunta_$i"] ?? '');
        if ($pergunta === '')
            continue;

        $alternativas = [
            trim($_POST["alt_{$i}_1"] ?? ''),
            trim($_POST["alt_{$i}_2"] ?? ''),
            trim($_POST["alt_{$i}_3"] ?? ''),
            trim($_POST["alt_{$i}_4"] ?? '')
        ];

        $correta = intval($_POST["correta_$i"] ?? -1);

        $perguntas[] = [
            "pergunta" => $pergunta,
            "alternativas" => $alternativas,
            "correta" => $correta
        ];
    }

    $json = json_encode($perguntas, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

    // Salva JSON no campo perguntasTrilha
    $trilha->updateField("perguntasTrilha", $json, "id_trilha", $idTrilha);

    echo "<script>alert('Avaliação salva com sucesso!');window.location.href='trilha.php?id_trilha={$idTrilha}';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cadastro da Avaliação</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/base.css">
</head>

<body>
    <navbar>
        <?php require_once "_parts/_navbar.php"; ?>
    </navbar>

    <main class="container mt-3">
        <h3>
            <?= htmlspecialchars($trilhaData->titulo) ?>
            - Cadastro da Avaliação
        </h3>

        <form action="" method="POST">

            <?php for ($i = 1; $i <= 10; $i++): ?>

                <?php
                $p = $perguntasSalvas[$i - 1]['pergunta'] ?? "";
                ?>

                <div class="card mb-4">
                    <div class="card-header bg-light">Pergunta <?= $i; ?></div>

                    <div class="card-body">
                        <div class="mb-3">
                            <input type="text"
                                class="form-control"
                                name="pergunta_<?= $i; ?>"
                                placeholder="Digite a pergunta <?= $i; ?>"
                                value="<?= htmlspecialchars($p) ?>">
                        </div>

                        <?php for ($a = 1; $a <= 4; $a++): ?>

                            <?php
                            $alt = $perguntasSalvas[$i - 1]['alternativas'][$a - 1] ?? "";
                            $corretaSalva = $perguntasSalvas[$i - 1]['correta'] ?? -1;
                            ?>

                            <div class="input-group mb-2">
                                <span class="input-group-text"><?= chr(64 + $a); ?></span>

                                <input type="text"
                                    class="form-control"
                                    name="alt_<?= $i; ?>_<?= $a; ?>"
                                    placeholder="Alternativa <?= chr(64 + $a); ?>"
                                    value="<?= htmlspecialchars($alt) ?>">

                                <div class="input-group-text">
                                    <input type="radio"
                                        name="correta_<?= $i; ?>"
                                        value="<?= $a - 1; ?>"
                                        <?= ($corretaSalva == ($a - 1)) ? 'checked' : '' ?>>
                                    <span class="ms-1 small">Correta</span>
                                </div>
                            </div>

                        <?php endfor; ?>
                    </div>
                </div>

            <?php endfor; ?>

            <button type="submit" class="btn btn-success">Salvar Avaliação</button>
            <a href="trilha.php?id_trilha=<?= $trilhaData->id_trilha ?>" class="btn btn-secondary">Voltar</a>
        </form>
    </main>

    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
