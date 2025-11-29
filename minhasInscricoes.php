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
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="CSS/baseAdministracao.css">
    <link rel="shortcut icon" href="images/logoInnovamind.png" type="image/x-icon">
    <title>Minhas Inscrições</title>
</head>

<body>

    <nav>
        <?php include "_parts/_navbar.php"; ?>
    </nav>

    <main class="container my-5">

        <h3 class="titulo-tabelas mb-4">Minhas Inscrições</h3>

        <?php if (empty($minhasInscricoes)): ?>
            <div class="alert alert-dark">
                Você ainda não possui inscrições realizadas.
            </div>
        <?php else: ?>

            <div class="table-responsive">
                <table class="table dataTable">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">Nome do Edital</th>
                            <th class="text-center">Nome do Projeto</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Enviada em</th>
                            <th class="text-center">Detalhes</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($minhasInscricoes as $i): ?>
                            <tr>
                                <td class="text-center">
                                    <?php
                                    $info = $editalObj->search("idEditalInterno", $i->idEditalInterno);
                                    echo $info ? htmlspecialchars($info[0]->titulo) : "—";
                                    ?>
                                </td>

                                <td class="text-center"><?= htmlspecialchars($i->titulo) ?></td>

                                <td class="text-center">
                                    <?php
                                    $status = $i->status ?? 'Em Análise';
                                    $class = 'badge-status';

                                    if ($status === 'Aprovado') {
                                        $class .= ' badge-aprovado';
                                    } elseif ($status === 'Reprovado') {
                                        $class .= ' badge-reprovado';
                                    } else {
                                        $class .= ' badge-analise';
                                    }

                                    echo "<span class='{$class}'>$status</span>";
                                    ?>
                                </td>

                                <td class="text-center">
                                    <?= date("d/m/Y H:i", strtotime($i->dataInscricao)) ?>
                                </td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <a href="inscricaoDetalhes.php?idInscricao=<?= $i->idInscricao ?>" class="btn btn-ver">
                                            Verificar
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

    <footer class="mt-5">
        <?php include "_parts/_footer.php"; ?>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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