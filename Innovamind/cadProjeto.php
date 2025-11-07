<?php require_once __DIR__ . "/verifica_acesso.php"; ?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/base.css">
    <link rel="shortcut icon" href="images/LogoInnovamind.png" type="image/x-icon">
    <title>Cadastro de Projetos</title>
</head>

<body>
    <navbar>
        <?php require_once "_parts/_navbar.php"; ?>
    </navbar>

    <main class="container mt-4">
        <?php
        spl_autoload_register(function ($class) {
            require_once __DIR__ . "/Classes/{$class}.class.php";
        });


        $projeto = null;

        if (filter_has_var(INPUT_POST, "btnEditar") || filter_has_var(INPUT_GET, "id")) {
            $edtProjeto = new Projeto();
            $id = intval(filter_input(INPUT_POST, "id") ?: filter_input(INPUT_GET, "id"));
            $projeto = $edtProjeto->search("id", $id)[0];
        }
        ?>

        <h2 class="text-center">Cadastre seu Projeto e Conecte-se</h2>

        <form action="dbProjeto.php" method="post" class="row g3 mt-3">
            <input type="hidden" value="<?php echo $projeto->id ?? ''; ?>" name="id">

            <div class="col-12">
                <label for="nomeProjeto" class="form-label">Nome do Projeto</label>
                <input type="text" name="nomeProjeto" id="nomeProjeto" placeholder="Digite o nome do projeto" required
                    class="form-control" value="<?php echo $projeto->nomeProjeto ?? ''; ?>">
            </div>

            <div class="col-12">
                <label for="nomeResponsavel" class="form-label">Nome do Responsável</label>
                <input type="text" name="nomeResponsavel" id="nomeResponsavel"
                    placeholder="Digite o nome do responsável principal" required class="form-control"
                    value="<?php echo $projeto->nomeResponsavel ?? ''; ?>">
            </div>

            <div class="col-12">
                <label for="nomeColaboradores" class="form-label">Nome dos Colaboradores e a Respectiva Área de
                    Atuação</label>
                <textarea name="nomeColaboradores" id="nomeColaboradores"
                    placeholder="Digite o nome dos colaboradores e a área de atuação, se houver" required
                    class="form-control"><?php echo $projeto->nomeColaboradores ?? ''; ?></textarea>
            </div>

            <div class="col-12">
                <label for="nomeInstituicao" class="form-label">Nome da Instituição Responsável</label>
                <input type="text" name="nomeInstituicao" id="nomeInstituicao"
                    placeholder="Digite o nome da Instituição responsável, se houver" required class="form-control"
                    value="<?php echo $projeto->nomeInstituicao ?? ''; ?>">
            </div>

            <div class="col-12">
                <label for="emailProjeto" class="form-label">Digite o E-mail para Contato</label>
                <input type="text" name="emailProjeto" id="emailProjeto" placeholder="Digite um e-mail para contato"
                    required class="form-control" value="<?php echo $projeto->emailProjeto ?? ''; ?>">
            </div>

            <div class="col-12">
                <label for="localizacaoEstado" class="form-label">Estado de desenvolvimento do projeto</label>
                <input type="text" name="localizacaoEstado" id="localizacaoEstado"
                    placeholder="Digite o nome do estado de desenvolvimento do projeto" required class="form-control"
                    value="<?php echo $projeto->localizacaoEstado ?? ''; ?>">
            </div>

            <div class="col-12">
                <label for="categoria" class="form-label">Categoria do projeto</label>
                <select name="categoria" class="form-select" id="categoria" required>
                    <option value="" disabled selected>Selecione a Categoria</option>
                    <option value="sustentabilidade" <?= ($projeto->categoria ?? '') == 'sustentabilidade' ? 'selected' : '' ?>>Sustentabilidade e Meio Ambiente</option>
                    <option value="educacao" <?= ($projeto->categoria ?? '') == 'educacao' ? 'selected' : '' ?>>Educação e
                        Capacitação</option>
                    <option value="tecnologia" <?= ($projeto->categoria ?? '') == 'tecnologia' ? 'selected' : '' ?>>
                        Tecnologia e Inovação</option>
                    <option value="impacto_social" <?= ($projeto->categoria ?? '') == 'impacto_social' ? 'selected' : '' ?>>Impacto Social e Comunidade</option>
                    <option value="saude" <?= ($projeto->categoria ?? '') == 'saude' ? 'selected' : '' ?>>Saúde e Bem-Estar
                    </option>
                    <option value="cultura" <?= ($projeto->categoria ?? '') == 'cultura' ? 'selected' : '' ?>>Cultura e
                        Artes</option>
                    <option value="empreendedorismo" <?= ($projeto->categoria ?? '') == 'empreendedorismo' ? 'selected' : '' ?>>Empreendedorismo e Negócios</option>
                    <option value="cidadania" <?= ($projeto->categoria ?? '') == 'cidadania' ? 'selected' : '' ?>>Cidadania
                        Global e Futuro</option>
                    <option value="comunicacao" <?= ($projeto->categoria ?? '') == 'comunicacao' ? 'selected' : '' ?>>
                        Comunicação e Mídia</option>
                    <option value="economia" <?= ($projeto->categoria ?? '') == 'economia' ? 'selected' : '' ?>>Economia e
                        Mercado</option>
                    <option value="ciencias" <?= ($projeto->categoria ?? '') == 'ciencias' ? 'selected' : '' ?>>Ciências e
                        Pesquisa</option>
                    <option value="entretenimento" <?= ($projeto->categoria ?? '') == 'entretenimento' ? 'selected' : '' ?>>Entretenimento e Experiências</option>
                    <option value="sociedade" <?= ($projeto->categoria ?? '') == 'sociedade' ? 'selected' : '' ?>>Sociedade
                        e Políticas</option>
                    <option value="outras" <?= ($projeto->categoria ?? '') == 'outras' ? 'selected' : '' ?>>Outras</option>
                </select>
            </div>

            <div class="col-12">
                <label for="breveDescricao" class="form-label">Breve Descrição do Projeto</label>
                <textarea name="breveDescricao" id="breveDescricao"
                    placeholder="Digite uma descrição de no máximo 250 caracteres" required class="form-control"
                    maxlength="250"><?php echo $projeto->breveDescricao ?? ''; ?></textarea>
            </div>

            <div class="col-12">
                <label for="faseDesenvolvimento" class="form-label">Fase de Desenvolvimento</label>
                <select name="faseDesenvolvimento" class="form-select" id="faseDesenvolvimento" required>
                    <option value="" disabled selected>Selecione a Fase de Desenvolvimento</option>
                    <option value="ideia" <?= ($projeto->faseDesenvolvimento ?? '') == 'ideia' ? 'selected' : '' ?>>Ideia
                    </option>
                    <option value="planejamento" <?= ($projeto->faseDesenvolvimento ?? '') == 'planejamento' ? 'selected' : '' ?>>Planejamento</option>
                    <option value="em_andamento" <?= ($projeto->faseDesenvolvimento ?? '') == 'em_andamento' ? 'selected' : '' ?>>Em andamento</option>
                    <option value="concluido" <?= ($projeto->faseDesenvolvimento ?? '') == 'concluido' ? 'selected' : '' ?>>Concluído</option>
                </select>
            </div>

            <div class="col-12">
                <label for="contribuicao" class="form-label">Qual contribuição é necessária?</label>
                <textarea name="contribuicao" id="contribuicoes" placeholder="Digite a contribuição necessária" required
                    class="form-control"><?php echo $projeto->contribuicao ?? ''; ?></textarea>
            </div>

            <div class="col-12">
                <label for="descricaoDetalhada" class="form-label">Descrição mais detalhada sobre o Projeto</label>
                <textarea name="descricaoDetalhada" id="descricaoDetalhada"
                    placeholder="Digite uma descrição mais detalhada" required
                    class="form-control"><?php echo $projeto->descricaoDetalhada ?? ''; ?></textarea>
            </div>

            <div class="col-12">
                <label for="linksProjeto" class="form-label">Links do Projeto</label>
                <textarea name="linksProjeto" id="linksProjeto"
                    placeholder="Adicione os links relacionados ao projeto, como Instagram, Figma, GitHub ou outros, se houver."
                    required class="form-control"><?php echo $projeto->linksProjeto ?? ''; ?></textarea>
            </div>

            <div class="col-12 mt-3 mb-5">
                <button type="submit" name="btnGravar" class="btn btn-dark">Salvar</button>
            </div>

        </form>
    </main>
    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>