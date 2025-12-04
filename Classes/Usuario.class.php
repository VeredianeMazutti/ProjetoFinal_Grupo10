<?php
require_once "CRUD.class.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Usuario extends CRUD
{
    protected $table = "usuario";

    private $id;
    private $nomeCompleto;
    private $dataNascimento;
    private $telefone;
    private $areaAtuacao;
    private $nomeExibicao;
    private $foto; 
    private $email;
    private $senha;
    private $perfil;

    // 🔵 NOVO – CAMPOS DE LGPD
    private $aceitouTermos;
    private $aceitouPolitica;
    private $dataAceite;

    // ---------------- GETTERS E SETTERS --------------------

    public function setId($id){ $this->id = $id; }
    public function getId(){ return $this->id; }

    public function setNomeCompleto($nomeCompleto){ $this->nomeCompleto = $nomeCompleto; }
    public function getNomeCompleto(){ return $this->nomeCompleto; }

    public function setDataNascimento($dataNascimento){ $this->dataNascimento = $dataNascimento; }
    public function getDataNascimento(){ return $this->dataNascimento; }

    public function setTelefone($telefone){ $this->telefone = $telefone; }
    public function getTelefone(){ return $this->telefone; }

    public function setAreaAtuacao($areaAtuacao){ $this->areaAtuacao = $areaAtuacao; }
    public function getAreaAtuacao(){ return $this->areaAtuacao; }

    public function setNomeExibicao($nomeExibicao){ $this->nomeExibicao = $nomeExibicao; }
    public function getNomeExibicao(){ return $this->nomeExibicao; }

    public function setFoto($foto){ $this->foto = $foto; }
    public function getFoto(){ return $this->foto; }

    public function setEmail($email){ $this->email = $email; }
    public function getEmail(){ return $this->email; }

    public function setSenha($senha){ $this->senha = $senha; }
    public function getSenha(){ return $this->senha; }

    public function setPerfil($perfil){ $this->perfil = $perfil; }
    public function getPerfil(){ return $this->perfil; }

    // 🔵 NOVOS GETTERS E SETTERS LGPD
    public function setAceitouTermos($v){ $this->aceitouTermos = $v; }
    public function getAceitouTermos(){ return $this->aceitouTermos; }

    public function setAceitouPolitica($v){ $this->aceitouPolitica = $v; }
    public function getAceitouPolitica(){ return $this->aceitouPolitica; }

    public function setDataAceite($v){ $this->dataAceite = $v; }
    public function getDataAceite(){ return $this->dataAceite; }

    // ---------------- MÉTODOS DE BANCO --------------------

    public function findById($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ) ?: null;
    }

    // 🟡 EDITADO – ADICIONANDO CAMPOS LGPD
    public function add()
    {
        $sql = "INSERT INTO $this->table
        (nomeCompleto, dataNascimento, telefone, areaAtuacao, nomeExibicao, foto, email, senha, perfil,
         aceitouTermos, aceitouPolitica, dataAceite)
        VALUES
        (:nomeCompleto, :dataNascimento, :telefone, :areaAtuacao, :nomeExibicao, :foto, :email, :senha, :perfil,
         :aceitouTermos, :aceitouPolitica, :dataAceite)";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':nomeCompleto', $this->nomeCompleto);
        $stmt->bindValue(':dataNascimento', $this->dataNascimento);
        $stmt->bindValue(':telefone', $this->telefone);
        $stmt->bindValue(':areaAtuacao', $this->areaAtuacao);
        $stmt->bindValue(':nomeExibicao', $this->nomeExibicao);
        $stmt->bindValue(':foto', $this->foto);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':senha', $this->senha);
        $stmt->bindValue(':perfil', $this->perfil);

        // 🔵 NOVO
        $stmt->bindValue(':aceitouTermos', $this->aceitouTermos);
        $stmt->bindValue(':aceitouPolitica', $this->aceitouPolitica);
        $stmt->bindValue(':dataAceite', $this->dataAceite);

        return $stmt->execute();
    }

    // 🟡 EDITADO – INCLUINDO CAMPOS LGPD NO UPDATE
    public function update(string $campo, int $id)
    {
        $sql = "UPDATE $this->table SET
            nomeCompleto = :nomeCompleto,
            dataNascimento = :dataNascimento,
            telefone = :telefone,
            areaAtuacao = :areaAtuacao,
            nomeExibicao = :nomeExibicao,
            foto = :foto,
            email = :email,
            perfil = :perfil,
            aceitouTermos = :aceitouTermos,
            aceitouPolitica = :aceitouPolitica,
            dataAceite = :dataAceite";

        if (!empty($this->senha)) {
            $sql .= ", senha = :senha";
        }

        $sql .= " WHERE $campo = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':nomeCompleto', $this->nomeCompleto);
        $stmt->bindValue(':dataNascimento', $this->dataNascimento);
        $stmt->bindValue(':telefone', $this->telefone);
        $stmt->bindValue(':areaAtuacao', $this->areaAtuacao);
        $stmt->bindValue(':nomeExibicao', $this->nomeExibicao);
        $stmt->bindValue(':foto', $this->foto);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':perfil', $this->perfil);

        // 🔵 NOVO
        $stmt->bindValue(':aceitouTermos', $this->aceitouTermos);
        $stmt->bindValue(':aceitouPolitica', $this->aceitouPolitica);
        $stmt->bindValue(':dataAceite', $this->dataAceite);

        if (!empty($this->senha)) {
            $stmt->bindValue(':senha', $this->senha);
        }

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }


    // --------------------------------------------------
    // Os demais métodos (recuperação de senha etc.)
    // continuam IGUAIS sem alterações.
    // --------------------------------------------------

}
