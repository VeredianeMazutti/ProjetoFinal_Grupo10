<?php

class EducaCoop extends CRUD
{
    protected $table = "trilha";

    private $id_trilha;
    private $titulo;
    private $subtitulo;
    private $descricao;
    private $duracao;
    private $nivel;
    private $introducao;
    private $objetivos;
    private $conteudo;
    private $imagemCapa;
    private $tituloAvaliacao;
    private $pontuacaoMinima;
    private $perguntasTrilha;
    private $mensagemConclusao;
    private $gerarCertificado = true;
    private $autorTrilha;
    private $tagsTrilha;
    private $referenciasTrilha;
    private $ativoTrilha;

    public function setIdTrilha($id_trilha)
    {
        $this->id_trilha = $id_trilha;
    }
    public function getIdTrilha()
    {
        return $this->id_trilha;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }
    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setSubtitulo($subtitulo)
    {
        $this->subtitulo = $subtitulo;
    }
    public function getSubtitulo()
    {
        return $this->subtitulo;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }
    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDuracao($duracao)
    {
        $this->duracao = $duracao;
    }
    public function getDuracao()
    {
        return $this->duracao;
    }

    public function setNivel($nivel)
    {
        $this->nivel = $nivel;
    }
    public function getNivel()
    {
        return $this->nivel;
    }

    public function setIntroducao($introducao)
    {
        $this->introducao = $introducao;
    }
    public function getIntroducao()
    {
        return $this->introducao;
    }

    public function setObjetivos($objetivos)
    {
        $this->objetivos = $objetivos;
    }
    public function getObjetivos()
    {
        return $this->objetivos;
    }

    public function setConteudo($conteudo)
    {
        $this->conteudo = $conteudo;
    }
    public function getConteudo()
    {
        return $this->conteudo;
    }

    public function setImagemCapa($imagemCapa)
    {
        $this->imagemCapa = $imagemCapa;
    }
    public function getImagemCapa()
    {
        return $this->imagemCapa;
    }

    public function setTituloAvaliacao($tituloAvaliacao)
    {
        $this->tituloAvaliacao = $tituloAvaliacao;
    }
    public function getTituloAvaliacao()
    {
        return $this->tituloAvaliacao;
    }

    public function setPontuacaoMinima($pontuacaoMinima)
    {
        $this->pontuacaoMinima = $pontuacaoMinima;
    }
    public function getPontuacaoMinima()
    {
        return $this->pontuacaoMinima;
    }

    public function setPerguntasTrilha($perguntasTrilha)
    {
        $this->perguntasTrilha = $perguntasTrilha;
    }
    public function getPerguntasTrilha()
    {
        return $this->perguntasTrilha;
    }

    public function setMensagemConclusao($mensagemConclusao)
    {
        $this->mensagemConclusao = $mensagemConclusao;
    }
    public function getMensagemConclusao()
    {
        return $this->mensagemConclusao;
    }

    public function setGerarCertificado($gerarCertificado)
    {
        $this->gerarCertificado = $gerarCertificado;
    }
    public function getGerarCertificado()
    {
        return $this->gerarCertificado;
    }

    public function setAutorTrilha($autorTrilha)
    {
        $this->autorTrilha = $autorTrilha;
    }
    public function getAutorTrilha()
    {
        return $this->autorTrilha;
    }

    public function setTagsTrilha($tagsTrilha)
    {
        $this->tagsTrilha = $tagsTrilha;
    }
    public function getTagsTrilha()
    {
        return $this->tagsTrilha;
    }

    public function setReferenciasTrilha($referenciasTrilha)
    {
        $this->referenciasTrilha = $referenciasTrilha;
    }
    public function getReferenciasTrilha()
    {
        return $this->referenciasTrilha;
    }

    public function setAtivoTrilha($ativoTrilha)
    {
        $this->ativoTrilha = $ativoTrilha;
    }
    public function getAtivoTrilha()
    {
        return $this->ativoTrilha;
    }

