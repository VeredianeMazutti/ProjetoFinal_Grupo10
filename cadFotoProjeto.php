<?php
spl_autoload_register(function ($class) {
    require_once __DIR__ . "/Classes/{$class}.class.php";
});

$idProjeto = filter_input(INPUT_GET, "idProjeto", FILTER_VALIDATE_INT);

if ($idProjeto) {
    $p = new Projeto();
    $resultado = $p->search("id", $idProjeto);

    if ($resultado && count($resultado) > 0) {
        $projeto = $resultado[0];
    } else {
        echo "<script>alert('Projeto não encontrado');window.location.href='meusProjetos.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Projeto não definido');window.location.href='meusProjetos.php';</script>";
    exit;
}

$idFoto = filter_input(INPUT_GET, "idFoto", FILTER_VALIDATE_INT);
$legenda = "";
$textoAlt = "";

if ($idFoto) {
    $f = new FotoProjeto();
    $resultadoFoto = $f->search("id_foto", $idFoto);

    if ($resultadoFoto && count($resultadoFoto) > 0) {
        $fotoEdit = $resultadoFoto[0];
        $legenda = $fotoEdit->legenda ?? "";
        $textoAlt = $fotoEdit->alternativo ?? "";
    } else {
        echo "<script>alert('Foto não encontrada');window.location.href='fotoProjeto.php?idProjeto={$idProjeto}';</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/baseAdministracao.css">
    <link rel="shortcut icon" href="images/logoInnovamind.png" type="image/x-icon">
    <title>Cadastrar Foto do Projeto</title>
</head>

<body>
    <navbar>
        <?php require_once "_parts/_navbar.php"; ?>
    </navbar>

    <main class="container mt-3">
        <h3 class="titulo-cad text-center">
            <?= htmlspecialchars($projeto->nomeProjeto) ?>
            - <?= $idFoto ? "Editar Foto" : "Nova Foto" ?>
        </h3>

        <form action="dbFotoProjeto.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="idProjeto" value="<?= $projeto->id ?>">
            <input type="hidden" name="idFoto" value="<?= $idFoto ?>">

            <div class="mb-3">
                <label for="foto" class="form-label">Selecione a Foto</label>
                <input type="file" name="fotoProjeto" id="foto" class="form-control" accept="image/*" <?= $idFoto ? "" : "required" ?>>
            </div>

            <div class="mb-3">
                <label for="legenda" class="form-label">Legenda</label>
                <input type="text" name="legenda" class="form-control" value="<?= htmlspecialchars($legenda) ?>">
            </div>

            <div class="mb-3">
                <label for="textoAlt" class="form-label">Texto Alternativo</label>
                <input type="text" name="textoAlt" class="form-control" value="<?= htmlspecialchars($textoAlt) ?>">
            </div>

            <button type="submit" name="btnGravar" class="btn btn-success">
                <?= $idFoto ? "Atualizar" : "Salvar" ?>
            </button>
            <a href="fotoProjeto.php?idProjeto=<?= $projeto->id ?>" class="btn btn-secondary">Voltar</a>
        </form>
    </main>
    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script src="JS/formTheme.js"></script>

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