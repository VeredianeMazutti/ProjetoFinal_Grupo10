<?php require_once __DIR__ . "/verifica_acesso.php"; ?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="CSS/baseAdministracao.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="CSS/baseAdministracao.css">
    <link rel="shortcut icon" href="images/logoInnovamind.png" type="image/x-icon">
    <title>Trilhas Educacionais</title>
</head>

<body>

    <navbar>
        <?php require_once "_parts/_navbar.php"; ?>
    </navbar>

    <main class="container my-5">

        <h3 class="titulo-tabelas mb-4">Trilhas Cadastradas</h3>

        <div class="d-flex justify-content-end">
            <a href="cadEducaCoop.php" class="btn btn-administracao mb-4 me-3">
                <i class="bi bi-plus-circle"></i> Nova Trilha
            </a>
        </div>

        <div class="table-responsive">
            <table class="table dataTable">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Título</th>
                        <th class="text-center">Subtítulo</th>
                        <th class="text-center">Nível</th>
                        <th class="text-center">Duração</th>
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
                            <td class="text-center"><?= $trilha->id_trilha ?></td>
                            <td class="text-center"><?= $trilha->titulo ?></td>
                            <td class="text-center"><?= $trilha->subtitulo ?></td>
                            <td class="text-center"><?= $trilha->nivel ?></td>
                            <td class="text-center"><?= $trilha->duracao ?></td>

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

                                <a href="cadAvaliacao.php?id_trilha=<?= $trilha->id_trilha ?>"
                                    class="btn btn-warning btn-sm" title="Editar Avaliação">
                                    <i class="bi bi-check2-square"></i>
                                </a>

                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>

    </main>

    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="JS/paginacao.js"></script>

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