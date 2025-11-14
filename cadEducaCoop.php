<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/baseSite.css">
    <title>Cadastro de Trilha</title>
</head>

<body>
    <nav>
        <?php require_once "_parts/_navbar.php"; ?>
    </nav>

    <main class="container my-5">

        <?php
        spl_autoload_register(function ($class) {
            require_once __DIR__ . "/Classes/{$class}.class.php";
        });

        $Trilha = new EducaCoop();
        $id = intval(filter_input(INPUT_GET, "id"));
        $resultado = $Trilha->search("id_trilha", $id);
        $dados = !empty($resultado) ? $resultado[0] : null;
        ?>

        <h2 class="text-center mb-4">Cadastro de Trilha de Aprendizado</h2>

        <form action="dbEducaCoop.php" method="post" enctype="multipart/form-data" class="row g-3">
            <input type="hidden" name="id_trilha" value="<?php echo $dados->id_trilha ?? null; ?>">

            <h4 class="mt-3">Informações Gerais</h4>
            <div class="col-md-6">
                <label for="titulo" class="form-label">Título da Trilha</label>
                <input type="text" class="form-control" id="titulo" name="titulo"
                    placeholder="Ex: Trilha 1 - Criatividade e Inovação" required
                    value="<?php echo $dados->titulo ?? null; ?>">
            </div>

            <div class="col-md-6">
                <label for="subtitulo" class="form-label">Subtítulo / Tema</label>
                <input type="text" class="form-control" id="subtitulo" name="subtitulo"
                    placeholder="Ex: Desenvolva ideias e soluções criativas"
                    value="<?php echo $dados->subtitulo ?? null; ?>">
            </div>

            <div class="col-md-12">
                <label for="descricao" class="form-label">Descrição Resumida</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3"
                    placeholder="Descreva brevemente a trilha..."><?php echo $dados->descricao ?? null; ?></textarea>
            </div>

            <div class="col-md-3">
                <label for="duracao" class="form-label">Duração Estimada</label>
                <input type="text" class="form-control" id="duracao" name="duracao" placeholder="Ex: 2 horas"
                    value="<?php echo $dados->duracao ?? null; ?>">
            </div>

            <div class="col-md-3">
                <label for="nivel" class="form-label">Nível de Dificuldade</label>
                <select id="nivel" name="nivel" class="form-select">
                    <option value="Iniciante" <?= (isset($dados->nivel) && $dados->nivel == 'Iniciante') ? 'selected' : ''; ?>>Iniciante</option>
                    <option value="Intermediário" <?= (isset($dados->nivel) && $dados->nivel == 'Intermediário') ? 'selected' : ''; ?>>Intermediário</option>
                    <option value="Avançado" <?= (isset($dados->nivel) && $dados->nivel == 'Avançado') ? 'selected' : ''; ?>>Avançado</option>
                </select>
            </div>

            <h4 class="mt-4">Conteúdo da Trilha</h4>
            <div class="col-md-12">
                <label for="introducao" class="form-label">Texto de Introdução</label>
                <textarea class="form-control" id="introducao" name="introducao" rows="4"
                    placeholder="Texto introdutório..."><?php echo $dados->introducao ?? null; ?></textarea>
            </div>

            <div class="col-md-12">
                <label for="objetivos" class="form-label">Objetivos de Aprendizagem</label>
                <textarea class="form-control" id="objetivos" name="objetivos" rows="3"
                    placeholder="Liste os objetivos (um por linha)..."><?php echo $dados->objetivos ?? null; ?></textarea>
            </div>

            <div class="col-md-12">
                <label for="conteudo" class="form-label">Conteúdo Principal</label>
                <textarea class="form-control" id="conteudo" name="conteudo" rows="6"
                    placeholder="Insira aqui o conteúdo completo da trilha..."><?php echo $dados->conteudo ?? null; ?></textarea>
            </div>

            <div class="col-md-6">
                <label for="imagemCapa" class="form-label">Imagem de Capa</label>
                <input type="file" class="form-control" name="imagemCapa" id="imagemCapa" accept="image/*">
                <?php if (!empty($dados->imagemCapa)): ?>
                    <div class="mt-2">
                        <img src="uploads/trilhas/<?php echo $dados->imagemCapa; ?>" width="120" alt="Capa">
                    </div>
                <?php endif; ?>
                <input type="hidden" name="imagemAntiga" value="<?php echo $dados->imagemCapa ?? ''; ?>">
            </div>

            <h4 class="mt-4">Configurações Extras</h4>
            <div class="col-md-6">
                <label for="autorTrilha" class="form-label">Autor / Instrutor</label>
                <input type="text" class="form-control" id="autorTrilha" name="autorTrilha"
                    placeholder="Nome do instrutor" value="<?php echo $dados->autorTrilha ?? null; ?>">
            </div>

            <div class="col-md-6">
                <label for="tagsTrilha" class="form-label">Tags / Palavras-chave</label>
                <input type="text" class="form-control" id="tagsTrilha" name="tagsTrilha"
                    placeholder="Ex: criatividade, inovação, liderança"
                    value="<?php echo $dados->tagsTrilha ?? null; ?>">
            </div>

            <div class="col-md-12">
                <label for="referenciasTrilha" class="form-label">Referências Bibliográficas</label>
                <textarea class="form-control" id="referenciasTrilha" name="referenciasTrilha" rows="3"
                    placeholder="Liste aqui as fontes, livros ou links de referência..."><?php echo $dados->referenciasTrilha ?? null; ?></textarea>
            </div>

            <div class="col-12 mt-4 d-flex gap-2">
                <button type="submit" name="btnSalvar" class="btn btn-primary">Salvar Trilha</button>
                <a href="trilhas.php" class="btn btn-outline-secondary">Cancelar</a>
            </div>

            <div class="col-md-6">
                <label for="gerarCertificado" class="form-label">Gerar certificado automaticamente?</label>
                <select id="gerarCertificado" name="gerarCertificado" class="form-select">
                    <option value="0" <?= (isset($dados->gerarCertificado) && $dados->gerarCertificado == 0) ? 'selected' : ''; ?>>Não</option>
                    <option value="1" <?= (isset($dados->gerarCertificado) && $dados->gerarCertificado == 1) ? 'selected' : ''; ?>>Sim</option>
                </select>
            </div>
        </form>
    </main>

    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>