<?php
spl_autoload_register(function ($class) {
    require_once "Classes/{$class}.class.php";
});

$id = intval(filter_input(INPUT_GET, "id_trilha"));
$Trilha = new EducaCoop();
$resultado = $Trilha->search("id_trilha", $id);
$trilha = !empty($resultado) ? $resultado[0] : null;

if (!$trilha) {
    echo "<p class='text-center mt-5 text-danger'>Trilha não encontrada.</p>";
    exit;
}

// controle da aba ativa 
$aba = $_GET['aba'] ?? 'apresentacao';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/baseSite.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="images/logoInnovamind.png" type="image/x-icon">
    <title><?= htmlspecialchars($trilha->titulo); ?> - Trilha de Aprendizado</title>
</head>

<body>
    <nav>
        <?php require_once "_parts/_navbar.php"; ?>
    </nav>

    <main class="container my-5">
        <section class="mb-4 text-center">
            <h2 class="fw-bold text-purple"><?= htmlspecialchars($trilha->titulo); ?></h2>
            <p class="fst-italic text-muted"><?= htmlspecialchars($trilha->subtitulo); ?></p>
        </section>

        <ul class="nav nav-tabs" id="trilhaTabs" role="tablist">

            <li class="nav-item" role="presentation">
                <button class="nav-link <?= $aba == 'apresentacao' ? 'active' : '' ?>" id="apresentacao-tab"
                    data-bs-toggle="tab" data-bs-target="#apresentacao" type="button" role="tab">Apresentação da
                    Trilha</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link <?= $aba == 'conteudo' ? 'active' : '' ?>" id="conteudo-tab"
                    data-bs-toggle="tab" data-bs-target="#conteudo" type="button" role="tab">Conteúdo da Trilha</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link <?= $aba == 'avaliacao' ? 'active' : '' ?>" id="avaliacao-tab"
                    data-bs-toggle="tab" data-bs-target="#avaliacao" type="button" role="tab">Avaliação Final</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link <?= $aba == 'referencias' ? 'active' : '' ?>" id="referencias-tab"
                    data-bs-toggle="tab" data-bs-target="#referencias" type="button" role="tab">Referências e
                    Autor</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link <?= $aba == 'certificado' ? 'active' : '' ?>" id="certificado-tab"
                    data-bs-toggle="tab" data-bs-target="#certificado" type="button" role="tab">Certificado</button>
            </li>

        </ul>

        <div class="tab-content shadow-sm rounded-bottom" id="trilhaTabsContent">

            <div class="tab-pane fade <?= $aba == 'apresentacao' ? 'show active' : '' ?> my-4" id="apresentacao"
                role="tabpanel">
                <h5 class="fw-bold mb-3">Introdução</h5>
                <p><?= nl2br(htmlspecialchars($trilha->introducao)); ?></p>

                <h5 class="fw-bold mt-4">Objetivos de Aprendizagem</h5>
                <p><?= nl2br(htmlspecialchars($trilha->objetivos)); ?></p>

                <?php if (!empty($trilha->imagemCapa)): ?>
                    <div class="text-center mt-4">
                        <img src="uploads/trilhas/<?= htmlspecialchars($trilha->imagemCapa); ?>"
                            class="img-fluid rounded shadow-sm" style="max-width: 400px;">
                    </div>
                <?php endif; ?>
            </div>

            <div class="tab-pane fade <?= $aba == 'conteudo' ? 'show active' : '' ?> my-4" id="conteudo"
                role="tabpanel">
                <h5 class="fw-bold mb-3">Conteúdo Principal</h5>
                <p><?= nl2br(htmlspecialchars($trilha->conteudo)); ?></p>
            </div>

            <div class="tab-pane fade <?= $aba == 'avaliacao' ? 'show active' : '' ?> my-4" id="avaliacao"
                role="tabpanel">
                <h5 class="fw-bold mb-3">Avaliação Final</h5>
                <p><strong>Título da Trilha:</strong> <?= htmlspecialchars($trilha->titulo); ?></p>
                <p><strong>Pontuação mínima:</strong> 70%</p>

                <div class="text-center mt-4">
                    <a href="avaliacao.php?id_trilha=<?= $trilha->id_trilha; ?>"
                        class="btn btn-certificado px-4">Iniciar
                        Avaliação</a>
                </div>
            </div>

            <div class="tab-pane fade <?= $aba == 'referencias' ? 'show active' : '' ?> my-4" id="referencias"
                role="tabpanel">
                <h5 class="fw-bold mb-3">Autor</h5>
                <p><strong>Instrutor:</strong> <?= htmlspecialchars($trilha->autorTrilha); ?></p>
                <p><strong>Tags:</strong> <?= htmlspecialchars($trilha->tagsTrilha); ?></p>

                <h5 class="fw-bold mt-4">Referências</h5>
                <p><?= nl2br(htmlspecialchars($trilha->referenciasTrilha)); ?></p>
            </div>

            <div class="tab-pane fade <?= $aba == 'certificado' ? 'show active' : '' ?> my-4" id="certificado"
                role="tabpanel">

                <?php
                if (!isset($_SESSION['nomeUsuario'])) {
                    echo "<div class='alert alert-warning text-center'>
            Faça login para ver seu certificado.
          </div>";
                } else {
                    $usuario = $_SESSION['nomeUsuario'];
                    $idTrilhaAtual = $trilha->id_trilha;

                    $db = (new EducaCoop())->getDB();

                    $sql = "SELECT certificado, nota 
            FROM trilha_usuario 
            WHERE id_trilha = :id AND nome_usuario = :usuario
            LIMIT 1";


                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':id', $idTrilhaAtual, PDO::PARAM_INT);
                    $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
                    $stmt->execute();

                    $registro = $stmt->fetch(PDO::FETCH_OBJ);

                    if ($registro && !empty($registro->certificado)) {
                        echo "
                            <div class='text-center'>
                                <h5 class='text-certificado fw-bold'>🎉 Certificado disponível!</h5>
                                <p>Sua nota: <strong>{$registro->nota}%</strong></p>
                                <a href='{$registro->certificado}' download 
                                   class='btn btn-certificado'>
                                   Baixar Certificado
                                </a>
                            </div>
                        ";
                    } else {
                        echo "
                            <div class='alert alert-info text-center'>
                                Você ainda não concluiu a trilha ou o certificado não foi gerado.
                            </div>
                        ";
                    }
                }
                ?>

            </div>
        </div>

        <div class="text-center mt-5">
            <a href="EducaCoop.php" class="btn btn-outline-purple px-5">
                <i class="bi bi-arrow-left-circle me-2"></i>Voltar para Trilha
            </a>
        </div>
    </main>

    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Botão do VLibras -->
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>

    <!-- Script do VLibras -->
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>

</body>

</html>