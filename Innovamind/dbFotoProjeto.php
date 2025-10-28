<?php
session_start();

spl_autoload_register(function ($class) {
    require_once __DIR__ . "/Classes/{$class}.class.php";
});

$foto = new FotoProjeto();

if (filter_has_var(INPUT_POST, "btnGravar")) {

    $idProjeto = intval(filter_input(INPUT_POST, 'idProjeto'));
    $idFoto = intval(filter_input(INPUT_POST, 'idFoto'));

    $foto->setProjeto($idProjeto);
    $foto->setLegenda(filter_input(INPUT_POST, 'legenda') ?? '');
    $foto->setAlternativo(filter_input(INPUT_POST, 'textoAlt') ?? '');

    $uploadDir = __DIR__ . '/uploads/projetos/';
    if (!is_dir($uploadDir))
        mkdir($uploadDir, 0777, true);

    if (!empty($_FILES['fotoProjeto']['name'])) {
        $tmpName = $_FILES['fotoProjeto']['tmp_name'];
        $ext = pathinfo($_FILES['fotoProjeto']['name'], PATHINFO_EXTENSION);

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $mime = mime_content_type($tmpName);
        if (!in_array($mime, $allowedTypes)) {
            echo "<script>alert('Formato de imagem não permitido.');window.history.back();</script>";
            exit;
        }
        if ($_FILES['fotoProjeto']['size'] > 2 * 1024 * 1024) { // 2MB
            echo "<script>alert('Arquivo muito grande. Máx 2MB.');window.history.back();</script>";
            exit;
        }

        $nomeArquivo = 'proj_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
        $dest = $uploadDir . $nomeArquivo;

        if (!move_uploaded_file($tmpName, $dest)) {
            echo "<script>alert('Erro ao enviar a imagem.');window.history.back();</script>";
            exit;
        }

        $foto->setNome($nomeArquivo);
    }

    $foto->setDataUpload(date("Y-m-d H:i:s"));

    if (empty($idFoto)) {
        $foto->add();
        $msg = "Foto adicionada com sucesso.";
    } else {
        $foto->update("id_foto", $idFoto);
        $msg = "Foto atualizada com sucesso.";
    }

    echo "<script>alert('$msg');window.location.href='fotoProjeto.php?idProjeto=$idProjeto';</script>";
    exit;
}

if (filter_has_var(INPUT_POST, "btnDeletar")) {
    $idFoto = intval(filter_input(INPUT_POST, 'idFoto'));
    $idProjeto = intval(filter_input(INPUT_POST, 'idProjeto'));

    $f = new FotoProjeto();
    $fotoRow = $f->search('id_foto', $idFoto)[0] ?? null;
    if ($fotoRow && !empty($fotoRow->nome)) {
        $arquivo = __DIR__ . '/uploads/projetos/' . $fotoRow->nome;
        if (file_exists($arquivo))
            unlink($arquivo);
    }

    $f->delete("id_foto", $idFoto);

    echo "<script>alert('Foto excluída.');window.location.href='fotoProjeto.php?idProjeto=$idProjeto';</script>";
    exit;
}
