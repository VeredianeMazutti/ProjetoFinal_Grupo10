<?php
spl_autoload_register(function ($class) {
    require_once "Classes/{$class}.class.php";
});

$EditalExterno = new EditalExterno();
$lista = $EditalExterno->listar();

// Organizar por categoria
$categorias = [];
foreach ($lista as $item) {
    $categorias[$item->categoria][] = $item;
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
    <title>Editais Externos</title>
</head>

<body class="text-light">

    <nav><?php require_once "_parts/_navbar.php"; ?></nav>

    <main class="container my-5">

        <div class="text-center mb-5">
            <h1 class="titulo-editais">Editais Externos</h1>
            <p class="subtitulo-editais">Oportunidades reais para projetos, bolsas, inovação e impacto social.</p>
        </div>

        <?php if (empty($lista)): ?>
            <div class="alert alert-warning text-center">
                Nenhum edital cadastrado no momento.
            </div>
        <?php else: ?>

            <?php foreach ($categorias as $categoria => $editais): ?>

                <h3 class="categoria-titulo"><?= htmlspecialchars($categoria) ?></h3>

                <div class="row g-4">

                    <?php foreach ($editais as $edital): ?>
                        <div class="col-md-4">
                            <div class="card-editais shadow">

                                <h5 class="titulo-edital"><?= htmlspecialchars($edital->nome) ?></h5>

                                <p><?= htmlspecialchars($edital->descricao) ?></p>

                                <a href="<?= htmlspecialchars($edital->link) ?>" target="_blank" class="btn btn-acessar">
                                    Acessar
                                </a>

                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>

            <?php endforeach; ?>

        <?php endif; ?>

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

    </main>

</body>

</html>