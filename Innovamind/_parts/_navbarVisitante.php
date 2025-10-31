<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();
$current_page = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar">
    <a class="logo" href="../index.php">InnovaMind</a>
    <ul class="main-nav">
        <li><a href="home.php" class="<?= ($current_page == 'Home.php') ? 'active' : '' ?>">Home</a></li>
        <li><a href="projetos.php" class="<?= ($current_page == 'Projetos.php') ? 'active' : '' ?>">Projetos</a></li>
        </li>
        <li><a href="impactos.php" class="<?= ($current_page == 'impactos.php') ? 'active' : '' ?>">Impactos</a></li>
    </ul>
    <div class="nav-actions">
        <a href="login.php" class="btn <?= ($current_page == 'login.php') ? 'active' : '' ?>">Entrar</a>
    </div>
</nav>