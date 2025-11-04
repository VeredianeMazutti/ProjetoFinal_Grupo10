<?php
session_start();

spl_autoload_register(function ($class) {
    require_once __DIR__ . "/Classes/{$class}.class.php";
});

$idTrilha = filter_input(INPUT_GET, 'id_trilha', FILTER_VALIDATE_INT);
$nota = filter_input(INPUT_GET, 'nota', FILTER_VALIDATE_INT);
$usuario = $_SESSION['nomeUsuario'] ?? null;

if (!$idTrilha || !$usuario) {
    die("Trilha ou usuário inválido.");
}

$Trilha = new EducaCoop();
$resultado = $Trilha->search("id_trilha", $idTrilha);
$trilha = $resultado[0] ?? null;

if (!$trilha) {
    die("Trilha não encontrada.");
}

if ($nota >= intval($trilha->pontuacaoMinima ?? 70)) {

    if (!empty($trilha->gerarCertificado)) {
        $arquivo = $Trilha->gerarCertificadoAutomatico($usuario);
        if ($arquivo) {
            echo "🎉 Certificado gerado com sucesso! 
          <a href='$arquivo' target='_blank' download>Baixar PDF</a>";
        } else {
            echo "⚠️ Erro ao gerar certificado automático.";
        }

    } else {
        echo "⚙️ Esta trilha não está configurada para gerar certificado automaticamente.";
    }

} else {
    echo "❌ Você precisa atingir pelo menos 70% para receber o certificado (sua nota: {$nota}%).";
}
?>