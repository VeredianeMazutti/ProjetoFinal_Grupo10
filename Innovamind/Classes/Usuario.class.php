<?php
require_once "CRUD.class.php";

class Usuario extends CRUD
{
    protected $table = "usuario";

    private $id;
    private $nomeCompleto;
    private $dataNascimento;
    private $telefone;
    private $areaAtuacao;
    private $nomeExibicao;
    private $email;
    private $senha;
    private $perfil;

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setNomeCompleto($nomeCompleto)
    {
        $this->nomeCompleto = $nomeCompleto;
    }
    public function getNomeCompleto()
    {
        return $this->nomeCompleto;
    }
    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;
    }
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }
    public function getTelefone()
    {
        return $this->telefone;
    }
    public function setAreaAtuacao($areaAtuacao)
    {
        $this->areaAtuacao = $areaAtuacao;
    }
    public function getAreaAtuacao()
    {
        return $this->areaAtuacao;
    }
    public function setNomeExibicao($nomeExibicao)
    {
        $this->nomeExibicao = $nomeExibicao;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getNomeExibicao()
    {
        return $this->nomeExibicao;
    }
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }
    public function getSenha()
    {
        return $this->senha;
    }
    public function setPerfil($perfil)
    {
        $this->perfil = $perfil;
    }
    public function getPerfil()
    {
        return $this->perfil;
    }
    public function findById($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ) ?: null;
    }
    public function add()
    {
        $sql = "INSERT INTO $this->table (nomeCompleto, dataNascimento, telefone, areaAtuacao, nomeExibicao, email, senha, perfil) VALUES (:nomeCompleto, :dataNascimento, :telefone, :areaAtuacao, :nomeExibicao, :email, :senha, :perfil)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nomeCompleto', $this->nomeCompleto);
        $stmt->bindValue(':dataNascimento', $this->dataNascimento);
        $stmt->bindValue(':telefone', $this->telefone);
        $stmt->bindValue(':areaAtuacao', $this->areaAtuacao);
        $stmt->bindValue(':nomeExibicao', $this->nomeExibicao);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':senha', $this->senha);
        $stmt->bindValue(':perfil', $this->perfil);
        return $stmt->execute();
    }
    public function update(string $campo, int $id)
    {
        $sql = "UPDATE $this->table SET nomeCompleto = :nomeCompleto, dataNascimento = :dataNascimento, telefone = :telefone, areaAtuacao = :areaAtuacao, nomeExibicao = :nomeExibicao, email = :email, perfil = :perfil";
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
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':perfil', $this->perfil);
        if (!empty($this->senha)) {
            $stmt->bindValue(':senha', $this->senha);
        }
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
