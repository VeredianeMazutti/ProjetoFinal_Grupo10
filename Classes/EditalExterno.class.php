<?php
require_once "CRUD.class.php";

class EditalExterno extends CRUD
{
    protected $table = "editaisexternos";

    private $idEditalExterno;
    private $nome;
    private $descricao;
    private $link;
    private $categoria; 

    public function setIdEditalExterno($idEditalExterno)
    {
        $this->idEditalExterno = $idEditalExterno;
    }
    public function getIdEditalExterno()
    {
        return $this->idEditalExterno;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function getNome()
    {
        return $this->nome;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }
    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setLink($link)
    {
        $this->link = $link;
    }
    public function getLink()
    {
        return $this->link;
    }

    public function setCategoria($categoria) 
    {
        $this->categoria = $categoria;
    }
    public function getCategoria() 
    {
        return $this->categoria;
    }

    public function add()
    {
        $sql = "INSERT INTO $this->table (nome, descricao, link, categoria)
                VALUES (:nome, :descricao, :link, :categoria)";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':nome', $this->nome);
        $stmt->bindValue(':descricao', $this->descricao);
        $stmt->bindValue(':link', $this->link);
        $stmt->bindValue(':categoria', $this->categoria);

        return $stmt->execute();
    }

    public function update(string $campo, int $id)
    {
        $sql = "UPDATE $this->table SET 
                    nome = :nome,
                    descricao = :descricao,
                    link = :link,
                    categoria = :categoria
                WHERE $campo = :idEditalExterno";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':nome', $this->nome);
        $stmt->bindValue(':descricao', $this->descricao);
        $stmt->bindValue(':link', $this->link);
        $stmt->bindValue(':categoria', $this->categoria);
        $stmt->bindValue(':idEditalExterno', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function listar()
    {
        $sql = "SELECT * FROM $this->table ORDER BY categoria ASC, nome ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
