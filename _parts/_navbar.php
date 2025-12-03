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
                    <li class="nav-item">
                        <a class="nav-link <?= ($current == 'index.php') ? 'active' : '' ?>" href="index.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= ($current == 'projetos.php') ? 'active' : '' ?>"
                            href="projetos.php">Projetos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= ($current == 'impactos.php') ? 'active' : '' ?>"
                            href="impactos.php">Impactos</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Nossa Essência
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item <?= ($current == 'apoiadores.php') ? 'active' : '' ?>"
                                    href="apoiadores.php">
                                    Rede Innova
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item <?= ($current == 'sobreInnovamind.php') ? 'active' : '' ?>"
                                    href="sobreInnovamind.php">
                                    Conheça a Innovamind
                                </a>
                            </li>
                             <li>
                                <a class="dropdown-item <?= ($current == 'nossaEquipe.php') ? 'active' : '' ?>"
                                    href="nossaEquipe.php">
                                    Conheça nossa equipe
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Editais
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item <?= ($current == 'editaisInternos.php') ? 'active' : '' ?>"
                                    href="editaisInternos.php">
                                    Editais Internos
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item <?= ($current == 'editaisExternos.php') ? 'active' : '' ?>"
                                    href="editaisExternos.php">
                                    Editais Externos
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if ($perfil === 'usuario'): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Minha Jornada
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item <?= ($current == 'cadProjeto.php') ? 'active' : '' ?>"
                                    href="cadProjeto.php">Cadastrar Projeto</a></li>
                            <li><a class="dropdown-item <?= ($current == 'meusProjetos.php') ? 'active' : '' ?>"
                                    href="meusProjetos.php">Meus Projetos</a></li>
                            <li><a class="dropdown-item <?= ($current == 'minhasInscricoes.php') ? 'active' : '' ?>"
                                    href="minhasInscricoes.php">Minhas Inscrições</a></li>
                        </ul>
                    <li class="nav-item">
                        <a class="nav-link <?= ($current == 'educaCoop.php') ? 'active' : '' ?>"
                            href="educaCoop.php">EducaCoop</a>
                    </li>
                    </li>
                <?php endif; ?>

                <?php if ($perfil === 'admin'): ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Site Geral
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item <?= ($current == 'index.php') ? 'active' : '' ?>"
                                    href="index.php">Home</a></li>
                            <li><a class="dropdown-item <?= ($current == 'projetos.php') ? 'active' : '' ?>"
                                    href="projetos.php">Projetos</a></li>
                            <li><a class="dropdown-item <?= ($current == 'impactos.php') ? 'active' : '' ?>"
                                    href="impactos.php">Impactos</a></li>
                            <li><a class="dropdown-item <?= ($current == 'editaisInternos.php') ? 'active' : '' ?>"
                                    href="editaisInternos.php">Editais Internos</a></li>
                            <li><a class="dropdown-item <?= ($current == 'editaisExternos.php') ? 'active' : '' ?>"
                                    href="editaisExternos.php">Editais Externos</a></li>
                            <li><a class="dropdown-item <?= ($current == 'apoiadores.php') ? 'active' : '' ?>"
                                    href="apoiadores.php">Rede Innova</a></li>
                            <li><a class="dropdown-item <?= ($current == 'sobreInnovamind.php') ? 'active' : '' ?>"
                                    href="sobreInnovamind.php">Conheça a Innovamind</a></li>
                            <li><a class="dropdown-item <?= ($current == 'educaCoop.php') ? 'active' : '' ?>"
                                    href="educaCoop.php">EducaCoop</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Cadastros
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item <?= ($current == 'cadEducaCoop.php') ? 'active' : '' ?>"
                                    href="cadEducaCoop.php">Cadastro EducaCoop</a></li>
                            <li><a class="dropdown-item <?= ($current == 'cadApoiadores.php') ? 'active' : '' ?>"
                                    href="cadApoiadores.php">Cadastro Apoiadores</a></li>
                            <li><a class="dropdown-item <?= ($current == 'cadFaq.php') ? 'active' : '' ?>"
                                    href="cadFaq.php">Cadastro FAQ</a></li>
                            <li><a class="dropdown-item <?= ($current == 'cadEditalInterno.php') ? 'active' : '' ?>"
                                    href="cadEditalInterno.php">Cadastro Edital Interno</a></li>
                            <li><a class="dropdown-item <?= ($current == 'cadEditalExterno.php') ? 'active' : '' ?>"
                                    href="cadEditalExterno.php">Cadastro Edital Externo</a></li>
                            <li><a class="dropdown-item <?= ($current == 'cadUsuario.php') ? 'active' : '' ?>"
                                    href="cadUsuario.php">Cadastro Usuário</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Listas
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item <?= ($current == 'listaApoiadores.php') ? 'active' : '' ?>"
                                    href="listaApoiadores.php">Lista Apoiadores</a></li>
                            <li><a class="dropdown-item <?= ($current == 'listaEducaCoop.php') ? 'active' : '' ?>"
                                    href="listaEducaCoop.php">Lista EducaCoop</a></li>
                            <li><a class="dropdown-item <?= ($current == 'listaEditaisExternos.php') ? 'active' : '' ?>"
                                    href="listaEditaisExternos.php">Lista Editais Externos</a></li>
                            <li><a class="dropdown-item <?= ($current == 'listaEditaisInternos.php') ? 'active' : '' ?>"
                                    href="listaEditaisInternos.php">Lista Editais Internos</a></li>
                            <li><a class="dropdown-item <?= ($current == 'listaProjetos.php') ? 'active' : '' ?>"
                                    href="listaProjetos.php">Lista Projetos</a></li>
                            <li><a class="dropdown-item <?= ($current == 'listaUsuarios.php') ? 'active' : '' ?>"
                                    href="listaUsuarios.php">Lista Usuários</a></li>
                            <li><a class="dropdown-item <?= ($current == 'listaInscricoes.php') ? 'active' : '' ?>"
                                    href="listaInscricoes.php">Lista Inscrições de Editais</a></li>
                            <li><a class="dropdown-item <?= ($current == 'listaFaq.php') ? 'active' : '' ?>"
                                    href="listaFaq.php">Lista de FAQ</a></li>
                        </ul>
                    </li>

                <?php endif; ?>

            </ul>

            <!-- AÇÕES DO USUÁRIO / LOGIN -->
            <div class="nav-actions">
                <?php if ($perfil === 'visitante'): ?>

                    <a href="login.php" class="btn-menu">Entrar</a>

                <?php else: ?>

                    <?php
                    // FOTO DO USUÁRIO
                    $foto = $_SESSION['fotoUsuario'] ?? null;

                    if (!$foto && isset($_SESSION['idUsuario'])) {
                        require_once __DIR__ . "/../Classes/Usuario.class.php";
                        $uTemp = new Usuario();
                        $dados = $uTemp->findById($_SESSION['idUsuario']);
                        $foto = $dados->foto ?? null;
                    }

                    $caminhoFoto = "uploads/fotoUsuario/" . $foto;

                    $fotoPerfil = (!empty($foto) && file_exists($caminhoFoto))
                        ? $caminhoFoto
                        : "images/default-user.png";
                    ?>

                    <div class="dropdown">
                        <a class="btn-menu dropdown-toggle d-flex align-items-center gap-2" href="#" role="button"
                            data-bs-toggle="dropdown">

                            <img src="<?= $fotoPerfil ?>" class="foto-perfil">

                            <?= htmlspecialchars($nome) ?>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item text-danger" href="logout.php">Sair</a></li>
                        </ul>
                    </div>

                <?php endif; ?>
            </div>

        </div>
    </div>
</nav>