<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$tempoExpiracao = 1800;

if (isset($_SESSION['ultimaAtividade']) && (time() - $_SESSION['ultimaAtividade']) > $tempoExpiracao) {
    session_unset();
    session_destroy();
    header("Location: login.php?expirou=1");
    exit;
}

$_SESSION['ultimaAtividade'] = time();

if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit;
}

$pagina = basename($_SERVER['PHP_SELF']);

$regras = [
    "listaUsuarios.php"      => ["admin"],
    "cadProjeto.php"         => ["admin", "usuario"],
    "listaProjetos.php"      => ["admin"],

    "listaEditaisInternos.php" => ["admin"],
    "cadEditalInterno.php"     => ["admin"],
    "dbEditalInterno.php"      => ["admin"],

    "listaEducacoop.php" => ["admin"],

    "listaEditaisExternos.php" => ["admin"],
    "cadEditalExterno.php"     => ["admin"],
    "dbEditalExterno.php"      => ["admin"],

    "meusProjetos.php" => ["usuario"],
    "dashboard.php"    => ["admin", "usuario"],
];

// Validação
if (isset($regras[$pagina]) && !in_array($_SESSION['perfil'], $regras[$pagina])) {
    header("Location: dashboard.php");
    exit;
}

