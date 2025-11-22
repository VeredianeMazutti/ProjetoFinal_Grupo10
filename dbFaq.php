<?php
spl_autoload_register(function ($class) {
    require_once __DIR__ . "/Classes/{$class}.class.php";
});

$Faq = new Faq();


if (filter_has_var(INPUT_POST, "btnGravar")) {

    $idFaq = filter_input(INPUT_POST, "idFaq", FILTER_SANITIZE_NUMBER_INT);
    $pergunta = filter_input(INPUT_POST, "pergunta", FILTER_SANITIZE_STRING);
    $resposta = filter_input(INPUT_POST, "resposta", FILTER_SANITIZE_STRING);

    $Faq->setIdFaq($idFaq);
    $Faq->setPergunta($pergunta);
    $Faq->setResposta($resposta);

    if (empty($id)) {
        $Faq->add();
    } else {
        $Faq->update("idFaq", $idFaq);
    }

    echo "<script>alert('FAQ salvo com sucesso!');location.href='faq.php';</script>";
    exit;
}

if (filter_has_var(INPUT_GET, "btnDeletar") && filter_input(INPUT_GET, "btnDeletar") === "deletar") {
    $id = filter_input(INPUT_GET, "idFaq", FILTER_SANITIZE_NUMBER_INT);
    $Faq->delete("idFaq", $idFaq);

    echo "<script>alert('FAQ excluído com sucesso!');location.href='faq.php';</script>";
    exit;
}
