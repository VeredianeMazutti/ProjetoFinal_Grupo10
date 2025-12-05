<?php
require_once __DIR__ . "/verifica_acesso.php";

$idEdital = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($idEdital <= 0) {
    echo "Edital inválido.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/logoInnovamind.png" type="image/x-icon">
    <link rel="stylesheet" href="CSS/baseAdministracao.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="CSS/baseAdministracao.css">
    <title>Inscrição no Edital</title>
</head>

<body>
    <navbar>
        <?php require_once "_parts/_navbar.php"; ?>
    </navbar>

    <main class="cadastro-container my-5">

        <?php
        spl_autoload_register(function ($class) {
            require_once "Classes/{$class}.class.php";
        });

        if (filter_has_var(INPUT_POST, "btnEditar")) {
            $ins = new InscricaoEdital();
            $id = intval(filter_input(INPUT_POST, "idInscricao"));
            $inscricao = $ins->search("idInscricao", $id)[0];
        }
        ?>

        <h2 class="titulo-cad text-center">Inscrição no Edital</h2>

        <form action="dbInscricaoEdital.php" method="post" class="row g3 mt-3">

            <input type="hidden" name="idInscricao" value="<?= $inscricao->idInscricao ?? '' ?>">
            <input type="hidden" name="idEditalInterno" value="<?= $idEdital ?>">

            <div class="col-12">
                <label class="form-label">Nome do Responsável pelo Projeto</label>
                <input type="text" class="form-control" name="responsavel" placeholder="Digite o nome"
                    value="<?= $inscricao->responsavel ?? '' ?>" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Digite seu e-mail"
                    value="<?= $inscricao->email ?? '' ?>" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Telefone</label>
                <input type="text" class="form-control" name="telefone" placeholder="(00) 00000-0000"
                    value="<?= $inscricao->telefone ?? '' ?>" required>
            </div>

            <div class="col-12">
                <label class="form-label">Instituição (se houver)</label>
                <input type="text" class="form-control" name="instituicao" placeholder="Digite o nome da instituição"
                    value="<?= $inscricao->instituicao ?? '' ?>">
            </div>

            <h4 class="mt-4">Dados do Projeto</h4>

            <div class="col-12">
                <label class="form-label">Título do Projeto</label>
                <input type="text" class="form-control" name="titulo" placeholder="Digite o título do projeto"
                    value="<?= $inscricao->titulo ?? '' ?>" required>
            </div>

            <div class="col-12">
                <label class="form-label">Resumo</label>
                <textarea class="form-control" name="resumo" rows="3" placeholder="Escreva um pequeno resumo"
                    required><?= $inscricao->resumo ?? '' ?></textarea>
            </div>

            <div class="col-12">
                <label class="form-label">Objetivo</label>
                <textarea class="form-control" name="objetivo" rows="3" placeholder="Explique os objetivos do projeto"
                    required><?= $inscricao->objetivo ?? '' ?></textarea>
            </div>

            <div class="col-12">
                <label class="form-label">Relato de como vencer o edital ajudaria seu projeto</label>
                <textarea class="form-control" name="relato" rows="4"
                    placeholder="Explique como esse edital impactaria seu projeto"
                    required><?= $inscricao->relato ?? '' ?></textarea>
            </div>

            <div class="col-12 mt-3">
                <button type="submit" name="btnGravar" class="btn-cad">
                    Enviar Inscrição
                </button>
            </div>
        </form>

    </main>

    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="JS/formTheme.js"></script>

    <script>
        $(document).ready(function () {
            $('#telefone').mask('(00) 00000-0000');
        });
    </script>

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