<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/baseAdministracao.css">
    <link rel="shortcut icon" href="images/logoInnovamind.png" type="image/x-icon">
    <title>Cadastrar Edital</title>
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

        if (!empty($_POST['idEditalInterno'])) {
            $edt = new EditalInterno();
            $idEditalInterno = intval($_POST['idEditalInterno']);
            $edital = $edt->findByIdEditalInterno($idEditalInterno);
        }

        ?>

        <h2 class="titulo-cad text-center">Cadastrar Edital Interno</h2>
        <form action="dbEditalInterno.php" method="post" class="row g3 mt-3">

            <input type="hidden" value="<?= $edital->idEditalInterno ?? ''; ?>" name="idEditalInterno">

            <div class="col-12">
                <label class="form-label">Título</label>
                <input type="text" class="form-control" name="titulo" placeholder="Digite o título do edital"
                    value="<?= $edital->titulo ?? '' ?>" required>
            </div>

            <div class="col-12">
                <label class="form-label">Descrição Resumida</label>
                <textarea class="form-control" name="descResumida" rows="2" placeholder="Breve resumo do edital"
                    required><?= $edital->descResumida ?? '' ?></textarea>
            </div>

            <div class="col-12">
                <label class="form-label">Descrição Completa</label>
                <textarea class="form-control" name="descCompleta" rows="5" placeholder="Descrição completa do edital"
                    required><?= $edital->descCompleta ?? '' ?></textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label">Organização Responsável</label>
                <input type="text" class="form-control" name="organizacao" placeholder="Nome da instituição responsável"
                    value="<?= $edital->organizacao ?? '' ?>" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Tipo de Apoio</label>
                <input type="text" class="form-control" name="tipoApoio"
                    placeholder="Ex: financeiro, mentoria, incubação..." value="<?= $edital->tipoApoio ?? '' ?>"
                    required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Data de Abertura</label>
                <input type="date" class="form-control" name="dataAbertura" value="<?= $edital->dataAbertura ?? '' ?>"
                    required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Data de Encerramento</label>
                <input type="date" class="form-control" name="dataEncerramento"
                    value="<?= $edital->dataEncerramento ?? '' ?>" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Status</label>
                <select class="form-select" name="status" required>
                    <option value="">Selecione...</option>
                    <option value="Aberto" <?= (isset($edital->status) && $edital->status == "Aberto") ? "selected" : "" ?>>Aberto</option>
                    <option value="Encerrado" <?= (isset($edital->status) && $edital->status == "Encerrado") ? "selected" : "" ?>>Encerrado</option>
                    <option value="Em análise" <?= (isset($edital->status) && $edital->status == "Em análise") ? "selected" : "" ?>>Em análise</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Quantidade de Vagas</label>
                <input type="number" class="form-control" name="vagas" placeholder="Digite o número de vagas"
                    value="<?= $edital->vagas ?? '' ?>" required>
            </div>

            <div class="col-12">
                <label class="form-label">Critérios de Avaliação</label>
                <textarea class="form-control" name="criterios" rows="3"
                    placeholder="Explique como os projetos serão avaliados"
                    required><?= $edital->criterios ?? '' ?></textarea>
            </div>

            <div class="col-12">
                <label class="form-label">Quem Pode Participar</label>
                <textarea class="form-control" name="participantes" rows="3" placeholder="Defina o público elegível"
                    required><?= $edital->participantes ?? '' ?></textarea>
            </div>

            <div class="col-12">
                <label class="form-label">Etapas do Processo (Cronograma)</label>
                <textarea class="form-control" name="etapas" rows="4"
                    placeholder="Descreva as etapas e datas"><?= $edital->etapas ?? '' ?></textarea>
            </div>

            <div class="col-12">
                <label class="form-label">Benefícios Oferecidos</label>
                <textarea class="form-control" name="beneficios" rows="3"
                    placeholder="Benefícios para os selecionados"><?= $edital->beneficios ?? '' ?></textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label">Responsável pelo Edital</label>
                <input type="text" class="form-control" name="responsavel" placeholder="Nome do responsável"
                    value="<?= $edital->responsavel ?? '' ?>">
            </div>

            <div class="col-md-6">
                <label class="form-label">Contato para Dúvidas</label>
                <input type="text" class="form-control" name="contato" placeholder="E-mail ou telefone"
                    value="<?= $edital->contato ?? '' ?>">
            </div>

            <div class="col-12">
                <label class="form-label">Observações</label>
                <textarea class="form-control" name="observacoes" rows="3"
                    placeholder="Observações adicionais"><?= $edital->observacoes ?? '' ?></textarea>
            </div>

            <div class="col-12 mt-3">
                <button type="submit" name="btnGravar" class="btn-cad">Salvar Edital</button>
            </div>

        </form>
    </main>

    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script src="JS/formTheme.js"></script>

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