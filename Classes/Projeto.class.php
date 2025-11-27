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
    private $visualizacoes;

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

    public function setVisualizacoes($visualizacoes)
    {
        $this->visualizacoes = $visualizacoes;
    }
    public function getVisualizacoes()
    {
        return $this->visualizacoes;
    }


    public function add()
    {
        $sql = "INSERT INTO $this->table 
                (fk_usuario, nomeProjeto, nomeResponsavel, nomeColaboradores, nomeInstituicao, emailProjeto, 
                localizacaoEstado, categoria, breveDescricao, faseDesenvolvimento, contribuicao, 
                descricaoDetalhada, linksProjeto, visualizacoes)
                VALUES
                (:fk_usuario, :nomeProjeto, :nomeResponsavel, :nomeColaboradores, :nomeInstituicao, :emailProjeto,
                :localizacaoEstado, :categoria, :breveDescricao, :faseDesenvolvimento, :contribuicao,
                :descricaoDetalhada, :linksProjeto, :visualizacoes)";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':fk_usuario', $this->fk_usuario);
        $stmt->bindParam(':nomeProjeto', $this->nomeProjeto);
        $stmt->bindParam(':nomeResponsavel', $this->nomeResponsavel);
        $stmt->bindParam(':nomeColaboradores', $this->nomeColaboradores);
        $stmt->bindParam(':nomeInstituicao', $this->nomeInstituicao);
        $stmt->bindParam(':emailProjeto', $this->emailProjeto);
        $stmt->bindParam(':localizacaoEstado', $this->localizacaoEstado);
        $stmt->bindParam(':categoria', $this->categoria);
        $stmt->bindParam(':breveDescricao', $this->breveDescricao);
        $stmt->bindParam(':faseDesenvolvimento', $this->faseDesenvolvimento);
        $stmt->bindParam(':contribuicao', $this->contribuicao);
        $stmt->bindParam(':descricaoDetalhada', $this->descricaoDetalhada);
        $stmt->bindParam(':linksProjeto', $this->linksProjeto);
        $stmt->bindParam(':visualizacoes', $this->visualizacoes);

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
                linksProjeto = :linksProjeto,
                visualizacoes = :visualizacoes
                WHERE $campo = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':nomeProjeto', $this->nomeProjeto);
        $stmt->bindParam(':nomeResponsavel', $this->nomeResponsavel);
        $stmt->bindParam(':nomeColaboradores', $this->nomeColaboradores);
        $stmt->bindParam(':nomeInstituicao', $this->nomeInstituicao);
        $stmt->bindParam(':emailProjeto', $this->emailProjeto);
        $stmt->bindParam(':localizacaoEstado', $this->localizacaoEstado);
        $stmt->bindParam(':categoria', $this->categoria);
        $stmt->bindParam(':breveDescricao', $this->breveDescricao);
        $stmt->bindParam(':faseDesenvolvimento', $this->faseDesenvolvimento);
        $stmt->bindParam(':contribuicao', $this->contribuicao);
        $stmt->bindParam(':descricaoDetalhada', $this->descricaoDetalhada);
        $stmt->bindParam(':linksProjeto', $this->linksProjeto);
        $stmt->bindParam(':visualizacoes', $this->visualizacoes);

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
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function listarRecentes($limite = 6)
    {
        $sql = "SELECT * FROM projetos ORDER BY id DESC LIMIT :limite";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":limite", $limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function searchByFilters(?string $categoria, ?string $fase, ?string $estado)
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

        if ($estado && $estado != 'todas') {
            $conditions[] = 'localizacaoEstado = :estado';
            $params[':estado'] = $estado;
        }

        $sql = "SELECT * FROM {$this->table}";
        if ($conditions)
            $sql .= " WHERE " . implode(" AND ", $conditions);
        $sql .= " ORDER BY id DESC";

        $stmt = $this->db->prepare($sql);

        foreach ($params as $p => $v) {
            $stmt->bindValue($p, $v);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function formatarCampo($valor, $tipo)
    {
        if (!$valor)
            return "";

        $mapas = [
            "estado" => [
                "acre" => "Acre",
                "alagoas" => "Alagoas",
                "amapa" => "Amapá",
                "amazonas" => "Amazonas",
                "bahia" => "Bahia",
                "ceara" => "Ceará",
                "distrito_federal" => "Distrito Federal",
                "espirito_santo" => "Espírito Santo",
                "goias" => "Goiás",
                "maranhao" => "Maranhão",
                "mato_grosso" => "Mato Grosso",
                "mato_grosso_do_sul" => "Mato Grosso do Sul",
                "minas_gerais" => "Minas Gerais",
                "para" => "Pará",
                "paraiba" => "Paraíba",
                "parana" => "Paraná",
                "pernambuco" => "Pernambuco",
                "piaui" => "Piauí",
                "rio_de_janeiro" => "Rio de Janeiro",
                "rio_grande_do_norte" => "Rio Grande do Norte",
                "rio_grande_do_sul" => "Rio Grande do Sul",
                "rondonia" => "Rondônia",
                "roraima" => "Roraima",
                "santa_catarina" => "Santa Catarina",
                "sao_paulo" => "São Paulo",
                "sergipe" => "Sergipe",
                "tocantins" => "Tocantins"
            ],

            "categoria" => [
                "sustentabilidade" => "Sustentabilidade e Meio Ambiente",
                "educacao" => "Educação e Capacitação",
                "tecnologia" => "Tecnologia e Inovação",
                "impacto_social" => "Impacto Social e Comunidade",
                "saude" => "Saúde e Bem-Estar",
                "cultura" => "Cultura e Artes",
                "empreendedorismo" => "Empreendedorismo e Negócios",
                "cidadania" => "Cidadania Global e Futuro",
                "comunicacao" => "Comunicação e Mídia",
                "economia" => "Economia e Mercado",
                "ciencias" => "Ciências e Pesquisa",
                "entretenimento" => "Entretenimento e Experiências",
                "sociedade" => "Sociedade e Políticas",
                "outras" => "Outras",
            ],

            "fase" => [
                "ideia" => "Ideia",
                "planejamento" => "Planejamento",
                "em_andamento" => "Em andamento",
                "concluido" => "Concluído",
            ]
        ];

        return $mapas[$tipo][$valor] ?? $valor;
    }


    public function curtir(int $idProjeto, $idUsuario = null, $visitanteHash = null)
    {
        $sql = "INSERT INTO projetoCurtidas (fk_idProjeto, fk_idUsuario, visitanteHash)
                VALUES (:p, :u, :v)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':p', $idProjeto);
        $stmt->bindValue(':u', $idUsuario, $idUsuario === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':v', $visitanteHash, $visitanteHash === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function descurtir(int $idProjeto, $idUsuario = null, $visitanteHash = null)
    {
        $sql = "DELETE FROM projetoCurtidas 
                WHERE fk_idProjeto = :p 
                AND (fk_idUsuario = :u OR visitanteHash = :v)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':p', $idProjeto);
        $stmt->bindValue(':u', $idUsuario);
        $stmt->bindValue(':v', $visitanteHash);
        return $stmt->execute();
    }

    public function jaCurtiu(int $idProjeto, $idUsuario = null, $visitanteHash = null): bool
    {
        $sql = "SELECT 1 FROM projetoCurtidas 
                WHERE fk_idProjeto = :p 
                AND (fk_idUsuario = :u OR visitanteHash = :v)
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':p', $idProjeto);
        $stmt->bindValue(':u', $idUsuario);
        $stmt->bindValue(':v', $visitanteHash);
        $stmt->execute();
        return ($stmt->fetch() !== false);
    }

    public function contarCurtidas(int $idProjeto): int
    {
        $sql = "SELECT COUNT(*) FROM projetoCurtidas WHERE fk_idProjeto = :p";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':p', $idProjeto);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }


    public function incrementarVisualizacaoById(int $id)
    {
        $sql = "UPDATE {$this->table} SET visualizacoes = visualizacoes + 1 WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    public function getContadoresById(int $idProjeto)
    {
        $sql = "SELECT 
                (SELECT COUNT(*) FROM projetoCurtidas WHERE fk_idProjeto = :id) AS curtidas,
                (SELECT visualizacoes FROM {$this->table} WHERE id = :id) AS visualizacoes
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $idProjeto);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
