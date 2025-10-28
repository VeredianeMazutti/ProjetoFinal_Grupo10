<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit;
}

$pagina = basename($_SERVER['PHP_SELF']);
$regras = [

    "usuario.php" => ["admin"],
    "instituicoe.php" => ["admin"],
    "projeto.php" => ["admin"],


    "meusProjeto.php" => ["usuario"],
    "cadProjeto.php" => ["usuario"],

    "dashboard.php" => ["admin", "usuario"],

];

if (isset($regras[$pagina]) && !in_array($_SESSION['perfil'], $regras[$pagina])) {
    header("Location: index.php");
    exit;
}
