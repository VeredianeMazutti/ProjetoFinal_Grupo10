<?php

class Projeto extends CRUD
{
    protected $table = "projetos";
    private $id;
    private $fk_usuario;
    private $nomeProjeto;
    private $nomeResponsavel;
    private $nomeColaboradores;
    private $nomeInstituicao;
    private $emailProjeto;
    private $localizacaoEstado;
    private $categoria;
    private $breveDescricao;
    private $faseDesenvolvimento;
    private $contribuicao;
    private $descricaoDetalhada;
    private $linksProjeto;

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setFkUsuario($fk_usuario)
    {
        $this->fk_usuario = $fk_usuario;
    }
    public function getFkUsuario()
    {
        return $this->fk_usuario;
    }

    public function setNomeProjeto($nomeProjeto)
    {
        $this->nomeProjeto = $nomeProjeto;
    }
    public function getNomeProjeto()
    {
        return $this->nomeProjeto;
    }

    public function setNomeResponsavel($nomeResponsavel)
    {
        $this->nomeResponsavel = $nomeResponsavel;
    }
    public function getNomeResponsavel()
    {
        return $this->nomeResponsavel;
    }
      public function setNomeColaboradores($nomeColaboradores)
    {
        $this->nomeColaboradores = $nomeColaboradores;
    }
    public function getNomeColaboradores()
    {
        return $this->nomeColaboradores;
    }

       public function setNomeInstituicao($nomeInstituicao)
    {
        $this->nomeInstituicao = $nomeInstituicao;
    }
    public function getNomeInstituicao()
    {
        return $this->nomeInstituicao;
    }

