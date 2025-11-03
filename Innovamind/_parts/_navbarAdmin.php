<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();
?>
<nav class="navbar">
    <a class="logo" href="index.php">InnovaMind</a>
    <ul class="main-nav">
        <li><a href="index.php">Home</a></li>
        <li><a href="cadEducaCoop.php">Cadastro EducaCoop</a></li>
        <li><a href="usuarios.php">Usuários</a></li>
        <li><a href="projetos.php">Projetos</a></li>
        <li><a href="instituicoes.php">Instituições</a></li>
    </ul>
    <div class="nav-actions">
        <a href="logout.php">Sair</a>
    </div>
</nav>