<?php
spl_autoload_register(function ($class) {
    require_once __DIR__ . "/Classes/{$class}.class.php";
});

if (filter_has_var(INPUT_GET, "idProjeto")) {
    $p = new Projeto();
    $idProjeto = intval(filter_input(INPUT_GET, "idProjeto"));
    $projeto = $p->search("id", $idProjeto)[0];
}

$f = new FotoProjeto();
$fotos = $f->fotosProjeto($projeto->id);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/baseAdministracao.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="images/logoInnovamind.png" type="image/x-icon">
    <title>Fotos do Projeto: <?= $projeto->nomeProjeto ?></title>
</head>

<body>
    <navbar>
        <?php require_once "_parts/_navbar.php"; ?>
    </navbar>

    <main class="container my-5">
        <h3 class="titulo-cad">Fotos do Projeto: <?= $projeto->nomeProjeto ?></h3>

        <div class="my-3">
            <a href="cadFotoProjeto.php?idProjeto=<?= $projeto->id ?>" class="btn btn-geral">Nova Foto</a>
            <a href="meusProjetos.php" class="btn-voltar">Voltar para Meus Projetos</a>
        </div>

        <div class="d-flex gap-3 flex-wrap">
            <?php foreach ($fotos as $foto): ?>
                <div class="card" style="width: 18rem;">
                    <img src="uploads/projetos/<?= htmlspecialchars($foto->nome) ?>" class="card-img-top"
                        alt="<?= htmlspecialchars($foto->alternativo) ?>">
                    <div class="card-body">
                        <p class="card-text"><?= $foto->legenda ?></p>

                        <a href="cadFotoProjeto.php?idProjeto=<?= $projeto->id ?>&idFoto=<?= $foto->id_foto ?>"
                            class="btn btn-primary btn-sm">Editar</a>

                        <form action="dbFotoProjeto.php" method="post" class="d-inline">
                            <input type="hidden" name="idFoto" value="<?= $foto->id_foto ?>">
                            <input type="hidden" name="idProjeto" value="<?= $projeto->id ?>">
                            <button type="submit" name="btnDeletar" class="btn btn-danger btn-sm"
                                onclick="return confirm('Deseja excluir esta foto?')">Excluir</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    
    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>

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