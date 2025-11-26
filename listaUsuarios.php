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

    <title>Usuários</title>
</head>

<body>
    <navbar>
        <?php require_once "_parts/_navbar.php"; ?>
    </navbar>

    <main class="container mt-3">
        <div class="mt-5">
            <h3>Usuários</h3>
        </div>

        <table class="table dataTable">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                spl_autoload_register(function ($class) {
                    require_once __DIR__ . "/Classes/{$class}.class.php";
                });

                $usuarioObj = new Usuario();
                $usuarios = $usuarioObj->all();

                foreach ($usuarios as $usuario):
                    ?>
                    <tr>
                        <td><?= $usuario->id ?></td>
                        <td><?= $usuario->nomeCompleto ?></td>
                        <td><?= $usuario->email ?></td>
                        <td class="d-flex gap-1 justify-content-center">

                            <form action="cadUsuario.php" method="post" class="d-flex">
                                <input type="hidden" name="id" value="<?= $usuario->id ?>">
                                <button name="btnEditar" class="btn btn-primary btn-sm" type="submit" title="Editar"
                                    onclick="return confirm('Tem certeza que deseja editar este usuário?');">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </form>

                            <form action="dbUsuario.php" method="post" class="d-flex">
                                <input type="hidden" name="id" value="<?= $usuario->id ?>">
                                <button name="btnDeletar" class="btn btn-danger btn-sm" type="submit" title="Deletar"
                                    onclick="return confirm('Tem certeza que deseja deletar este usuário?');">
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
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="JS/paginacao.js"></script>
</body>

</html>