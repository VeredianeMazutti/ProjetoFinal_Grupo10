<?php
session_start();
header('Content-Type: application/json');

spl_autoload_register(function ($class) {
    require_once "Classes/{$class}.class.php";
});

$Projeto = new Projeto();

// Gera hash do visitante caso ainda não exista
if (!isset($_SESSION['idUsuario']) && !isset($_COOKIE['visitanteHash'])) {
    $hash = 'visitante_' . bin2hex(random_bytes(8));
    setcookie('visitanteHash', $hash, time() + (10*365*24*60*60), "/");
    $_COOKIE['visitanteHash'] = $hash;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idProjeto'])) {
    $idProjeto = intval($_POST['idProjeto']);
    $curtido = false;

    // -----------------------------------------------
    // USUÁRIO LOGADO
    // -----------------------------------------------
    if (isset($_SESSION['idUsuario'])) {
        $idUsuario = intval($_SESSION['idUsuario']);

        if ($Projeto->jaCurtiu($idProjeto, $idUsuario, null)) {
            $Projeto->descurtir($idProjeto, $idUsuario, null);
            $curtido = false;
        } else {
            $Projeto->curtir($idProjeto, $idUsuario, null);
            $curtido = true;
        }

        $curtidas = $Projeto->contarCurtidas($idProjeto);


    // -----------------------------------------------
    // VISITANTE
    // -----------------------------------------------
    } else {
        $visitanteHash = $_COOKIE['visitanteHash'];

        if ($Projeto->jaCurtiu($idProjeto, null, $visitanteHash)) {
            $Projeto->descurtir($idProjeto, null, $visitanteHash);
            $curtido = false;
        } else {
            $Projeto->curtir($idProjeto, null, $visitanteHash);
            $curtido = true;
        }

        $curtidas = $Projeto->contarCurtidas($idProjeto);
    }

    echo json_encode([
        'curtido' => $curtido,
        'curtidas' => $curtidas
    ]);
}
