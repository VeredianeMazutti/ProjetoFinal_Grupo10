<?php
require_once "CRUD.class.php";

class Faq extends CRUD
{
    protected $table = "faq";

    private $idFaq;
    private $pergunta;
    private $resposta;

    public function setIdFaq($idFaq)
    {
        $this->idfaq = $idFaq;
    }
    public function getIdFaq()
    {
        return $this->idFaq;
    }

    public function setPergunta($pergunta)
    {
        $this->pergunta = $pergunta;
    }
    public function getPergunta()
    {
        return $this->pergunta;
    }

    public function setResposta($resposta)
    {
        $this->resposta = $resposta;
    }
    public function getResposta()
    {
        return $this->resposta;
    }

    public function findByIdFaq($idFaq)
    {
        $sql = "SELECT * FROM $this->table WHERE idFaq = :idFaq";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':idFaq', $idFaq, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ) ?: null;
    }

    public function add()
    {
        $sql = "INSERT INTO $this->table (pergunta, resposta) VALUES (:pergunta, :resposta)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':pergunta', $this->pergunta);
        $stmt->bindValue(':resposta', $this->resposta);
        return $stmt->execute();
    }

    public function update(string $campo, int $id)
    {
        $sql = "UPDATE $this->table SET pergunta = :pergunta, resposta = :resposta WHERE $campo = :idFaq";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':pergunta', $this->pergunta);
        $stmt->bindValue(':resposta', $this->resposta);
        $stmt->bindValue(':idFaq', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
    public function listar()
    {
        $sql = "SELECT * FROM $this->table ORDER BY idFaq DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
