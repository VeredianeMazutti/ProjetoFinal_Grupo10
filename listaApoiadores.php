<?php
require_once __DIR__ . "/verifica_acesso.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/base.css">
    <link rel="icon" href="images/LogoInnovamind.png" type="image/png" sizes="32x32">

    <title>Parceiros</title>
</head>

<body>

    <navbar>
        <?php require_once "_parts/_navbar.php"; ?>
    </navbar>

    <main class="container mt-3">

        <div class="mt-5 d-flex justify-content-between align-items-center">
            <h3>Parceiros Cadastrados</h3>

            <a href="cadApoiador.php" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Novo Parceiro
            </a>
        </div>

        <table class="table dataTable mt-4">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Descrição</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>

            <tbody>
                <?php
                spl_autoload_register(function ($class) {
                    require_once __DIR__ . "/Classes/{$class}.class.php";
                });

                $apo = new Apoiadores();
                $lista = $apo->listar();

                foreach ($lista as $a):
                    ?>
                    <tr>
                        <td><?= $a->idApoiadores ?></td>
                        <td><?= htmlspecialchars($a->nome) ?></td>
                        <td><?= ucfirst($a->tipo) ?></td>
                        <td><?= substr($a->descricao, 0, 60) ?>...</td>

                        <td class="d-flex gap-1 justify-content-center">

                            <form action="cadApoiadores.php" method="get" class="d-flex">
                                <input type="hidden" name="id" value="<?= $a->idApoiadores ?>">
                                <button class="btn btn-primary btn-sm" type="submit" title="Editar"
                                    onclick="return confirm('Editar este parceiro?');">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </form>

                            <form action="dbApoiadores.php" method="post" class="d-flex">
                                <input type="hidden" name="idApoiadores" value="<?= $a->idApoiadores ?>">
                                <button name="btnDeletar" class="btn btn-danger btn-sm" type="submit" title="Excluir"
                                    onclick="return confirm('Tem certeza que deseja excluir este parceiro?');">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>

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
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="JS/paginacao.js"></script>

</body>

</html>