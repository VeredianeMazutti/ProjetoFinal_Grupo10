<?php
session_start();

spl_autoload_register(function ($class) {
    require_once __DIR__ . "/Classes/{$class}.class.php";
});

$Edital = new EditalInterno();

if (filter_has_var(INPUT_POST, "btnGravar")):
    $idEditalInterno = filter_input(INPUT_POST, "idEditalInterno", FILTER_SANITIZE_NUMBER_INT);

    $Edital->setIdEditalInterno($idEditalInterno);
    $Edital->setTitulo(filter_input(INPUT_POST, "titulo", FILTER_SANITIZE_STRING));
    $Edital->setDescResumida(filter_input(INPUT_POST, "descResumida", FILTER_SANITIZE_STRING));
    $Edital->setDescCompleta(filter_input(INPUT_POST, "descCompleta", FILTER_SANITIZE_STRING));
    $Edital->setOrganizacao(filter_input(INPUT_POST, "organizacao", FILTER_SANITIZE_STRING));
    $Edital->setTipoApoio(filter_input(INPUT_POST, "tipoApoio", FILTER_SANITIZE_STRING));
    $Edital->setDataAbertura(filter_input(INPUT_POST, "dataAbertura", FILTER_SANITIZE_STRING));
    $Edital->setDataEncerramento(filter_input(INPUT_POST, "dataEncerramento", FILTER_SANITIZE_STRING));
    $Edital->setStatus(filter_input(INPUT_POST, "status", FILTER_SANITIZE_STRING));
    $Edital->setVagas(filter_input(INPUT_POST, "vagas", FILTER_SANITIZE_NUMBER_INT));
    $Edital->setCriterios(filter_input(INPUT_POST, "criterios", FILTER_SANITIZE_STRING));
    $Edital->setParticipantes(filter_input(INPUT_POST, "participantes", FILTER_SANITIZE_STRING));
    $Edital->setEtapas(filter_input(INPUT_POST, "etapas", FILTER_SANITIZE_STRING));
    $Edital->setBeneficios(filter_input(INPUT_POST, "beneficios", FILTER_SANITIZE_STRING));
    $Edital->setResponsavel(filter_input(INPUT_POST, "responsavel", FILTER_SANITIZE_STRING));
    $Edital->setContato(filter_input(INPUT_POST, "contato", FILTER_SANITIZE_STRING));
    $Edital->setObservacoes(filter_input(INPUT_POST, "observacoes", FILTER_SANITIZE_STRING));

    if (empty($idEditalInterno)):
        $novoId = $Edital->add();

        if ($novoId) {
            echo "<script>
                alert('Cadastro de edital realizado com sucesso.');
                window.location.href='listaEditaisInternos.php';
            </script>";
            exit;
        } else {
            echo "<script>
                alert('Erro ao cadastrar o edital.');
                window.open(document.referrer,'_self');
            </script>";
            exit;
        }

    else:
        if ($Edital->update("idEditalInterno", $idEditalInterno)) {
            echo "<script>
                alert('Edital alterado com sucesso.');
                window.location.href='listaEditaisInternos.php';
            </script>";
            exit;
        } else {
            echo "<script>
                alert('Erro ao alterar o edital.');
                window.open(document.referrer,'_self');
            </script>";
            exit;
        }
    endif;

elseif (filter_has_var(INPUT_POST, "btnDeletar")):
    $idEditalInterno = filter_input(INPUT_POST, "idEditalInterno", FILTER_VALIDATE_INT);
    $e = $Edital->findByIdEditalInterno($idEditalInterno);

    if ($e):
        if ($Edital->delete("idEditalInterno", $idEditalInterno)) {
            echo "<script>
                alert('Edital excluído com sucesso.');
                window.location.href='listaEditaisInternos.php';
            </script>";
        } else {
            echo "<script>
                alert('Erro ao excluir edital.');
                window.open(document.referrer,'_self');
            </script>";
        }
        exit;
    endif;

endif;
?>