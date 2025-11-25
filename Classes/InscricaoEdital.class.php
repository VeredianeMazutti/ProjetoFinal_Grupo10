<?php
require_once "CRUD.class.php";

class InscricaoEdital extends CRUD
{
    protected $table = "inscricaoedital";

    private $idInscricao;
    private $idEditalInterno;

    private $responsavel;
    private $email;
    private $telefone;
    private $instituicao;

    private $titulo;
    private $resumo;
    private $objetivo;
    private $relato;

    private $status;

    public function setIdInscricao($idInscricao)
    {
        $this->idInscricao = $idInscricao;
    }
    public function getIdInscricao()
    {
        return $this->idInscricao;
    }

    public function setIdEditalInterno($idEditalInterno)
    {
        $this->idEditalInterno = $idEditalInterno;
    }
    public function getIdEditalInterno()
    {
        return $this->idEditalInterno;
    }

    public function setResponsavel($responsavel)
    {
        $this->responsavel = $responsavel;
    }
    public function getResponsavel()
    {
        return $this->responsavel;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }
    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setInstituicao($instituicao)
    {
        $this->instituicao = $instituicao;
    }
    public function getInstituicao()
    {
        return $this->instituicao;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }
    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setResumo($resumo)
    {
        $this->resumo = $resumo;
    }
    public function getResumo()
    {
        return $this->resumo;
    }

    public function setObjetivo($objetivo)
    {
        $this->objetivo = $objetivo;
    }
    public function getObjetivo()
    {
        return $this->objetivo;
    }

    public function setRelato($relato)
    {
        $this->relato = $relato;
    }
    public function getRelato()
    {
        return $this->relato;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
    public function getStatus()
    {
        return $this->status;
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM $this->table WHERE idInscricao = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ) ?: null;
    }

    public function add()
    {
        $sql = "INSERT INTO $this->table (
                idEditalInterno,
                responsavel, email, telefone, instituicao,
                titulo, resumo, objetivo, relato, status
            ) VALUES (
                :idEditalInterno,
                :responsavel, :email, :telefone, :instituicao,
                :titulo, :resumo, :objetivo, :relato, :status
            )";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(":idEditalInterno", $this->idEditalInterno);
        $stmt->bindValue(":responsavel", $this->responsavel);
        $stmt->bindValue(":email", $this->email);
        $stmt->bindValue(":telefone", $this->telefone);
        $stmt->bindValue(":instituicao", $this->instituicao);
        $stmt->bindValue(":titulo", $this->titulo);
        $stmt->bindValue(":resumo", $this->resumo);
        $stmt->bindValue(":objetivo", $this->objetivo);
        $stmt->bindValue(":relato", $this->relato);
        $stmt->bindValue(":status", $this->status);

        return $stmt->execute();
    }

    public function update(string $campo, int $id)
    {
        $sql = "UPDATE $this->table SET 
                    idEditalInterno = :idEditalInterno,
                    responsavel = :responsavel,
                    email = :email,
                    telefone = :telefone,
                    instituicao = :instituicao,
                    titulo = :titulo,
                    resumo = :resumo,
                    objetivo = :objetivo,
                    relato = :relato,
                    status = :status
                WHERE $campo = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(":idEditalInterno", $this->idEditalInterno);
        $stmt->bindValue(":responsavel", $this->responsavel);
        $stmt->bindValue(":email", $this->email);
        $stmt->bindValue(":telefone", $this->telefone);
        $stmt->bindValue(":instituicao", $this->instituicao);
        $stmt->bindValue(":titulo", $this->titulo);
        $stmt->bindValue(":resumo", $this->resumo);
        $stmt->bindValue(":objetivo", $this->objetivo);
        $stmt->bindValue(":relato", $this->relato);
        $stmt->bindValue(":status", $this->status);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function updateStatus(int $idInscricao, string $novoStatus): bool
    {
        $sql = "UPDATE $this->table SET status = :status WHERE idInscricao = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":status", $novoStatus);
        $stmt->bindValue(":id", $idInscricao, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function searchAll()
    {
        $sql = "SELECT * FROM inscricaoedital ORDER BY dataInscricao DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function searchById($idInscricao)
    {
        $sql = "SELECT * FROM inscricaoedital WHERE idInscricao = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(1, $idInscricao);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

}
