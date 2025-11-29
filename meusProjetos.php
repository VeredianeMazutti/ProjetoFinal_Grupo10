<?php
require_once __DIR__ . "/verifica_acesso.php";

spl_autoload_register(function ($class) {
    require_once __DIR__ . "/Classes/{$class}.class.php";
});

$idUsuario = $_SESSION['idUsuario'];

$p = new Projeto();
$meusProjetos = $p->search("fk_usuario", $idUsuario);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="CSS/baseAdministracao.css">
    <link rel="shortcut icon" href="images/logoInnovamind.png" type="image/x-icon">
    <title>Meus Projetos</title>
</head>

<body>
    <navbar>
        <?php require_once "_parts/_navbar.php"; ?>
    </navbar>

    <main class="container my-5">
        <h3 class="titulo-tabelas mb-4">Meus Projetos</h3>

        <?php if (empty($meusProjetos)): ?>
            <div class="alert alert-dark">
                Você ainda não possui projetos cadastrados.
            </div>
        <?php else: ?>

            <div class="table-responsive">
                <table class="table dataTable">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">Identificação</th>
                            <th class="text-center">Nome do Projeto</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($meusProjetos as $proj): ?>
                            <tr>
                                <td class="text-center"><?= $proj->id ?></td>
                                <td class="text-center"><?= htmlspecialchars($proj->nomeProjeto) ?></td>
                                <td class="text-center align-middle">
                                    <div class="d-flex justify-content-center align-items-center gap-1">

                                        <form action="cadProjeto.php" method="get" class="d-flex">
                                            <input type="hidden" name="id" value="<?= $proj->id ?>">
                                            <button name="btnEditar" class="btn btn-primary btn-sm" type="submit">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        </form>

                                        <form action="dbProjeto.php" method="post" class="d-flex">
                                            <input type="hidden" name="id" value="<?= $proj->id ?>">
                                            <button name="btnDeletar" class="btn btn-danger btn-sm" type="submit"
                                                onclick="return confirm('Tem certeza que deseja excluir este projeto?');">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>

                                        <a href="fotoProjeto.php?idProjeto=<?= $proj->id ?>"
                                            class="btn btn-outline-success btn-sm">
                                            <i class="bi bi-camera"></i>
                                        </a>

                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php endif; ?>
    </main>

    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.min.js"></script>

    <script src="JS/paginacao.js"></script>

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