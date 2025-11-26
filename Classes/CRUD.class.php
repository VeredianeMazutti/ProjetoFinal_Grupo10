<?php

require_once __DIR__ . "/Database.class.php";

abstract class CRUD
{
    protected $table;
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }
    
    abstract public function add();
    abstract public function update(string $campo, int $id);
    public function all()
    {
        $sql = "SELECT * FROM $this->table";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function search(string $campo, $valor)
    {
        $sql = "SELECT * FROM $this->table WHERE $campo = :valor";
        $stmt = $this->db->prepare($sql);

        if (is_int($valor)) {
            $stmt->bindValue(':valor', $valor, PDO::PARAM_INT);
        } else {
            $stmt->bindValue(':valor', $valor, PDO::PARAM_STR);
        }

        $stmt->execute();
        return $stmt->rowCount() > 0 ? $stmt->fetchAll(PDO::FETCH_OBJ) : null;
    }

    public function delete(string $campo, int $id)
    {
        $sql = "DELETE FROM $this->table WHERE $campo = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("id", $id, PDO::PARAM_INT);
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao excluir registro' . $e->getMessage());
            return false;
        }
    }
}