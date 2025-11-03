<?php
session_start();

spl_autoload_register(function ($class) {
    require_once __DIR__ . "/Classes/{$class}.class.php";
});

$id = filter_input(INPUT_GET, 'id_trilha', FILTER_VALIDATE_INT);
$nomeAluno = filter_input(INPUT_GET, 'nome_aluno', FILTER_SANITIZE_STRING);

$Trilha = new EducaCoop();
$resultado = $Trilha->search("id_trilha", $id);
$trilha = is_array($resultado) && !empty($resultado) ? $resultado[0] : null;

if ($trilha && !empty($nomeAluno)) {
    $arquivo = $trilha->gerarCertificadoManual($nomeAluno);
    if ($arquivo) {
        echo "Certificado gerado: <a href='$arquivo' target='_blank'>Baixar PDF</a>";
    } else {
        echo "Erro ao gerar certificado.";
    }
} else {
    echo "Trilha ou aluno não encontrados.";
}
