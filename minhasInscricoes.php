<?php
require_once __DIR__ . "/verifica_acesso.php";

spl_autoload_register(function ($class) {
    require_once __DIR__ . "/Classes/{$class}.class.php";
});

$idUsuario = $_SESSION['idUsuario'];

// Busca todas as inscrições e filtra pelo usuário logado
$inscricaoObj = new InscricaoEdital();
$editalObj = new EditalInterno();

$minhasInscricoes = array_filter($inscricaoObj->searchAll(), function ($i) use ($idUsuario) {
    return $i->fk_usuario == $idUsuario;
});
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/base.css">
    <title>Minhas Inscrições</title>
</head>

<body>

    <nav>
        <?php include "_parts/_navbar.php"; ?>
    </nav>

    <main class="container mt-4">

        <h3 class="mb-4">Minhas Inscrições</h3>

        <?php if (empty($minhasInscricoes)): ?>
            <div class="alert alert-info">
                Você ainda não possui inscrições realizadas.
            </div>
        <?php else: ?>
            <table class="table table-striped  dataTable">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Edital</th>
                        <th>Título do Projeto</th>
                        <th>Status</th>
                        <th>Enviada em</th>
                        <th>Detalhes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($minhasInscricoes as $i): ?>
                        <tr>
                            <td><?= $i->idInscricao ?></td>
                            <td>
                                <?php
                                $info = $editalObj->search("idEditalInterno", $i->idEditalInterno);
                                echo $info ? htmlspecialchars($info[0]->titulo) : "—";
                                ?>
                            </td>
                            <td><?= htmlspecialchars($i->titulo) ?></td>
                            <td>
                                <?php
                                $status = $i->status ?? 'Em Análise';
                                $class = 'bg-primary';
                                if ($status === 'Aprovado')
                                    $class = 'bg-success';
                                elseif ($status === 'Reprovado')
                                    $class = 'bg-danger';

                                echo "<span class='badge {$class}'>$status</span>";
                                ?>
                            </td>
                            <td><?= date("d/m/Y H:i", strtotime($i->dataInscricao)) ?></td>
                            <td>
                                <a href="inscricaoDetalhes.php?idInscricao=<?= $i->idInscricao ?>" class="btn btn-info btn-sm">
                                    Ver
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

    </main>

    <footer class="mt-5">
        <?php include "_parts/_footer.php"; ?>
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