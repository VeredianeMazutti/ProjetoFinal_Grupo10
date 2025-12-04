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

$Trilha->setIdTrilha($trilha->id_trilha);
$Trilha->setTitulo($trilha->titulo);
$Trilha->setAutorTrilha($trilha->autorTrilha);

if ($nota >= intval($trilha->pontuacaoMinima ?? 70)) {

    if (!empty($trilha->gerarCertificado)) {

        // Gera o PDF
        $arquivo = $Trilha->gerarCertificadoAutomatico($usuario);

        if ($arquivo) {

            // INSERE OU ATUALIZA NA trilha_usuario
            $sql = "INSERT INTO trilha_usuario (id_trilha, nome_usuario, certificado, nota)
                    VALUES (:id_trilha, :usuario, :certificado, :nota)
                    ON DUPLICATE KEY UPDATE 
                        certificado = :certificado,
                        nota = :nota";

            $db = $Trilha->getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(':id_trilha', $idTrilha, PDO::PARAM_INT);
            $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $stmt->bindParam(':certificado', $arquivo, PDO::PARAM_STR);
            $stmt->bindParam(':nota', $nota, PDO::PARAM_INT);

            $stmt->execute();

            // Redireciona para aba certificado
            header("Location: trilha.php?id_trilha={$idTrilha}&aba=certificado");
            exit;
        }

    } else {
        header("Location: trilha.php?id_trilha={$idTrilha}&aba=certificado&erro=nao_tem_certificado");
        exit;
    }

} else {
    header("Location: trilha.php?id_trilha={$idTrilha}&aba=avaliacao&erro=nota_baixa&nota={$nota}");
    exit;
}
?>