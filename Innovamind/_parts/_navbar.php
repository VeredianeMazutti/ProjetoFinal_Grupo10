<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();

$perfil = $_SESSION['perfil'] ?? 'visitante'; 
?>

<nav class="navbar">
    <a class="logo" href="index.php">InnovaMind</a>

    <ul class="main-nav">
        <li><a href="home.php">Home</a></li>
        <li><a href="projetos.php">Projetos</a></li>
        <li><a href="impactos.php">Impactos</a></li>

        <?php if ($perfil === 'usuario'): ?>
            <li><a href="educaCoop.php">EducaCoop</a></li>
            <li><a href="meusProjetos.php">Meus Projetos</a></li>
            <li><a href="cadProjeto.php">Cadastrar Projeto</a></li>
        <?php endif; ?>

        <?php if ($perfil === 'admin'): ?>
            <li><a href="cadEducaCoop.php">Cadastro EducaCoop</a></li>
            <li><a href="usuario.php">Usuários</a></li>
            <li><a href="instituicoes.php">Instituições</a></li>
        <?php endif; ?>
    </ul>

    <div class="nav-actions">
        <?php if ($perfil === 'visitante'): ?>
            <a href="login.php" class="btn">Entrar</a>
        <?php else: ?>
            <a href="logout.php">Sair</a>
        <?php endif; ?>
    </div>
</nav>