    public function add()
    {
        $sql = "INSERT INTO $this->table 
            (titulo, subtitulo, descricao, duracao, nivel, introducao, objetivos, conteudo, imagemCapa, tituloAvaliacao, pontuacaoMinima, perguntasTrilha, mensagemConclusao, gerarCertificado, autorTrilha, tagsTrilha, referenciasTrilha, ativoTrilha)
            VALUES
            (:titulo, :subtitulo, :descricao, :duracao, :nivel, :introducao, :objetivos, :conteudo, :imagemCapa, :tituloAvaliacao, :pontuacaoMinima, :perguntasTrilha, :mensagemConclusao, :gerarCertificado, :autorTrilha, :tagsTrilha, :referenciasTrilha, :ativoTrilha)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':subtitulo', $this->subtitulo);
        $stmt->bindParam(':descricao', $this->descricao);
        $stmt->bindParam(':duracao', $this->duracao);
        $stmt->bindParam(':nivel', $this->nivel);
        $stmt->bindParam(':introducao', $this->introducao);
        $stmt->bindParam(':objetivos', $this->objetivos);
        $stmt->bindParam(':conteudo', $this->conteudo);
        $stmt->bindParam(':imagemCapa', $this->imagemCapa);
        $stmt->bindParam(':tituloAvaliacao', $this->tituloAvaliacao);
        $stmt->bindParam(':pontuacaoMinima', $this->pontuacaoMinima, PDO::PARAM_INT);
        $stmt->bindParam(':perguntasTrilha', $this->perguntasTrilha);
        $stmt->bindParam(':mensagemConclusao', $this->mensagemConclusao);
        $stmt->bindParam(':gerarCertificado', $this->gerarCertificado, PDO::PARAM_INT);
        $stmt->bindParam(':autorTrilha', $this->autorTrilha);
        $stmt->bindParam(':tagsTrilha', $this->tagsTrilha);
        $stmt->bindParam(':referenciasTrilha', $this->referenciasTrilha);
        $stmt->bindParam(':ativoTrilha', $this->ativoTrilha, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function update(string $campo, int $id)
    {
        $sql = "UPDATE $this->table SET 
            titulo = :titulo,
            subtitulo = :subtitulo,
            descricao = :descricao,
            duracao = :duracao,
            nivel = :nivel,
            introducao = :introducao,
            objetivos = :objetivos,
            conteudo = :conteudo,
            imagemCapa = :imagemCapa,
            tituloAvaliacao = :tituloAvaliacao,
            pontuacaoMinima = :pontuacaoMinima,
            perguntasTrilha = :perguntasTrilha,
            mensagemConclusao = :mensagemConclusao,
            gerarCertificado = :gerarCertificado,
            autorTrilha = :autorTrilha,
            tagsTrilha = :tagsTrilha,
            referenciasTrilha = :referenciasTrilha,
            ativoTrilha = :ativoTrilha
            WHERE $campo = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':subtitulo', $this->subtitulo);
        $stmt->bindParam(':descricao', $this->descricao);
        $stmt->bindParam(':duracao', $this->duracao);
        $stmt->bindParam(':nivel', $this->nivel);
        $stmt->bindParam(':introducao', $this->introducao);
        $stmt->bindParam(':objetivos', $this->objetivos);
        $stmt->bindParam(':conteudo', $this->conteudo);
        $stmt->bindParam(':imagemCapa', $this->imagemCapa);
        $stmt->bindParam(':tituloAvaliacao', $this->tituloAvaliacao);
        $stmt->bindParam(':pontuacaoMinima', $this->pontuacaoMinima, PDO::PARAM_INT);
        $stmt->bindParam(':perguntasTrilha', $this->perguntasTrilha);
        $stmt->bindParam(':mensagemConclusao', $this->mensagemConclusao);
        $stmt->bindParam(':gerarCertificado', $this->gerarCertificado, PDO::PARAM_INT);
        $stmt->bindParam(':autorTrilha', $this->autorTrilha);
        $stmt->bindParam(':tagsTrilha', $this->tagsTrilha);
        $stmt->bindParam(':referenciasTrilha', $this->referenciasTrilha);
        $stmt->bindParam(':ativoTrilha', $this->ativoTrilha, PDO::PARAM_INT);
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
        $sql = "SELECT * FROM {$this->table} ORDER BY id_trilha DESC LIMIT :limite";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":limite", (int) $limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function gerarCertificadoAutomatico($nomeAluno)
    {
        require_once __DIR__ . '/fpdf.php';

        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf->AddPage();
        $encode = fn($texto) => mb_convert_encoding($texto, 'ISO-8859-1', 'UTF-8');
        $pdf->SetFont('Arial', 'B', 30);
        $pdf->Cell(0, 50, $encode('CERTIFICADO DE CONCLUSÃO DA TRILHA INNOVAMIND'), 0, 1, 'C');
        $pdf->SetFont('Arial', '', 20);
        $pdf->Ln(10);
        $pdf->Cell(0, 10, $encode("Certificamos que $nomeAluno"), 0, 1, 'C');
        $pdf->SetFont('Arial', '', 18);
        $pdf->Ln(5);
        $pdf->Cell(0, 10, $encode("concluiu a trilha: " . $this->titulo), 0, 1, 'C');
        $pdf->Ln(15);
        $pdf->SetFont('Arial', '', 16);
        $pdf->Cell(0, 10, $encode("Autor: " . $this->autorTrilha), 0, 1, 'C');
        $pdf->Cell(0, 10, $encode("Data: " . date('d/m/Y')), 0, 1, 'C');
        $dirCertificados = __DIR__ . '/../certificados/';
        if (!is_dir($dirCertificados)) {
            mkdir($dirCertificados, 0777, true);
        }

        $arquivoNome = 'certificado_' . str_replace(' ', '_', $nomeAluno) . '_' . $this->id_trilha . '.pdf';
        $arquivoFisico = $dirCertificados . $arquivoNome;
        $pdf->Output('F', $arquivoFisico);
        return 'certificados/' . $arquivoNome;
    }

    public function listAll($condicao = null)
    {
        $sql = "SELECT * FROM {$this->table}";
        if ($condicao) {
            $sql .= " WHERE {$condicao}";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function updateField($campo, $valor, $whereCampo, $whereValor)
    {
        $sql = "UPDATE trilha SET $campo = :valor WHERE $whereCampo = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":valor", $valor);
        $stmt->bindValue(":id", $whereValor);
        return $stmt->execute();
    }
}
