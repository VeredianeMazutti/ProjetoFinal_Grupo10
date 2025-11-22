<?php
spl_autoload_register(function ($class) {
    require_once __DIR__ . "/Classes/{$class}.class.php";
});

$Parceiro = new Apoiadores();

if (isset($_POST["btnGravar"])) {

    $id = filter_input(INPUT_POST, "idApoiadores", FILTER_SANITIZE_NUMBER_INT);
    $tipo = filter_input(INPUT_POST, "tipo");
    $nome = filter_input(INPUT_POST, "nome");
    $descricao = filter_input(INPUT_POST, "descricao");
    $site = filter_input(INPUT_POST, "site", FILTER_SANITIZE_URL);
    $instagram = filter_input(INPUT_POST, "instagram", FILTER_SANITIZE_URL);
    $linkedin = filter_input(INPUT_POST, "linkedin", FILTER_SANITIZE_URL);

    $nomeImg = null;
    if (!empty($_FILES["imagem"]["name"])) {
        $ext = pathinfo($_FILES["imagem"]["name"], PATHINFO_EXTENSION);
        $nomeImg = uniqid() . "." . $ext;
        move_uploaded_file($_FILES["imagem"]["tmp_name"], "uploads/parceiros/" . $nomeImg);
    }

    $Parceiro->setIdApoiadores($id);
    $Parceiro->setTipo($tipo);
    $Parceiro->setNome($nome);
    $Parceiro->setDescricao($descricao);
    $Parceiro->setSite($site);
    $Parceiro->setInstagram($instagram);
    $Parceiro->setLinkedin($linkedin);

    if ($nomeImg) {
        $Parceiro->setImagem($nomeImg);
    }

    if (empty($id))
        $Parceiro->add();
    else
        $Parceiro->update("idApoiadores", $id);

    echo "<script>alert('Parceiro salvo com sucesso!');location.href='apoiadores.php';</script>";
    exit;
}

if (isset($_GET["acao"]) && $_GET["acao"] == "deletar") {

    $id = filter_input(INPUT_GET, "idApoiadores", FILTER_SANITIZE_NUMBER_INT);

    $p = $Parceiro->findById($id);

    if ($p) {
        if (!empty($p->imagem) && file_exists("uploads/parceiros/" . $p->imagem)) {
            unlink("uploads/parceiros/" . $p->imagem);
        }
        $Parceiro->delete("idApoiadores", $id);
    }

    echo "<script>alert('Parceiro excluído!');location.href='apoiadores.php';</script>";
    exit;
}
