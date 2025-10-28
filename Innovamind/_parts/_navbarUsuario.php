<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();
?>
<nav class="navbar">
    <a class="logo" href="index.php">InnovaMind</a>
    <ul class="main-nav">
        <li><a href="index.php">Home</a></li>
        <li><a href="projeto.php">Projetos</a></li>
        <li><a href="categorias.php">Categorias</a></li>
        <li><a href="impactos.php">Impactos</a></li>
    </ul>
    <div class="nav-actions">
        <a href="meusProjetos.php">Meus Projetos</a>
        <a href="cadProjeto.php" class="btn">Cadastrar Projeto</a>
        <a href="logout.php">Sair</a>
    </div>
</nav>