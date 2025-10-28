<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();
$current_page = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar">
    <a class="logo" href="../index.php">InnovaMind</a>
    <ul class="main-nav">
        <li><a href="index.php" class="<?= ($current_page == 'index.php') ? 'active' : '' ?>">Home</a></li>
        <li><a href="projetos.php" class="<?= ($current_page == 'projet.php') ? 'active' : '' ?>">Projetos</a></li>
        <li><a href="categorias.php" class="<?= ($current_page == 'categorias.php') ? 'active' : '' ?>">Categorias</a>
        </li>
        <li><a href="impactos.php" class="<?= ($current_page == 'impactos.php') ? 'active' : '' ?>">Impactos</a></li>
    </ul>
    <div class="nav-actions">
        <a href="login.php" class="btn <?= ($current_page == 'login.php') ? 'active' : '' ?>">Entrar</a>
    </div>
</nav>