    public function setEmailProjeto($emailProjeto)
    {
        $this->emailProjeto = $emailProjeto;
    }
    public function getEmailProjeto()
    {
        return $this->emailProjeto;
    }
     public function setLocalizacaoEstado($localizacaoEstado)
    {
        $this->localizacaoEstado = $localizacaoEstado;
    }
    public function getLocalizacaoEstado()
    {
        return $this->localizacaoEstado;
    }

    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }
    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setBreveDescricao($breveDescricao)
    {
        $this->breveDescricao = $breveDescricao;
    }
    public function getBreveDescricao()
    {
        return $this->breveDescricao;
    }

    public function setFaseDesenvolvimento($faseDesenvolvimento)
    {
        $this->faseDesenvolvimento = $faseDesenvolvimento;
    }
    public function getFaseDesenvolvimento()
    {
        return $this->faseDesenvolvimento;
    }

    public function setContribuicao($contribuicao)
    {
        $this->contribuicao = $contribuicao;
    }
    public function getContribuicao()
    {
        return $this->contribuicao;
    }

    public function setDescricaoDetalhada($descricaoDetalhada)
    {
        $this->descricaoDetalhada = $descricaoDetalhada;
    }
    public function getDescricaoDetalhada()
    {
        return $this->descricaoDetalhada;
    }
     public function setLinksProjeto($linksProjeto)
    {
        $this->linksProjeto = $linksProjeto;
    }
    public function getLinksProjeto()
    {
        return $this->linksProjeto;
    }

    public function add()
    {
        $sql = "INSERT INTO $this->table 
                (fk_usuario, nomeProjeto, nomeResponsavel, nomeColaboradores, nomeInstituicao, emailProjeto, localizacaoEstado, categoria, breveDescricao, faseDesenvolvimento, contribuicao, descricaoDetalhada, linksProjeto) 
                VALUES 
                (:fk_usuario, :nomeProjeto, :nomeResponsavel, :nomeColaboradores, :nomeInstituicao, :emailProjeto, :localizacaoEstado,  :categoria, :breveDescricao, :faseDesenvolvimento, :contribuicao, :descricaoDetalhada, :linksProjeto)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':fk_usuario', $this->fk_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':nomeProjeto', $this->nomeProjeto, PDO::PARAM_STR);
        $stmt->bindParam(':nomeResponsavel', $this->nomeResponsavel, PDO::PARAM_STR);
        $stmt->bindParam(':nomeColaboradores', $this->nomeColaboradores, PDO::PARAM_STR);
        $stmt->bindParam(':nomeInstituicao', $this->nomeInstituicao, PDO::PARAM_STR);
        $stmt->bindParam(':emailProjeto', $this->emailProjeto, PDO::PARAM_STR);
        $stmt->bindParam(':localizacaoEstado', $this->localizacaoEstado, PDO::PARAM_STR);
        $stmt->bindParam(':categoria', $this->categoria, PDO::PARAM_STR);
        $stmt->bindParam(':breveDescricao', $this->breveDescricao, PDO::PARAM_STR);
        $stmt->bindParam(':faseDesenvolvimento', $this->faseDesenvolvimento, PDO::PARAM_STR);
        $stmt->bindParam(':contribuicao', $this->contribuicao, PDO::PARAM_STR);
        $stmt->bindParam(':descricaoDetalhada', $this->descricaoDetalhada, PDO::PARAM_STR);
        $stmt->bindParam(':linksProjeto', $this->linksProjeto, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function update(string $campo, int $id)
    {
        $sql = "UPDATE $this->table SET 
                    nomeProjeto = :nomeProjeto, 
                    nomeResponsavel = :nomeResponsavel, 
                    nomeColaboradores = :nomeColaboradores,
                    nomeInstituicao = :nomeInstituicao,
                    emailProjeto = :emailProjeto, 
                    localizacaoEstado = :localizacaoEstado,
                    categoria = :categoria, 
                    breveDescricao = :breveDescricao, 
                    faseDesenvolvimento = :faseDesenvolvimento, 
                    contribuicao = :contribuicao, 
                    descricaoDetalhada = :descricaoDetalhada,
                    linksProjeto = :linksProjeto
                WHERE $campo = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nomeProjeto', $this->nomeProjeto, PDO::PARAM_STR);
        $stmt->bindParam(':nomeResponsavel', $this->nomeResponsavel, PDO::PARAM_STR);
        $stmt->bindParam(':nomeColaboradores', $this->nomeColaboradores, PDO::PARAM_STR);
        $stmt->bindParam(':nomeInstituicao', $this->nomeInstituicao, PDO::PARAM_STR);
        $stmt->bindParam(':emailProjeto', $this->emailProjeto, PDO::PARAM_STR);
        $stmt->bindParam(':localizacaoEstado', $this->localizacaoEstado, PDO::PARAM_STR);
        $stmt->bindParam(':categoria', $this->categoria, PDO::PARAM_STR);
        $stmt->bindParam(':breveDescricao', $this->breveDescricao, PDO::PARAM_STR);
        $stmt->bindParam(':faseDesenvolvimento', $this->faseDesenvolvimento, PDO::PARAM_STR);
        $stmt->bindParam(':contribuicao', $this->contribuicao, PDO::PARAM_STR);
        $stmt->bindParam(':descricaoDetalhada', $this->descricaoDetalhada, PDO::PARAM_STR);
        $stmt->bindParam(':linksProjeto', $this->linksProjeto, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
    public function lastInsertId()
    {
        return $this->db->lastInsertId();
    }
    public function searchAll()
    {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function listarRecentes($limite = 6)
    {
        $sql = "SELECT * FROM projetos ORDER BY id DESC LIMIT :limite";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":limite", (int) $limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function searchByFilters(?string $categoria, ?string $fase)
    {
        $conditions = [];
        $params = [];

        if ($categoria && $categoria != 'todas') {
            $conditions[] = 'categoria = :categoria';
            $params[':categoria'] = $categoria;
        }

        if ($fase && $fase != 'todas') {
            $conditions[] = 'faseDesenvolvimento = :fase';
            $params[':fase'] = $fase;
        }

        $sql = "SELECT * FROM {$this->table}";
        if (count($conditions) > 0) {
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }
        $sql .= " ORDER BY id DESC";

        $stmt = $this->db->prepare($sql);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val, PDO::PARAM_STR);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
