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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/baseSite.css">
    <title>Meus Projetos</title>
</head>

<body>
    <navbar>
        <?php require_once "_parts/_navbar.php"; ?>
    </navbar>

    <main class="container mt-3">
        <div class="mt-5">
            <h3>Meus Projetos</h3>
        </div>

        <table class="table dataTable">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nome do Projeto</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($meusProjetos): ?>
                    <?php foreach ($meusProjetos as $proj): ?>
                        <tr>
                            <td><?= $proj->id ?></td>
                            <td><?= htmlspecialchars($proj->nomeProjeto) ?></td>
                            <td class="d-flex gap-1 justify-content-center">

                                <form action="cadProjeto.php" method="get" class="d-flex">
                                    <input type="hidden" name="id" value="<?= $proj->id ?>">
                                    <button name="btnEditar" class="btn btn-primary btn-sm" type="submit" title="Editar">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </form>

                                <form action="dbProjeto.php" method="post" class="d-flex">
                                    <input type="hidden" name="id" value="<?= $proj->id ?>">
                                    <button name="btnDeletar" class="btn btn-danger btn-sm" type="submit" title="Excluir"
                                        onclick="return confirm('Tem certeza que deseja excluir este projeto?');">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>

                                <a href="fotoProjeto.php?idProjeto=<?= $proj->id ?>" class="btn btn-outline-success btn-sm"
                                    title="Gerenciar Fotos">
                                    <i class="bi bi-camera"></i>
                                </a>

                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center text-muted">Nenhum projeto cadastrado ainda.</td>
                    </tr>
                <?php endif ?>
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
</body>

</html>