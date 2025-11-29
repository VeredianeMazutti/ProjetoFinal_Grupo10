<?php
session_start();

spl_autoload_register(function ($class) {
    require_once __DIR__ . "/Classes/{$class}.class.php";
});

$Inscricao = new InscricaoEdital();
$edital = new EditalInterno();

if (isset($_POST['updateStatus'])) {
    $idInscricao = intval($_POST['idInscricao']);
    $novoStatus = $_POST['status'];
    
    // Chama apenas o método que atualiza o status
    $Inscricao->updateStatus($idInscricao, $novoStatus);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$lista = $Inscricao->searchAll();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="CSS/baseAdministracao.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Inscrições</title>
</head>

<body>

    <nav>
        <?php include "_parts/_navbar.php"; ?>
    </nav>

    <main class="container my-5">

        <h3 class="titulo-tabelas mb-4 text-center">Inscrições Recebidas</h3>

        <div class="table-responsive">
            <table class="table dataTable">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Edital</th>
                        <th class="text-center">Responsável</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Data</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($lista as $i):
                        $status = $i->status ?: "Em Análise";
                        $class = match ($status) {
                            "Aprovado" => "bg-success",
                            "Reprovado" => "bg-danger",
                            default => "bg-primary"
                        };
                        ?>
                        <tr>
                            <td class="text-center"><?= $i->idInscricao ?></td>

                            <td class="text-center">
                                <?php
                                $info = $edital->search("idEditalInterno", $i->idEditalInterno);
                                echo $info ? $info[0]->titulo : "—";
                                ?>
                            </td>

                            <td class="text-center"><?= $i->responsavel ?></td>
                            <td class="text-center"><?= $i->email ?></td>

                            <td class="text-center">
                                <span class="badge <?= $class ?>"><?= $status ?></span>
                            </td>

                            <td class="text-center">
                                <?= date("d/m/Y H:i", strtotime($i->dataInscricao)) ?>
                            </td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-2">

                                    <a href="inscricaoDetalhes.php?idInscricao=<?= $i->idInscricao ?>"
                                        class="btn btn-info btn-sm">
                                        Ver
                                    </a>

                                    <form method="post" class="d-flex gap-2 align-items-center">
                                        <input type="hidden" name="idInscricao" value="<?= $i->idInscricao ?>">

                                        <select name="status" class="form-select form-select-sm w-auto text-center">
                                            <option <?= $status === 'Em Análise' ? 'selected' : '' ?>>Em Análise</option>
                                            <option <?= $status === 'Aprovado' ? 'selected' : '' ?>>Aprovado</option>
                                            <option <?= $status === 'Reprovado' ? 'selected' : '' ?>>Reprovado</option>
                                        </select>

                                        <button type="submit" name="updateStatus" value="1" class="btn btn-warning btn-sm">
                                            Atualizar
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