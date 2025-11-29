<?php
session_start();

spl_autoload_register(function ($class) {
    require_once __DIR__ . "/Classes/{$class}.class.php";
});

$Faq = new Faq();

if (filter_has_var(INPUT_POST, "btnGravar")):
    $idFaq = filter_input(INPUT_POST, "idFaq", FILTER_SANITIZE_NUMBER_INT);

    $Faq->setIdFaq($idFaq);
    $Faq->setPergunta(filter_input(INPUT_POST, "pergunta", FILTER_SANITIZE_STRING));
    $Faq->setResposta(filter_input(INPUT_POST, "resposta", FILTER_SANITIZE_STRING));

    if (empty($idFaq)):
        $novoId = $Faq->add();

        if ($novoId) {
            echo "<script>
                alert('Cadastro de FAQ realizado com sucesso.');
                window.location.href='faq.php';
            </script>";
            exit;
        } else {
            echo "<script>
                alert('Erro ao cadastrar FAQ.');
                window.open(document.referrer,'_self');
            </script>";
            exit;
        }

    else:
        if ($Faq->update("idFaq", $idFaq)) {
            echo "<script>
                alert('FAQ alterado com sucesso.');
                window.location.href='listaFaq.php';
            </script>";
            exit;
        } else {
            echo "<script>
                alert('Erro ao alterar FAQ.');
                window.open(document.referrer,'_self');
            </script>";
            exit;
        }
    endif;

elseif (filter_has_var(INPUT_POST, "btnDeletar")):
    $idFaq = filter_input(INPUT_POST, "idFaq", FILTER_VALIDATE_INT);

    if ($Faq->delete("idFaq", $idFaq)) {
        echo "<script>
            alert('FAQ excluído com sucesso.');
            window.location.href='listaFaq.php';
        </script>";
        exit;
    } else {
        echo "<script>
            alert('Erro ao excluir FAQ.');
            window.open(document.referrer,'_self');
        </script>";
        exit;
    }

endif;
?>