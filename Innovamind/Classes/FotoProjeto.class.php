<?php
class FotoProjeto extends CRUD
{
    protected $table = 'fotoProjeto';
    private $idFoto;
    private $projeto;
    private $nome;
    private $legenda;
    private $alternativo;
    private $dataUpload;

    public function getIdFoto()
    {
        return $this->idFoto;
    }
    public function setIdFoto($idFoto)
    {
        $this->idFoto = $idFoto;
    }

    public function getProjeto()
    {
        return $this->projeto;
    }
    public function setProjeto($projeto)
    {
        $this->projeto = $projeto;
    }

    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getLegenda()
    {
        return $this->legenda;
    }
    public function setLegenda($legenda)
    {
        $this->legenda = $legenda;
    }

    public function getAlternativo()
    {
        return $this->alternativo;
    }
    public function setAlternativo($alternativo)
    {
        $this->alternativo = $alternativo;
    }

    public function getDataUpload()
    {
        return $this->dataUpload;
    }
    public function setDataUpload($dataUpload)
    {
        $this->dataUpload = $dataUpload;
    }

    public function add()
    {
        $sql = "INSERT INTO fotoProjeto (fk_projeto, nome, legenda, alternativo, data_upload) 
                VALUES (:projeto, :nome, :legenda, :alternativo, :dataUpload)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":projeto", $this->projeto);
        $stmt->bindValue(":nome", $this->nome);
        $stmt->bindValue(":legenda", $this->legenda);
        $stmt->bindValue(":alternativo", $this->alternativo);
        $stmt->bindValue(":dataUpload", $this->dataUpload);
        return $stmt->execute();
    }

    public function update(string $campo, int $id)
    {
        $sql = "UPDATE fotoProjeto 
                SET fk_projeto = :projeto, nome = :nome, legenda = :legenda, alternativo = :alternativo 
                WHERE id_foto = :idFoto";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":projeto", $this->projeto);
        $stmt->bindValue(":nome", $this->nome);
        $stmt->bindValue(":legenda", $this->legenda);
        $stmt->bindValue(":alternativo", $this->alternativo);
        $stmt->bindValue(":idFoto", $id);
        return $stmt->execute();
    }

    public function fotosProjeto(int $idProjeto)
    {
        $sql = "SELECT * FROM $this->table WHERE fk_projeto = :fk_projeto";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':fk_projeto', $idProjeto);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
