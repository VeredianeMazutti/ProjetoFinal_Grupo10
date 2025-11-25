<?php
require_once "CRUD.class.php";

class EditalInterno extends CRUD
{
    protected $table = "editalinterno";

    private $idEditalInterno;
    private $titulo;
    private $descResumida;
    private $descCompleta;
    private $organizacao;
    private $tipoApoio;
    private $dataAbertura;
    private $dataEncerramento;
    private $status;
    private $vagas;
    private $criterios;
    private $participantes;
    private $etapas;
    private $beneficios;
    private $responsavel;
    private $contato;
    private $observacoes;

    public function setIdEditalInterno($idEditalInterno)
    {
        $this->idEditalInterno = $idEditalInterno;
    }
    public function getIdEditalInterno()
    {
        return $this->idEditalInterno;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }
    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setDescResumida($descResumida)
    {
        $this->descResumida = $descResumida;
    }
    public function getDescResumida()
    {
        return $this->descResumida;
    }

    public function setDescCompleta($descCompleta)
    {
        $this->descCompleta = $descCompleta;
    }
    public function getDescCompleta()
    {
        return $this->descCompleta;
    }

    public function setOrganizacao($organizacao)
    {
        $this->organizacao = $organizacao;
    }
    public function getOrganizacao()
    {
        return $this->organizacao;
    }

    public function setTipoApoio($tipoApoio)
    {
        $this->tipoApoio = $tipoApoio;
    }
    public function getTipoApoio()
    {
        return $this->tipoApoio;
    }

    public function setDataAbertura($dataAbertura)
    {
        $this->dataAbertura = $dataAbertura;
    }
    public function getDataAbertura()
    {
        return $this->dataAbertura;
    }

    public function setDataEncerramento($dataEncerramento)
    {
        $this->dataEncerramento = $dataEncerramento;
    }
    public function getDataEncerramento()
    {
        return $this->dataEncerramento;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
    public function getStatus()
    {
        return $this->status;
    }

    public function setVagas($vagas)
    {
        $this->vagas = $vagas;
    }
    public function getVagas()
    {
        return $this->vagas;
    }

    public function setCriterios($criterios)
    {
        $this->criterios = $criterios;
    }
    public function getCriterios()
    {
        return $this->criterios;
    }

    public function setParticipantes($participantes)
    {
        $this->participantes = $participantes;
    }
    public function getParticipantes()
    {
        return $this->participantes;
    }
    public function setEtapas($etapas)
    {
        $this->etapas = $etapas;
    }
    public function getEtapas()
    {
        return $this->etapas;
    }
    public function setBeneficios($beneficios)
    {
        $this->beneficios = $beneficios;
    }
    public function getBeneficios()
    {
        return $this->beneficios;
    }
    public function setResponsavel($responsavel)
    {
        $this->responsavel = $responsavel;
    }
    public function getResponsavel()
    {
        return $this->responsavel;
    }
    public function setContato($contato)
    {
        $this->contato = $contato;
    }
    public function getContato()
    {
        return $this->contato;
    }

    public function setObservacoes($observacoes)
    {
        $this->observacoes = $observacoes;
    }
    public function getObservacoes()
    {
        return $this->observacoes;
    }
    public function findByIdEditalInterno($id)
    {
        $sql = "SELECT * FROM $this->table WHERE idEditalInterno = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ) ?: null;
    }
    public function add()
    {
        $sql = "INSERT INTO $this->table (
                titulo, descResumida, descCompleta,
                organizacao, tipoApoio, dataAbertura, dataEncerramento,
                status, vagas, criterios, participantes, etapas,
                beneficios, responsavel, contato, observacoes
            ) VALUES (
                :titulo, :descResumida, :descCompleta,
                :organizacao, :tipoApoio, :dataAbertura, :dataEncerramento,
                :status, :vagas, :criterios, :participantes, :etapas,
                :beneficios, :responsavel, :contato, :observacoes
            )";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(":titulo", $this->titulo);
        $stmt->bindValue(":descResumida", $this->descResumida);
        $stmt->bindValue(":descCompleta", $this->descCompleta);
        $stmt->bindValue(":organizacao", $this->organizacao);
        $stmt->bindValue(":tipoApoio", $this->tipoApoio);
        $stmt->bindValue(":dataAbertura", $this->dataAbertura);
        $stmt->bindValue(":dataEncerramento", $this->dataEncerramento);
        $stmt->bindValue(":status", $this->status);
        $stmt->bindValue(":vagas", $this->vagas);
        $stmt->bindValue(":criterios", $this->criterios);
        $stmt->bindValue(":participantes", $this->participantes);
        $stmt->bindValue(":etapas", $this->etapas);
        $stmt->bindValue(":beneficios", $this->beneficios);
        $stmt->bindValue(":responsavel", $this->responsavel);
        $stmt->bindValue(":contato", $this->contato);
        $stmt->bindValue(":observacoes", $this->observacoes);

        return $stmt->execute();
    }

    public function update(string $campo, int $id)
    {
        $sql = "UPDATE $this->table SET 
                    titulo = :titulo,
                    descResumida = :descResumida,
                    descCompleta = :descCompleta,
                    organizacao = :organizacao,
                    tipoApoio = :tipoApoio,
                    dataAbertura = :dataAbertura,
                    dataEncerramento = :dataEncerramento,
                    status = :status,
                    vagas = :vagas,
                    criterios = :criterios,
                    participantes = :participantes,
                    etapas = :etapas,
                    beneficios = :beneficios,
                    responsavel = :responsavel,
                    contato = :contato,
                    observacoes = :observacoes
                WHERE idEditalInterno = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(":titulo", $this->titulo);
        $stmt->bindValue(":descResumida", $this->descResumida);
        $stmt->bindValue(":descCompleta", $this->descCompleta);
        $stmt->bindValue(":organizacao", $this->organizacao);
        $stmt->bindValue(":tipoApoio", $this->tipoApoio);
        $stmt->bindValue(":dataAbertura", $this->dataAbertura);
        $stmt->bindValue(":dataEncerramento", $this->dataEncerramento);
        $stmt->bindValue(":status", $this->status);
        $stmt->bindValue(":vagas", $this->vagas);
        $stmt->bindValue(":criterios", $this->criterios);
        $stmt->bindValue(":participantes", $this->participantes);
        $stmt->bindValue(":etapas", $this->etapas);
        $stmt->bindValue(":beneficios", $this->beneficios);
        $stmt->bindValue(":responsavel", $this->responsavel);
        $stmt->bindValue(":contato", $this->contato);
        $stmt->bindValue(":observacoes", $this->observacoes);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
    public function searchAll()
    {
        $sql = "SELECT * FROM editalinterno ORDER BY dataAbertura DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function searchById($id)
    {
        $sql = "SELECT * FROM editalinterno WHERE idEditalInterno = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
