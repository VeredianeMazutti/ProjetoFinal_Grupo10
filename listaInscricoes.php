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
    <title>Inscrições</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/base.css">
</head>

<body>

    <nav>
        <?php include "_parts/_navbar.php"; ?>
    </nav>

    <main class="container mt-4">

        <h3>Inscrições Recebidas</h3>

        <table class="table table-striped mt-3">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Edital</th>
                    <th>Responsável</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Data</th>
                    <th>Ações</th>
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
                        <td><?= $i->idInscricao ?></td>

                        <td>
                            <?php
                            $info = $edital->search("idEditalInterno", $i->idEditalInterno);
                            echo $info ? $info[0]->titulo : "—";
                            ?>
                        </td>

                        <td><?= $i->responsavel ?></td>
                        <td><?= $i->email ?></td>

                        <td><span class="badge <?= $class ?>"><?= $status ?></span></td>

                        <td><?= date("d/m/Y H:i", strtotime($i->dataInscricao)) ?></td>

                        <td class="text-center">
                            <a href="inscricaoDetalhes.php?idInscricao=<?= $i->idInscricao ?>"
                                class="btn btn-info btn-sm me-1">
                                Ver
                            </a>

                            <form method="post" class="d-inline">
                                <input type="hidden" name="idInscricao" value="<?= $i->idInscricao ?>">

                                <select name="status" class="form-select form-select-sm d-inline w-auto">
                                    <option <?= $status === 'Em Análise' ? 'selected' : '' ?>>Em Análise</option>
                                    <option <?= $status === 'Aprovado' ? 'selected' : '' ?>>Aprovado</option>
                                    <option <?= $status === 'Reprovado' ? 'selected' : '' ?>>Reprovado</option>
                                </select>

                                <button type="submit" name="updateStatus" value="1" class="btn btn-warning btn-sm">
                                    Atualizar
                                </button>
                            </form>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </main>

    <footer class="mt-5">
        <?php include "_parts/_footer.php"; ?>
    </footer>

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