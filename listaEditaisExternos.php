<?php


?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="images/LogoInnovamind.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/baseSite.css">
    <title>Editais Externos</title>
</head>

<body>

<?php require_once "_parts/_navbar.php"; ?>

<div class="container my-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Editais Externos</h2>
        <a href="cadEditalExterno.php" class="btn btn-success">Novo Edital</a>
    </div>

    <div class="table-responsive">
        <table class="table table-dark table-bordered align-middle">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Link</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($lista as $e): ?>
                <tr>
                    <td><?= htmlspecialchars($e->nome) ?></td>
                    <td><?= htmlspecialchars($e->descricao) ?></td>
                    <td><a href="<?= $e->link ?>" target="_blank" class="text-info">Acessar</a></td>

                    <td class="text-center">
                        <form action="cadEditalExterno.php" method="post" class="d-inline">
                            <input type="hidden" name="id" value="<?= $e->id ?>">
                            <button name="btnEditar" class="btn btn-warning btn-sm">Editar</button>
                        </form>

                        <a href="dbEditalExterno.php?acao=deletar&id=<?= $e->id ?>" 
                           onclick="return confirm('Excluir este edital?')" 
                           class="btn btn-danger btn-sm">
                           Excluir
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>

</div>

<?php require_once "_parts/_footer.php"; ?>

</body>
</html>
