<?php
session_start();

spl_autoload_register(function ($class) {
    require_once __DIR__ . "/Classes/{$class}.class.php";
});

$EditalExterno = new EditalExterno();

if (filter_has_var(INPUT_POST, "btnGravar")):
    $idEditalExterno = filter_input(INPUT_POST, "idEditalExterno", FILTER_SANITIZE_NUMBER_INT);

    $EditalExterno->setNome(filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING));
    $EditalExterno->setDescricao(filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_STRING));
    $EditalExterno->setLink(filter_input(INPUT_POST, "link", FILTER_SANITIZE_STRING));
    $EditalExterno->setCategoria(filter_input(INPUT_POST, "categoria", FILTER_SANITIZE_STRING));

    if (empty($idEditalExterno)):
        if ($EditalExterno->add()) {
            echo "<script>
                alert('Cadastro de edital realizado com sucesso.');
                window.location.href='listaEditaisExternos.php';
            </script>";
        } else {
            echo "<script>
                alert('Erro ao cadastrar o edital.');
                window.open(document.referrer,'_self');
            </script>";
        }
    else:
        if ($EditalExterno->update('idEditalExterno', $idEditalExterno)) {
            echo "<script>
                alert('Edital alterado com sucesso.');
                window.location.href='listaEditaisExternos.php';
            </script>";
        } else {
            echo "<script>
                alert('Erro ao alterar o edital.');
                window.open(document.referrer,'_self');
            </script>";
        }
    endif;

elseif (filter_has_var(INPUT_POST, "btnDeletar")):
    $idEditalExterno = intval(filter_input(INPUT_POST, "idEditalExterno"));
    if ($EditalExterno->delete("idEditalExterno", $idEditalExterno)) {
        echo "<script>
            alert('Edital excluído com sucesso.');
            window.location.href='listaEditaisExternos.php';
        </script>";
    } else {
        echo "<script>
            alert('Erro ao excluir');
            window.open(document.referrer, '_self');
        </script>";
    }
endif;
?>