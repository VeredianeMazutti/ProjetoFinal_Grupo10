<?php
session_start();

spl_autoload_register(function ($class) {
    require_once __DIR__ . "/Classes/{$class}.class.php";
});

$Inscricao = new InscricaoEdital();

$idEdital = filter_input(INPUT_POST, "idEditalInterno", FILTER_SANITIZE_NUMBER_INT);

if (!$idEdital || $idEdital <= 0):
    echo "<script>
        alert('Edital inválido.');
        window.open(document.referrer,'_self');
    </script>";
    exit;
endif;

if (filter_has_var(INPUT_POST, "btnGravar")):

    $idInscricao = filter_input(INPUT_POST, "idInscricao", FILTER_SANITIZE_NUMBER_INT);

    $Inscricao->setIdInscricao($idInscricao);
    $Inscricao->setIdEditalInterno(filter_input(INPUT_POST, "idEditalInterno", FILTER_SANITIZE_NUMBER_INT));
    $Inscricao->setResponsavel(filter_input(INPUT_POST, "responsavel", FILTER_SANITIZE_STRING));
    $Inscricao->setEmail(filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING));
    $Inscricao->setTelefone(filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_STRING));
    $Inscricao->setInstituicao(filter_input(INPUT_POST, "instituicao", FILTER_SANITIZE_STRING));
    $Inscricao->setTitulo(filter_input(INPUT_POST, "titulo", FILTER_SANITIZE_STRING));
    $Inscricao->setResumo(filter_input(INPUT_POST, "resumo", FILTER_SANITIZE_STRING));
    $Inscricao->setObjetivo(filter_input(INPUT_POST, "objetivo", FILTER_SANITIZE_STRING));
    $Inscricao->setRelato(filter_input(INPUT_POST, "relato", FILTER_SANITIZE_STRING));

    if (empty($idInscricao)):
        $Inscricao->setStatus("Em Análise");
        $novoId = $Inscricao->add();

        if ($novoId) {
            echo "<script>
                alert('Cadastro de inscrição realizado com sucesso.');
                window.location.href='editaisInternos.php';
            </script>";
            exit;
        } else {
            echo "<script>
                alert('Erro ao enviar inscrição.');
                window.open(document.referrer,'_self');
            </script>";
            exit;
        }
    else:
        if ($Inscricao->update("idInscricao", $idInscricao)) {
            echo "<script>
                alert('Inscrição alterada com sucesso.');
                window.location.href='editaisInternos.php';
            </script>";
            exit;
        } else {
            echo "<script>
                alert('Erro ao alterar inscrição.');
                window.open(document.referrer,'_self');
            </script>";
            exit;
        }
    endif;

elseif (filter_has_var(INPUT_POST, "btnDeletar")):

    $idInscricao = filter_input(INPUT_POST, "idInscricao", FILTER_VALIDATE_INT);
    $inscricaoEncontrada = $Inscricao->findById($idInscricao);

    if ($inscricaoEncontrada):
        if ($Inscricao->delete("idInscricao", $idInscricao)) {
            echo "<script>
                alert('Inscrição excluída com sucesso.');
                window.location.href='adminInscricoes.php';
            </script>";
        } else {
            echo "<script>
                alert('Erro ao excluir inscrição.');
                window.open(document.referrer,'_self');
            </script>";
        }
        exit;
    endif;

endif;
?>