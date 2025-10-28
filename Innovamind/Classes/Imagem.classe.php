<?php
class Imagem {
    private $prefixo;
    private $uploadDir;
    private $maxSize;
    private $allowed;

    public function __construct($prefixo = 'img_') {
        $this->prefixo = $prefixo;
        $this->uploadDir = __DIR__ . 'uploads';
        $this->maxSize = 2 * 1024 * 1024; // 2MB
        $this->allowed = ['image/jpeg','image/png','image/gif','image/webp'];

        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0755, true);
        }
    }

    public function upload(array $file) {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Erro no upload: ' . $file['error']);
        }
        if ($file['size'] > $this->maxSize) {
            throw new Exception('Arquivo maior que o permitido.');
        }
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file['tmp_name']);
        if (!in_array($mime, $this->allowed)) {
            throw new Exception('Formato de imagem não suportado.');
        }
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $name = $this->prefixo . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
        $dest = $this->uploadDir . $name;
        if (!move_uploaded_file($file['tmp_name'], $dest)) {
            throw new Exception('Falha ao mover o arquivo.');
        }
        return $name;
    }
}
