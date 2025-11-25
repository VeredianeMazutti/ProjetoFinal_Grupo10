<?php
spl_autoload_register(function ($class) {
    require_once __DIR__ . "/Classes/{$class}.class.php";
});

$Edital = new EditalInterno();

if (filter_has_var(INPUT_POST, "btnGravar")) {

    $idEditalInterno = filter_input(INPUT_POST, "idEditalInterno", FILTER_SANITIZE_STRING);

    $titulo = filter_input(INPUT_POST, "titulo", FILTER_SANITIZE_STRING);
    $descResumida = filter_input(INPUT_POST, "descResumida", FILTER_SANITIZE_STRING);
    $descCompleta = filter_input(INPUT_POST, "descCompleta", FILTER_SANITIZE_STRING);
    $organizacao = filter_input(INPUT_POST, "organizacao", FILTER_SANITIZE_STRING);
    $tipoApoio = filter_input(INPUT_POST, "tipoApoio", FILTER_SANITIZE_STRING);
    $dataAbertura = filter_input(INPUT_POST, "dataAbertura", FILTER_SANITIZE_STRING);
    $dataEncerramento = filter_input(INPUT_POST, "dataEncerramento", FILTER_SANITIZE_STRING);
    $status = filter_input(INPUT_POST, "status", FILTER_SANITIZE_STRING);
    $vagas = filter_input(INPUT_POST, "vagas", FILTER_SANITIZE_NUMBER_INT);
    $criterios = filter_input(INPUT_POST, "criterios", FILTER_SANITIZE_STRING);
    $participantes = filter_input(INPUT_POST, "participantes", FILTER_SANITIZE_STRING);
    $etapas = filter_input(INPUT_POST, "etapas", FILTER_SANITIZE_STRING);
    $beneficios = filter_input(INPUT_POST, "beneficios", FILTER_SANITIZE_STRING);
    $responsavel = filter_input(INPUT_POST, "responsavel", FILTER_SANITIZE_STRING);
    $contato = filter_input(INPUT_POST, "contato", FILTER_SANITIZE_STRING);
    $observacoes = filter_input(INPUT_POST, "observacoes", FILTER_SANITIZE_STRING);

    $Edital->setIdEditalInterno($idEditalInterno);

    $Edital->setTitulo($titulo);
    $Edital->setDescResumida($descResumida);
    $Edital->setDescCompleta($descCompleta);
    $Edital->setOrganizacao($organizacao);
    $Edital->setTipoApoio($tipoApoio);
    $Edital->setDataAbertura($dataAbertura);
    $Edital->setDataEncerramento($dataEncerramento);
    $Edital->setStatus($status);
    $Edital->setVagas($vagas);
    $Edital->setCriterios($criterios);
    $Edital->setParticipantes($participantes);
    $Edital->setEtapas($etapas);
    $Edital->setBeneficios($beneficios);
    $Edital->setResponsavel($responsavel);
    $Edital->setContato($contato);
    $Edital->setObservacoes($observacoes);

    if (empty($idEditalInterno))
        $Edital->add();
    else
        $Edital->update("idEditalInterno", $idEditalInterno);

    echo "<script>alert('Edital salvo com sucesso!');location.href='edital.php';</script>";
    exit;
}

if (filter_has_var(INPUT_GET, "acao") && filter_input(INPUT_GET, "acao") === "deletar") {

    $idEditalInterno = filter_input(INPUT_GET, "idEditalInterno", FILTER_SANITIZE_NUMBER_INT);

    $e = $Edital->findByIdEditalInterno($idEditalInterno);
    if ($e) {
        $Edital->delete("idEditalInterno", $idEditalInterno);
    }

    echo "<script>alert('Edital excluído com sucesso!');location.href='edital.php';</script>";
    exit;
}
?>