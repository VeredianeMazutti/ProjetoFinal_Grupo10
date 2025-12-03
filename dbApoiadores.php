<?php
session_start();

spl_autoload_register(function ($class) {
    require_once __DIR__ . "/Classes/{$class}.class.php";
});

$Parceiro = new Apoiadores();

if (filter_has_var(INPUT_POST, "btnGravar")):
    $id = filter_input(INPUT_POST, "idApoiadores", FILTER_SANITIZE_NUMBER_INT);

    $Parceiro->setIdApoiadores($id);
    $Parceiro->setTipo(filter_input(INPUT_POST, "tipo"));
    $Parceiro->setNome(filter_input(INPUT_POST, "nome"));
    $Parceiro->setDescricao(filter_input(INPUT_POST, "descricao"));
    $Parceiro->setSite(filter_input(INPUT_POST, "site", FILTER_SANITIZE_URL));
    $Parceiro->setInstagram(filter_input(INPUT_POST, "instagram", FILTER_SANITIZE_URL));
    $Parceiro->setLinkedin(filter_input(INPUT_POST, "linkedin", FILTER_SANITIZE_URL));

    // Upload da imagem 
    $imagemAntiga = filter_input(INPUT_POST, "imagemAntiga");
    $nomeImg = $imagemAntiga;

    if (!empty($_FILES["imagem"]["name"]) && $_FILES["imagem"]["error"] === 0):
        $ext = strtolower(pathinfo($_FILES["imagem"]["name"], PATHINFO_EXTENSION));
        $permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($ext, $permitidas)):
            $nomeImg = uniqid("parceiro_") . "." . $ext;
            $destino = "uploads/parceiros/" . $nomeImg;

            if (!empty($imagemAntiga) && file_exists("uploads/parceiros/" . $imagemAntiga)):
                unlink("uploads/parceiros/" . $imagemAntiga);
            endif;

            move_uploaded_file($_FILES["imagem"]["tmp_name"], $destino);
        else:
            echo "<script>alert('Formato de imagem não permitido.'); window.open(document.referrer, '_self');</script>";
            exit;
        endif;
    endif;

    if ($nomeImg):
        $Parceiro->setImagem($nomeImg);
    endif;

    if (empty($id)):
        $novoId = $Parceiro->add();

        if ($novoId) {
            echo "<script>
                alert('Cadastro de parceiro realizado com sucesso.');
                window.location.href='listaApoiadores.php';
            </script>";
            exit;
        } else {
            echo "<script>
                alert('Erro ao cadastrar o parceiro.');
                window.open(document.referrer, '_self');
            </script>";
            exit;
        }
    else:
        if ($Parceiro->update("idApoiadores", $id)) {
            echo "<script>
                alert('Parceiro alterado com sucesso.');
                window.location.href='listaApoiadores.php';
            </script>";
            exit;
        } else {
            echo "<script>
                alert('Erro ao alterar o parceiro.');
                window.open(document.referrer, '_self');
            </script>";
            exit;
        }
    endif;

elseif (filter_has_var(INPUT_POST, "btnDeletar")):
    $id = filter_input(INPUT_POST, "idApoiadores", FILTER_VALIDATE_INT);
    $p = $Parceiro->findById($id);

    if ($p && !empty($p->imagem) && file_exists("uploads/parceiros/" . $p->imagem)):
        unlink("uploads/parceiros/" . $p->imagem);
    endif;

    if ($Parceiro->delete("idApoiadores", $id)) {
        echo "<script>
            alert('Parceiro excluído com sucesso.');
            window.location.href='listaApoiadores.php';
        </script>";
        exit;
    } else {
        echo "<script>
            alert('Erro ao excluir parceiro.');
            window.open(document.referrer, '_self');
        </script>";
        exit;
    }

endif;
?>