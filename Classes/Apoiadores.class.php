<?php
require_once "CRUD.class.php";

class Apoiadores extends CRUD
{
    protected $table = "apoiadores";
    private $idApoiadores;
    private $tipo;
    private $nome;
    private $descricao;
    private $imagem;
    private $site;
    private $instagram;
    private $linkedin;

    public function setIdApoiadores($id)
    {
        $this->idApoiadores = $id;
    }
    public function getIdApoiadores()
    {
        return $this->idApoiadores;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }
    public function getTipo()
    {
        return $this->tipo;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function getNome()
    {
        return $this->nome;
    }

    public function setDescricao($desc)
    {
        $this->descricao = $desc;
    }
    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setImagem($img)
    {
        $this->imagem = $img;
    }
    public function getImagem()
    {
        return $this->imagem;
    }

    public function setSite($site)
    {
        $this->site = $site;
    }
    public function getSite()
    {
        return $this->site;
    }

    public function setInstagram($insta)
    {
        $this->instagram = $insta;
    }
    public function getInstagram()
    {
        return $this->instagram;
    }

    public function setLinkedin($linkedin)
    {
        $this->linkedin = $linkedin;
    }
    public function getLinkedin()
    {
        return $this->linkedin;
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM $this->table WHERE idApoiadores = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ) ?: null;
    }

    public function add()
    {
        $sql = "INSERT INTO $this->table 
        (tipo, nome,  descricao, imagem, site, instagram, linkedin)
        VALUES
        (:tipo, :nome, :descricao, :imagem, :site, :instagram, :linkedin)";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(":tipo", $this->tipo);
        $stmt->bindValue(":nome", $this->nome);
        $stmt->bindValue(":descricao", $this->descricao);
        $stmt->bindValue(":imagem", $this->imagem);
        $stmt->bindValue(":site", $this->site);
        $stmt->bindValue(":instagram", $this->instagram);
        $stmt->bindValue(":linkedin", $this->linkedin);

        return $stmt->execute();
    }

    public function update(string $campo, int $id)
    {
        $sql = "UPDATE $this->table SET
                tipo = :tipo,
                nome = :nome,
                descricao = :descricao,
                site = :site,
                instagram = :instagram,
                linkedin = :linkedin";

        if ($this->imagem != null) {
            $sql .= ", imagem = :imagem";
        }

        $sql .= " WHERE $campo = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(":tipo", $this->tipo);
        $stmt->bindValue(":nome", $this->nome);
        $stmt->bindValue(":descricao", $this->descricao);
        $stmt->bindValue(":site", $this->site);
        $stmt->bindValue(":instagram", $this->instagram);
        $stmt->bindValue(":linkedin", $this->linkedin);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        if ($this->imagem != null) {
            $stmt->bindValue(":imagem", $this->imagem);
        }

        return $stmt->execute();
    }
    public function listar()
    {
        $sql = "SELECT * FROM $this->table ORDER BY nome ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}