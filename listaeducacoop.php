<?php require_once __DIR__ . "/verifica_acesso.php"; ?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/base.css">
    <link rel="icon" href="images/LogoInnovamind.png" type="image/png" sizes="32x32">

    <title>Trilhas Educacionais</title>
</head>

<body>
    <navbar>
        <?php require_once "_parts/_navbar.php"; ?>
    </navbar>

    <main class="container mt-3">

        <div class="d-flex justify-content-between align-items-center mt-5">
            <h3>Trilhas Cadastradas</h3>
            <a href="cadEducaCoop.php" class="btn btn-success">
                <i class="bi bi-plus-lg"></i> Nova Trilha
            </a>
        </div>

        <table class="table dataTable mt-3">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Título</th>
                    <th>Subtítulo</th>
                    <th>Nível</th>
                    <th>Duração</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>

                <?php
                spl_autoload_register(function ($class) {
                    require_once __DIR__ . "/Classes/{$class}.class.php";
                });

                $trilhaObj = new EducaCoop();
                $trilhas = $trilhaObj->all();

                foreach ($trilhas as $trilha):
                    ?>
                    <tr>
                        <td><?= $trilha->id_trilha ?></td>
                        <td><?= $trilha->titulo ?></td>
                        <td><?= $trilha->subtitulo ?></td>
                        <td><?= $trilha->nivel ?></td>
                        <td><?= $trilha->duracao ?></td>

                        <td class="d-flex gap-1 justify-content-center">

                            <form action="cadEducaCoop.php" method="get" class="d-flex">
                                <input type="hidden" name="id" value="<?= $trilha->id_trilha ?>">
                                <button name="btnEditar" class="btn btn-primary btn-sm" type="submit" title="Editar"
                                    onclick="return confirm('Deseja editar esta trilha?');">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </form>

                            <form action="dbEducaCoop.php" method="post" class="d-flex">
                                <input type="hidden" name="id_trilha" value="<?= $trilha->id_trilha ?>">
                                <button name="btnDeletar" class="btn btn-danger btn-sm" type="submit" title="Excluir"
                                    onclick="return confirm('Tem certeza que deseja excluir esta trilha?');">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>

                            <a href="cadAvaliacao.php?id_trilha=<?= $trilha->id_trilha ?>" class="btn btn-warning btn-sm"
                                title="Editar Avaliação">
                                <i class="bi bi-check2-square"></i>
                            </a>

                        </td>
                    </tr>

                <?php endforeach; ?>

            </tbody>
        </table>

    </main>

    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="JS/paginacao.js"></script>

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