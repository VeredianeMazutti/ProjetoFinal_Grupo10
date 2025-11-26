<?php
spl_autoload_register(function ($class) {
    require_once __DIR__ . "/Classes/{$class}.class.php";
});


$Usuario = new Usuario();

if (filter_has_var(INPUT_POST, 'btnLogar')) {

    $login = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

    $resultado = $Usuario->search('email', $login);

    if (!empty($resultado)) {
        $u = $resultado[0];

        if (password_verify($senha, $u->senha)) {

            if (session_status() === PHP_SESSION_NONE)
                session_start();

            $_SESSION['idUsuario'] = $u->id;
            $_SESSION['nomeUsuario'] = $u->nomeExibicao ?? $u->nomeCompleto;
            $_SESSION['perfil'] = $u->perfil;

            session_regenerate_id(true);

            if ($u->perfil === 'admin') {
                header("Location: projetos.php");
            } elseif ($u->perfil === 'usuario') {
                header("Location: meusProjetos.php");
            } else {
                header("Location: dashboard.php");
            }
            exit;
        }
    }

    echo "<script>alert('Usuário ou senha inválidos.');window.history.back();</script>";
    exit;
}

if (filter_has_var(INPUT_POST, "btnGravar")) {

    $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
    $nomeCompleto = filter_input(INPUT_POST, "nomeCompleto", FILTER_SANITIZE_STRING);
    $dataNascimento = filter_input(INPUT_POST, "dataNascimento", FILTER_SANITIZE_STRING);
    $telefone = filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_STRING);
    $areaAtuacao = filter_input(INPUT_POST, "areaAtuacao", FILTER_SANITIZE_STRING);
    $nomeExibicao = filter_input(INPUT_POST, "nomeExibicao", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_STRING);

    $fotoNome = null;

    if (!empty($id)) {
        $u = $Usuario->findById($id);
        $fotoNome = $u->foto ?? null;
    }

    if (!empty($_FILES["fotoPerfil"]["name"])) {

        $pasta = "uploads/fotoUsuario/";

        if (!is_dir($pasta)) {
            mkdir($pasta, 0777, true);
        }

        $ext = strtolower(pathinfo($_FILES["fotoPerfil"]["name"], PATHINFO_EXTENSION));
        $fotoNome = uniqid("user_") . "." . $ext;

        move_uploaded_file($_FILES["fotoPerfil"]["tmp_name"], $pasta . $fotoNome);
    }

    $Usuario->setId($id);
    $Usuario->setNomeCompleto($nomeCompleto);
    $Usuario->setDataNascimento($dataNascimento);
    $Usuario->setTelefone($telefone);
    $Usuario->setAreaAtuacao($areaAtuacao);
    $Usuario->setNomeExibicao($nomeExibicao);
    $Usuario->setEmail($email);
    $Usuario->setPerfil('usuario');
    $Usuario->setFoto($fotoNome);

    if (!empty($senha)) {
        $Usuario->setSenha(password_hash($senha, PASSWORD_DEFAULT));
    }

    if (empty($id)) {
        $Usuario->add();
    } else {
        $Usuario->update("id", $id);
    }

    echo "<script>alert('Cadastro realizado com sucesso!');location.href='listaUsuarios.php';</script>";
    exit;
}

if (filter_has_var(INPUT_GET, "acao") && filter_input(INPUT_GET, "acao") === "deletar") {

    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

    $u = $Usuario->findById($id);

    if ($u && $u->perfil === 'admin') {
        echo "<script>alert('Não é permitido excluir um administrador.');location.href='listaUsuarios.php';</script>";
        exit;
    }

    $Usuario->delete("id", $id);

    echo "<script>alert('Usuário excluído com sucesso!');location.href='listaUsuarios.php';</script>";
    exit;
}
?>