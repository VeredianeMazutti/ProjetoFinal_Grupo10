<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$perfil = $_SESSION['perfil'] ?? 'visitante';
$nome = $_SESSION['nomeUsuario'] ?? 'Conta';
$current = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">

        <a class="logo" href="dashboard.php">InnovaMind</a>

        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <i class="bi bi-list fs-2 text-white"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="main-nav navbar-nav me-auto mb-2 mb-lg-0">

                <?php if ($perfil === 'visitante' || $perfil === 'usuario'): ?>
                    <li><a href="index.php" class="<?= $current === 'index.php' ? 'active' : '' ?>">Home</a></li>
                    <li><a href="projetos.php" class="<?= $current === 'projetos.php' ? 'active' : '' ?>">Projetos</a></li>
                    <li><a href="impactos.php" class="<?= $current === 'impactos.php' ? 'active' : '' ?>">Impactos</a></li>
                    <li><a href="apoiadores.php" class="<?= $current === 'apoiadores.php' ? 'active' : '' ?>">Rede
                            Innova</a></li>
                    <li><a href="sobreInnovamind.php"
                            class="<?= $current === 'sobreInnovamind.php' ? 'active' : '' ?>">Conheça a Innovamind</a></li>
                <?php endif; ?>


                <?php if ($perfil === 'usuario'): ?>
                    <li><a href="educaCoop.php" class="<?= $current === 'educaCoop.php' ? 'active' : '' ?>">EducaCoop</a>
                    </li>
                    <li><a href="cadProjeto.php" class="<?= $current === 'cadProjeto.php' ? 'active' : '' ?>">Cadastrar
                            Projeto</a></li>
                <?php endif; ?>


                <?php if ($perfil === 'admin'): ?>
                    <li><a href="dashboard.php" class="<?= $current === 'dashboard.php' ? 'active' : '' ?>">Dashboard</a>
                    </li>
                    <li><a href="cadEducaCoop.php" class="<?= $current === 'cadEducaCoop.php' ? 'active' : '' ?>">Cadastro
                            EducaCoop</a></li>
                    <li><a href="usuario.php" class="<?= $current === 'usuario.php' ? 'active' : '' ?>">Usuários</a></li>
                    <li><a href="listaeducacoop.php"
                            class="<?= $current === 'listaeducacoop.php' ? 'active' : '' ?>">EducaCoop</a></li>
                    <li><a href="cadApoiadores.php" class="<?= $current === 'cadApoiadores.php' ? 'active' : '' ?>">Cadastro
                            de Apoiadores</a></li>
                    <li><a href="listaApoiadores.php"
                            class="<?= $current === 'listaApoiadores.php' ? 'active' : '' ?>">Lista Apoiadores</a></li>
                    <li><a href="cadFaq.php" class="<?= $current === 'cadFaq.php' ? 'active' : '' ?>">Cadastro FAQ</a></li>
                <?php endif; ?>


            </ul>


            <div class="nav-actions">

                <?php if ($perfil === 'visitante'): ?>
                    <a href="login.php" class="btn-custom">Entrar</a>

                <?php else: ?>
                    <div class="dropdown">
                        <a class="btn-custom dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> <?= htmlspecialchars($nome) ?>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">

                            <?php if ($perfil === 'usuario'): ?>
                                <li><a class="dropdown-item" href="meusProjetos.php">Meus Projetos</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            <?php endif; ?>

                            <li><a class="dropdown-item text-danger" href="logout.php">Sair</a></li>
                        </ul>
                    </div>

                <?php endif; ?>
            </div>

        </div>
    </div>
</nav>