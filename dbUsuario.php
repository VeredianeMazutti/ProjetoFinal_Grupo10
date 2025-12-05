<?php
session_start();

spl_autoload_register(function ($class) {
    require_once __DIR__ . "/Classes/{$class}.class.php";
});

$Usuario = new Usuario();

if (filter_has_var(INPUT_POST, "btnLogar")):
    $login = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
    $senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_STRING);

    $resultado = $Usuario->search("email", $login);
    $u = $resultado[0] ?? null;

    if ($u && password_verify($senha, $u->senha)):

        $_SESSION["idUsuario"] = $u->id;
        $_SESSION["nomeUsuario"] = $u->nomeExibicao ?? $u->nomeCompleto;
        $_SESSION["perfil"] = $u->perfil;

        session_regenerate_id(true);

        if ($u->perfil === "admin"):
            header("Location: projetos.php");
            exit;
        elseif ($u->perfil === "usuario"):
            header("Location: meusProjetos.php");
            exit;
        else:
            header("Location: dashboard.php");
            exit;
        endif;

    else:
        echo "<script>
            alert('Usuário ou senha inválidos.');
            window.open(document.referrer,'_self');
        </script>";
        exit;
    endif;

elseif (filter_has_var(INPUT_POST, "btnGravar")):

    $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);

    $fotoNome = null;

    if (!empty($id)):
        $u = $Usuario->findById($id);
        $fotoNome = $u->foto ?? null;
    endif;

    if (!empty($_FILES["fotoPerfil"]["name"]) && $_FILES["fotoPerfil"]["error"] === 0):
        $pasta = "uploads/fotoUsuario/";

        if (!is_dir($pasta)) {
            mkdir($pasta, 0777, true);
        }

        $ext = strtolower(pathinfo($_FILES["fotoPerfil"]["name"], PATHINFO_EXTENSION));
        $permitidas = ["jpg", "jpeg", "png", "gif", "webp"];

        if (in_array($ext, $permitidas)):
            $fotoNome = uniqid("user_") . "." . $ext;
            move_uploaded_file($_FILES["fotoPerfil"]["tmp_name"], $pasta . $fotoNome);
        else:
            echo "<script>alert('Formato de imagem não permitido.'); window.open(document.referrer,'_self');</script>";
            exit;
        endif;
    endif;

    // -------------------------------
    //  🟡 CAMPOS EDITADOS PARA INCLUIR LGPD
    // -------------------------------

    $Usuario->setId($id);
    $Usuario->setNomeCompleto(filter_input(INPUT_POST, "nomeCompleto", FILTER_SANITIZE_STRING));
    $Usuario->setDataNascimento(filter_input(INPUT_POST, "dataNascimento", FILTER_SANITIZE_STRING));
    $Usuario->setTelefone(filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_STRING));
    $Usuario->setAreaAtuacao(filter_input(INPUT_POST, "areaAtuacao", FILTER_SANITIZE_STRING));
    $Usuario->setNomeExibicao(filter_input(INPUT_POST, "nomeExibicao", FILTER_SANITIZE_STRING));
    $Usuario->setEmail(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
    $Usuario->setPerfil("usuario");
    $Usuario->setFoto($fotoNome);

    $senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_STRING);
    if (!empty($senha)):
        $Usuario->setSenha(password_hash($senha, PASSWORD_DEFAULT));
    endif;

    // ----------------------------------
    // 🔵 NOVO — TRATAMENTO DOS ACEITES LGPD
    // ----------------------------------
    $aceitouTermos   = filter_has_var(INPUT_POST, "aceitouTermos") ? 1 : 0;   // NOVO
    $aceitouPolitica = filter_has_var(INPUT_POST, "aceitouPolitica") ? 1 : 0; // NOVO
    $dataAceite      = ($aceitouTermos && $aceitouPolitica) ? date("Y-m-d H:i:s") : null; // NOVO

    $Usuario->setAceitouTermos($aceitouTermos);       // NOVO
    $Usuario->setAceitouPolitica($aceitouPolitica);   // NOVO
    $Usuario->setDataAceite($dataAceite);             // NOVO


    // -------------------------
    // SALVAR NOVO CADASTRO
    // -------------------------
    if (empty($id)):
        if ($Usuario->add()) {
            echo "<script>
                alert('Cadastro realizado com sucesso.');
                window.location.href='listaUsuarios.php';
            </script>";
            exit;
        } else {
            echo "<script>
                alert('Erro ao cadastrar usuário.');
                window.open(document.referrer,'_self');
            </script>";
            exit;
        }

    // -------------------------
    // ATUALIZAR CADASTRO
    // -------------------------
    else:
        if ($Usuario->update("id", $id)) {


            //Recarrega o usuário atualizado
            $u = $Usuario->findById($id);

            // Atualiza sessão
            $_SESSION["nomeUsuario"] = $u->nomeExibicao ?? $u->nomeCompleto;
            $_SESSION["perfil"] = $u->perfil;
            $_SESSION["foto"] = $u->foto;

            echo "<script>
                alert('Cadastro alterado com sucesso.');
                window.location.href='listaUsuarios.php';
            </script>";
            exit;
        } else {
            echo "<script>
                alert('Erro ao alterar usuário.');
                window.open(document.referrer,'_self');
            </script>";
            exit;
        }
    endif;

elseif (filter_has_var(INPUT_POST, "btnDeletar")):
    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
    $u = $Usuario->findById($id);

    if ($u && $u->perfil === "admin"):
        echo "<script>
            alert('Não é permitido excluir um administrador.');
            window.location.href='listaUsuarios.php';
        </script>";
        exit;
    endif;

    if ($Usuario->delete("id", $id)) {
        echo "<script>
            alert('Usuário excluído com sucesso.');
            window.location.href='listaUsuarios.php';
        </script>";
        exit;
    } else {
        echo "<script>
            alert('Erro ao excluir usuário.');
            window.open(document.referrer,'_self');
        </script>";
        exit;
    }

endif;

?>