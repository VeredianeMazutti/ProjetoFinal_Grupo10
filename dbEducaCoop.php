<?php
spl_autoload_register(function ($class) {
    require_once __DIR__ . "/Classes/{$class}.class.php";
});

$Trilha = new EducaCoop();
$uploadDir = 'uploads/trilhas/';

function uploadArquivo($inputName, $uploadDir, $arquivoAntigo = null)
{
    if (!empty($_FILES[$inputName]['name']) && $_FILES[$inputName]['error'] === 0) {
        $extensao = strtolower(pathinfo($_FILES[$inputName]['name'], PATHINFO_EXTENSION));
        $permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($extensao, $permitidas)) {
            $nomeArquivo = uniqid($inputName . "_") . "." . $extensao;
            $destino = $uploadDir . $nomeArquivo;

            if (!empty($arquivoAntigo) && is_file($uploadDir . $arquivoAntigo)) {
                unlink($uploadDir . $arquivoAntigo);
            }

            if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $destino)) {
                return $nomeArquivo;
            }
        }
    }
    return $arquivoAntigo ?: null;
}

if (filter_has_var(INPUT_POST, "btnSalvar")):

    $id = filter_input(INPUT_POST, 'id_trilha', FILTER_VALIDATE_INT);

    $Trilha->setTitulo(filter_input(INPUT_POST, "titulo", FILTER_SANITIZE_STRING));
    $Trilha->setSubtitulo(filter_input(INPUT_POST, "subtitulo", FILTER_SANITIZE_STRING));
    $Trilha->setDescricao(filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_STRING));
    $Trilha->setDuracao(filter_input(INPUT_POST, "duracao", FILTER_SANITIZE_STRING));
    $Trilha->setNivel(filter_input(INPUT_POST, "nivel", FILTER_SANITIZE_STRING));
    $Trilha->setIntroducao(filter_input(INPUT_POST, "introducao", FILTER_UNSAFE_RAW));
    $Trilha->setObjetivos(filter_input(INPUT_POST, "objetivos", FILTER_UNSAFE_RAW));
    $Trilha->setConteudo(filter_input(INPUT_POST, "conteudo", FILTER_UNSAFE_RAW));
    $Trilha->setAutorTrilha(filter_input(INPUT_POST, "autorTrilha", FILTER_SANITIZE_STRING));
    $Trilha->setTagsTrilha(filter_input(INPUT_POST, "tagsTrilha", FILTER_SANITIZE_STRING));
    $Trilha->setReferenciasTrilha(filter_input(INPUT_POST, "referenciasTrilha", FILTER_UNSAFE_RAW));
    $Trilha->setGerarCertificado(filter_input(INPUT_POST, "gerarCertificado", FILTER_VALIDATE_INT));
    $Trilha->setAtivoTrilha(1);

    $imagemAntiga = filter_input(INPUT_POST, 'imagemAntiga');
    $Trilha->setImagemCapa(uploadArquivo('imagemCapa', $uploadDir, $imagemAntiga));

    if (empty($id)):
        $novoId = $Trilha->add();

        if ($novoId) {
            echo "<script>alert('Trilha cadastrada com sucesso!'); window.location.href='cadAvaliacao.php?id_trilha={$novoId}';</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar trilha.'); window.open(document.referrer,'_self');</script>";
        }

    else:
        if ($Trilha->update('id_trilha', $id)) {
            echo "<script>alert('Trilha atualizada com sucesso!'); window.location.href='listaeducacoop.php';</script>";
        } else {
            echo "<script>alert('Erro ao atualizar trilha.'); window.open(document.referrer,'_self');</script>";
        }
    endif;

elseif (filter_has_var(INPUT_POST, "btnDeletar")):
    $id = filter_input(INPUT_POST, "id_trilha", FILTER_VALIDATE_INT);
    $dados = $Trilha->search("id_trilha", $id);

    if ($dados && !empty($dados[0]->imagemCapa) && is_file($uploadDir . $dados[0]->imagemCapa)) {
        unlink($uploadDir . $dados[0]->imagemCapa);
    }

    if ($Trilha->delete("id_trilha", $id)) {
        header("location:trilhas.php");
    } else {
        echo "<script>alert('Erro ao excluir trilha.'); window.open(document.referrer, '_self');</script>";
    }

endif;
