<?php
session_start();

spl_autoload_register(function ($class) {
    require_once __DIR__ . "/Classes/{$class}.class.php";
});

$Projeto = new Projeto();

if (filter_has_var(INPUT_POST, "btnGravar")):
    $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);

    $Projeto->setNomeProjeto(filter_input(INPUT_POST, "nomeProjeto", FILTER_SANITIZE_STRING));
    $Projeto->setNomeResponsavel(filter_input(INPUT_POST, "nomeResponsavel", FILTER_SANITIZE_STRING));
    $Projeto->setNomeColaboradores(filter_input(INPUT_POST, "nomeColaboradores", FILTER_SANITIZE_STRING));
    $Projeto->setNomeInstituicao(filter_input(INPUT_POST, "nomeInstituicao", FILTER_SANITIZE_STRING));
    $Projeto->setEmailProjeto(filter_input(INPUT_POST, "emailProjeto", FILTER_SANITIZE_STRING));
    $Projeto->setLocalizacaoEstado(filter_input(INPUT_POST, "localizacaoEstado", FILTER_SANITIZE_STRING));
    $Projeto->setCategoria(filter_input(INPUT_POST, "categoria", FILTER_SANITIZE_STRING));
    $Projeto->setBreveDescricao(filter_input(INPUT_POST, "breveDescricao", FILTER_SANITIZE_STRING));
    $Projeto->setFaseDesenvolvimento(filter_input(INPUT_POST, "faseDesenvolvimento", FILTER_SANITIZE_STRING));
    $Projeto->setContribuicao(filter_input(INPUT_POST, "contribuicao", FILTER_SANITIZE_STRING));
    $Projeto->setDescricaoDetalhada(filter_input(INPUT_POST, "descricaoDetalhada", FILTER_SANITIZE_STRING));
    $Projeto->setlinksProjeto(filter_input(INPUT_POST, "linksProjeto", FILTER_SANITIZE_STRING));
    $Projeto->setVisualizacoes(0);
    $Projeto->setFkUsuario($_SESSION['idUsuario']);

    if (empty($id)):
        if ($Projeto->add()) {
            $idNovoProjeto = $Projeto->lastInsertId();
            echo "<script>
                alert('Cadastro de projeto realizado com sucesso.');
                window.location.href='cadFotoProjeto.php?idProjeto=$idNovoProjeto';
            </script>";
        } else {
            echo "<script>
                alert('Erro ao cadastrar o projeto.');
                window.open(document.referrer,'_self');
            </script>";
        }
    else:
        if ($Projeto->update('id', $id)) {
            echo "<script>
                alert('Projeto alterado com sucesso.');
                window.location.href='meusProjetos.php';
            </script>";
        } else {
            echo "<script>
                alert('Erro ao alterar o projeto.');
                window.open(document.referrer,'_self');
            </script>";
        }
    endif;

elseif (filter_has_var(INPUT_POST, "btnDeletar")):
    $id = intval(filter_input(INPUT_POST, "id"));
    if ($Projeto->delete("id", $id)) {
        header("location: meusProjetos.php");
    } else {
        echo "<script>
            alert('Erro ao excluir');
            window.open(document.referrer, '_self');
        </script>";
    }
endif;
