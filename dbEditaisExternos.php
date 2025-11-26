<?php
spl_autoload_register(function ($class) {
    require_once __DIR__ . "/Classes/{$class}.class.php";
});

$Edital = new EditalExterno();

if (filter_has_var(INPUT_POST, "btnGravar")) {

    $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
    $descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $link = filter_input(INPUT_POST, "link", FILTER_SANITIZE_URL);
    $categoria = filter_input(INPUT_POST, "categoria", FILTER_SANITIZE_STRING);

    $Edital->setId($id);
    $Edital->setNome($nome);
    $Edital->setDescricao($descricao);
    $Edital->setLink($link);
    $Edital->setCategoria($categoria);

    if (empty($id))
        $Edital->add();
    else
        $Edital->update("id", $id);

    echo "<script>alert('Edital salvo com sucesso!');location.href='editarExterno.php';</script>";
    exit;
}

if (filter_has_var(INPUT_GET, "acao") && filter_input(INPUT_GET, "acao") === "deletar") {

    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

    $Edital->delete("id", $id);

    echo "<script>alert('Edital excluído com sucesso!');location.href='editarExterno.php';</script>";
    exit;
}
