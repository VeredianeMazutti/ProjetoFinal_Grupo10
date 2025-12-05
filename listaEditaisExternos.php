<?php
require_once __DIR__ . "/verifica_acesso.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="CSS/baseAdministracao.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="CSS/baseAdministracao.css">
    <link rel="shortcut icon" href="images/logoInnovamind.png" type="image/x-icon">
    <title>Editais Externos</title>
</head>

<body>

    <nav>
        <?php require_once "_parts/_navbar.php"; ?>
    </nav>

    <main class="container my-5">
        <h3 class="titulo-tabelas mb-4">Editais Externos Cadastrados</h3>

        <div class="d-flex justify-content-end">
            <a href="cadEditalExterno.php" class="btn btn-administracao mb-4 me-3">
                <i class="bi bi-plus-circle"></i> Novo Edital Externo
            </a>
        </div>

        <div class="table-responsive">
            <table class="table dataTable">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Nome</th>
                        <th class="text-center">Categoria</th>
                        <th class="text-center">Descrição</th>
                        <th class="text-center">Link</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    spl_autoload_register(function ($class) {
                        require_once __DIR__ . "/Classes/{$class}.class.php";
                    });

                    $apo = new EditalExterno();
                    $lista = $apo->listar();

                    foreach ($lista as $a):
                        ?>
                        <tr>
                            <td class="text-center"><?= $a->idEditalExterno ?></td>
                            <td class="text-center"><?= htmlspecialchars($a->nome) ?></td>
                            <td class="text-center"><?= ucfirst($a->categoria) ?></td>
                            <td class="text-center"><?= ucfirst($a->descricao) ?></td>
                            <td class="text-center"><?= ucfirst($a->link) ?></td>

                            <td class="text-center">
                                <div class="d-flex gap-1 justify-content-center">
                                    <form action="cadEditalExterno.php" method="get" class="d-inline">
                                        <input type="hidden" name="idEditalExterno" value="<?= $a->idEditalExterno ?>">
                                        <button class="btn btn-primary btn-sm" type="submit" title="Editar"
                                            onclick="return confirm('Editar este parceiro?');">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </form>

                                    <form action="dbEditalExterno.php" method="post" class="d-inline">
                                        <input type="hidden" name="idEditalExterno" value="<?= $a->idEditalExterno ?>">
                                        <button name="btnDeletar" class="btn btn-danger btn-sm" type="submit"
                                            title="Excluir"
                                            onclick="return confirm('Tem certeza que deseja excluir este parceiro?');">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
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