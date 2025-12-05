<?php require_once __DIR__ . "/verifica_acesso.php"; ?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/baseAdministracao.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="images/logoInnovamind.png" type="image/x-icon">
    <title>Cadastro de Projetos</title>
</head>

<body>
    <navbar>
        <?php require_once "_parts/_navbar.php"; ?>
    </navbar>

    <main class="cadastro-container my-5">
        <?php
        spl_autoload_register(function ($class) {
            require_once __DIR__ . "/Classes/{$class}.class.php";
        });


        $projeto = null;


        $id =
            filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT)
            ?? filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT)
            ?? filter_input(INPUT_POST, "idProjeto", FILTER_VALIDATE_INT)
            ?? filter_input(INPUT_GET, "idProjeto", FILTER_VALIDATE_INT);

        if (!empty($id)) {
            $edtProjeto = new Projeto();
            $projeto = $edtProjeto->search("id", $id)[0];
        }


        ?>

        <h2 class="titulo-cad text-center">Cadastre seu Projeto e Conecte-se</h2>

        <form action="dbProjeto.php" method="post" class="row g3 mt-3">
            <input type="hidden" value="<?php echo $projeto->id ?? ''; ?>" name="id">

            <div class="col-12">
                <label for="nomeProjeto" class="form-label">Nome do Projeto</label>
                <input type="text" name="nomeProjeto" id="nomeProjeto" placeholder="Digite o nome do projeto" required
                    class="form-control" maxlength="100" value="<?php echo $projeto->nomeProjeto ?? ''; ?>">
            </div>

            <div class="col-12">
                <label for="nomeResponsavel" class="form-label">Nome do Responsável</label>
                <input type="text" name="nomeResponsavel" id="nomeResponsavel"
                    placeholder="Digite o nome do responsável principal" required class="form-control" maxlength="150"
                    value="<?php echo $projeto->nomeResponsavel ?? ''; ?>">
            </div>

            <div class="col-12">
                <label for="nomeColaboradores" class="form-label">Nome dos Colaboradores e a Respectiva Área de
                    Atuação</label>
                <textarea name="nomeColaboradores" id="nomeColaboradores"
                    placeholder="Digite o nome dos colaboradores e a área de atuação, se houver"
                    class="form-control"><?php echo $projeto->nomeColaboradores ?? ''; ?></textarea>
            </div>

            <div class="col-12">
                <label for="nomeInstituicao" class="form-label">Nome da Instituição Responsável</label>
                <input type="text" name="nomeInstituicao" id="nomeInstituicao"
                    placeholder="Digite o nome da Instituição responsável, se houver" class="form-control"
                    maxlength="150" value="<?php echo $projeto->nomeInstituicao ?? ''; ?>">
            </div>

            <div class="col-12">
                <label for="emailProjeto" class="form-label">Digite o E-mail para Contato</label>
                <input type="text" name="emailProjeto" id="emailProjeto" placeholder="Digite um e-mail para contato"
                    required class="form-control" maxlength="100" value="<?php echo $projeto->emailProjeto ?? ''; ?>">
            </div>

            <div class="col-12">
                <label for="localizacaoEstado" class="form-label form-cad">Estado de desenvolvimento do projeto</label>
                <select name="localizacaoEstado" class="form-select" id="localizacaoEstado" required>
                    <option value="" selected disabled>Selecione o Estado</option>
                    <option value="acre" <?= ($projeto->localizacaoEstado ?? '') == 'acre' ? 'selected' : '' ?>>Acre
                    </option>
                    <option value="alagoas" <?= ($projeto->localizacaoEstado ?? '') == 'alagoas' ? 'selected' : '' ?>>
                        Alagoas</option>
                    <option value="amapa" <?= ($projeto->localizacaoEstado ?? '') == 'amapa' ? 'selected' : '' ?>>Amapá
                    </option>
                    <option value="amazonas" <?= ($projeto->localizacaoEstado ?? '') == 'amazonas' ? 'selected' : '' ?>>
                        Amazonas</option>
                    <option value="bahia" <?= ($projeto->localizacaoEstado ?? '') == 'bahia' ? 'selected' : '' ?>>Bahia
                    </option>
                    <option value="ceara" <?= ($projeto->localizacaoEstado ?? '') == 'ceara' ? 'selected' : '' ?>>Ceará
                    </option>
                    <option value="distrito_federal" <?= ($projeto->localizacaoEstado ?? '') == 'distrito_federal' ? 'selected' : '' ?>>Distrito Federal</option>
                    <option value="espirito_santo" <?= ($projeto->localizacaoEstado ?? '') == 'espirito_santo' ? 'selected' : '' ?>>Espírito Santo</option>
                    <option value="goias" <?= ($projeto->localizacaoEstado ?? '') == 'goias' ? 'selected' : '' ?>>Goiás
                    </option>
                    <option value="maranhao" <?= ($projeto->localizacaoEstado ?? '') == 'maranhao' ? 'selected' : '' ?>>
                        Maranhão</option>
                    <option value="mato_grosso" <?= ($projeto->localizacaoEstado ?? '') == 'mato_grosso' ? 'selected' : '' ?>>Mato Grosso</option>
                    <option value="mato_grosso_do_sul" <?= ($projeto->localizacaoEstado ?? '') == 'mato_grosso_do_sul' ? 'selected' : '' ?>>Mato Grosso do Sul</option>
                    <option value="minas_gerais" <?= ($projeto->localizacaoEstado ?? '') == 'minas_gerais' ? 'selected' : '' ?>>Minas Gerais</option>
                    <option value="para" <?= ($projeto->localizacaoEstado ?? '') == 'para' ? 'selected' : '' ?>>Pará
                    </option>
                    <option value="paraiba" <?= ($projeto->localizacaoEstado ?? '') == 'paraiba' ? 'selected' : '' ?>>
                        Paraíba</option>
                    <option value="parana" <?= ($projeto->localizacaoEstado ?? '') == 'parana' ? 'selected' : '' ?>>Paraná
                    </option>
                    <option value="pernambuco" <?= ($projeto->localizacaoEstado ?? '') == 'pernambuco' ? 'selected' : '' ?>>Pernambuco</option>
                    <option value="piaui" <?= ($projeto->localizacaoEstado ?? '') == 'piaui' ? 'selected' : '' ?>>Piauí
                    </option>
                    <option value="rio_de_janeiro" <?= ($projeto->localizacaoEstado ?? '') == 'rio_de_janeiro' ? 'selected' : '' ?>>Rio de Janeiro</option>
                    <option value="rio_grande_do_norte" <?= ($projeto->localizacaoEstado ?? '') == 'rio_grande_do_norte' ? 'selected' : '' ?>>Rio Grande do Norte</option>
                    <option value="rio_grande_do_sul" <?= ($projeto->localizacaoEstado ?? '') == 'rio_grande_do_sul' ? 'selected' : '' ?>>Rio Grande do Sul</option>
                    <option value="rondonia" <?= ($projeto->localizacaoEstado ?? '') == 'rondonia' ? 'selected' : '' ?>>
                        Rondônia</option>
                    <option value="roraima" <?= ($projeto->localizacaoEstado ?? '') == 'roraima' ? 'selected' : '' ?>>
                        Roraima</option>
                    <option value="santa_catarina" <?= ($projeto->localizacaoEstado ?? '') == 'santa_catarina' ? 'selected' : '' ?>>Santa Catarina</option>
                    <option value="sao_paulo" <?= ($projeto->localizacaoEstado ?? '') == 'sao_paulo' ? 'selected' : '' ?>>
                        São Paulo</option>
                    <option value="sergipe" <?= ($projeto->localizacaoEstado ?? '') == 'sergipe' ? 'selected' : '' ?>>
                        Sergipe</option>
                    <option value="tocantins" <?= ($projeto->localizacaoEstado ?? '') == 'tocantins' ? 'selected' : '' ?>>
                        Tocantins</option>
                </select>
            </div>

            <div class="col-12">
                <label for="categoria" id="categoria" class="form-label">Categoria do projeto</label>
                <select name="categoria" class="form-select" id="categoria" required>
                    <option value="" selected disabled>Selecione a Categoria</option>
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
                <input type="text" name="breveDescricao" id="breveDescricao"
                    placeholder="Digite uma descrição de no máximo 150 caracteres" class="form-control" minlength="100"
                    maxlength="150" value="<?php echo $projeto->breveDescricao ?? ''; ?>">
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
                    placeholder="Digite uma descrição completa do projeto: objetivo, poblema que busca resolver, público-alvo, etapas, ferramentas utilizadas e qualquer informação relevante"
                    required class="form-control"><?php echo $projeto->descricaoDetalhada ?? ''; ?></textarea>
            </div>

            <div class="col-12">
                <label for="linksProjeto" class="form-label">Links do Projeto</label>
                <textarea name="linksProjeto" id="linksProjeto" placeholder="Cole uma ou mais URLs, cada uma em uma nova linha. Ex: 
                https://instagram.com/seuprojeto
                https://figma.com/seuarquivo
                https://github.com/usuario/repo"
                    class="form-control"><?php echo $projeto->linksProjeto ?? ''; ?></textarea>
            </div>

            <div class="col-12 mt-3 mb-5">
                <button type="submit" name="btnGravar" class="btn-cad">Salvar</button>
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