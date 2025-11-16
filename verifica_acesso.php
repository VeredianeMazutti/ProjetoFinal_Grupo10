<?php
// Inicia sessão apenas se ainda não foi iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Se não estiver logado, redireciona para o login
if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit;
}

// Página atual
$pagina = basename($_SERVER['PHP_SELF']);

// Regras de acesso
$regras = [
    "usuario.php"      => ["admin"],
    "projeto.php"      => ["admin"],

    "meusProjetos.php" => ["usuario"],
    "cadProjeto.php"   => ["usuario"],

    "dashboard.php"    => ["admin", "usuario"],
];

// Validação
if (isset($regras[$pagina]) && !in_array($_SESSION['perfil'], $regras[$pagina])) {
    header("Location: dashboard.php");
    exit;
}

