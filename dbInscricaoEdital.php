<?php
/*require_once __DIR__ . "/verifica_acesso.php";*/

spl_autoload_register(function ($class) {
    require_once __DIR__ . "/Classes/{$class}.class.php";
});

$Inscricao = new InscricaoEdital();

$idEdital = filter_input(INPUT_POST, "idEditalInterno", FILTER_SANITIZE_NUMBER_INT);

if (!$idEdital || $idEdital <= 0) {
    echo "Edital inválido.";
    exit;
}

if (filter_has_var(INPUT_POST, "btnGravar")) {

    $idInscricao = filter_input(INPUT_POST, "idInscricao", FILTER_SANITIZE_NUMBER_INT);
    $idEditalInterno = filter_input(INPUT_POST, "idEditalInterno", FILTER_SANITIZE_NUMBER_INT);
    $responsavel = filter_input(INPUT_POST, "responsavel", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
    $telefone = filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_STRING);
    $instituicao = filter_input(INPUT_POST, "instituicao", FILTER_SANITIZE_STRING);
    $titulo = filter_input(INPUT_POST, "titulo", FILTER_SANITIZE_STRING);
    $resumo = filter_input(INPUT_POST, "resumo", FILTER_SANITIZE_STRING);
    $objetivo = filter_input(INPUT_POST, "objetivo", FILTER_SANITIZE_STRING);
    $relato = filter_input(INPUT_POST, "relato", FILTER_SANITIZE_STRING);

    $Inscricao->setIdInscricao($idInscricao);
    $Inscricao->setIdEditalInterno($idEditalInterno);
    $Inscricao->setResponsavel($responsavel);
    $Inscricao->setEmail($email);
    $Inscricao->setTelefone($telefone);
    $Inscricao->setInstituicao($instituicao);
    $Inscricao->setTitulo($titulo);
    $Inscricao->setResumo($resumo);
    $Inscricao->setObjetivo($objetivo);
    $Inscricao->setRelato($relato);

    if (empty($idInscricao)) {
        $Inscricao->setStatus("Em Análise");
        $Inscricao->add();
    } else {
        $Inscricao->update("idInscricao", $idInscricao);
    }

    echo "<script>alert('Inscrição enviada com sucesso!');location.href='editaisInternos.php';</script>";
    exit;
}

if (filter_has_var(INPUT_GET, "acao") && filter_input(INPUT_GET, "acao") === "deletar") {

    $idInscricao = filter_input(INPUT_GET, "idInscricao", FILTER_SANITIZE_NUMBER_INT);

    $inscricaoEncontrada = $Inscricao->findById($idInscricao);
    if ($inscricaoEncontrada) {
        $Inscricao->delete("idInscricao", $idInscricao);
    }

    echo "<script>alert('Inscrição excluída com sucesso!');location.href='adminInscricoes.php';</script>";
    exit;
}
?>