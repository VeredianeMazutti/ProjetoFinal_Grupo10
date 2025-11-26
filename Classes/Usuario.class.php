<?php
require_once "CRUD.class.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Usuario extends CRUD
{
    protected $table = "usuario";

    private $id;
    private $nomeCompleto;
    private $dataNascimento;
    private $telefone;
    private $areaAtuacao;
    private $nomeExibicao;
    private $foto; 
    private $email;
    private $senha;
    private $perfil;

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }

    public function setNomeCompleto($nomeCompleto)
    {
        $this->nomeCompleto = $nomeCompleto;
    }
    public function getNomeCompleto()
    {
        return $this->nomeCompleto;
    }

    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;
    }
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }
    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setAreaAtuacao($areaAtuacao)
    {
        $this->areaAtuacao = $areaAtuacao;
    }
    public function getAreaAtuacao()
    {
        return $this->areaAtuacao;
    }

    public function setNomeExibicao($nomeExibicao)
    {
        $this->nomeExibicao = $nomeExibicao;
    }
    public function getNomeExibicao()
    {
        return $this->nomeExibicao;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;
    }
    public function getFoto()
    {
        return $this->foto;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }
    public function getSenha()
    {
        return $this->senha;
    }

    public function setPerfil($perfil)
    {
        $this->perfil = $perfil;
    }
    public function getPerfil()
    {
        return $this->perfil;
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ) ?: null;
    }

    public function add()
    {
        $sql = "INSERT INTO $this->table 
        (nomeCompleto, dataNascimento, telefone, areaAtuacao, nomeExibicao, foto, email, senha, perfil)
        VALUES
        (:nomeCompleto, :dataNascimento, :telefone, :areaAtuacao, :nomeExibicao, :foto, :email, :senha, :perfil)";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':nomeCompleto', $this->nomeCompleto);
        $stmt->bindValue(':dataNascimento', $this->dataNascimento);
        $stmt->bindValue(':telefone', $this->telefone);
        $stmt->bindValue(':areaAtuacao', $this->areaAtuacao);
        $stmt->bindValue(':nomeExibicao', $this->nomeExibicao);
        $stmt->bindValue(':foto', $this->foto); // CORRIGIDO
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':senha', $this->senha);
        $stmt->bindValue(':perfil', $this->perfil);

        return $stmt->execute();
    }

    public function update(string $campo, int $id)
    {
        $sql = "UPDATE $this->table SET
            nomeCompleto = :nomeCompleto,
            dataNascimento = :dataNascimento,
            telefone = :telefone,
            areaAtuacao = :areaAtuacao,
            nomeExibicao = :nomeExibicao,
            foto = :foto,
            email = :email,
            perfil = :perfil";

        if (!empty($this->senha)) {
            $sql .= ", senha = :senha";
        }

        $sql .= " WHERE $campo = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':nomeCompleto', $this->nomeCompleto);
        $stmt->bindValue(':dataNascimento', $this->dataNascimento);
        $stmt->bindValue(':telefone', $this->telefone);
        $stmt->bindValue(':areaAtuacao', $this->areaAtuacao);
        $stmt->bindValue(':nomeExibicao', $this->nomeExibicao);
        $stmt->bindValue(':foto', $this->foto); // CORRIGIDO
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':perfil', $this->perfil);

        if (!empty($this->senha)) {
            $stmt->bindValue(':senha', $this->senha);
        }

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function alterarSenha($email, $senhaAtual, $novaSenha)
    {
        try {
            $query = "SELECT senha FROM $this->table WHERE email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $usuario = $stmt->fetch(PDO::FETCH_OBJ);

            if ($usuario && password_verify($senhaAtual, $usuario->senha)) {

                $novaSenhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

                $query = "UPDATE $this->table SET senha = :novaSenha WHERE email = :email";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':novaSenha', $novaSenhaHash);
                $stmt->bindParam(':email', $email);

                return $stmt->execute();
            }

            return false;

        } catch (PDOException $e) {
            return false;
        }
    }

    public function solicitarRecuperacaoSenha($email, $mensagem = null, $assunto = null)
    {
        require __DIR__ . '/../PHPMailer/src/Exception.php';
        require __DIR__ . '/../PHPMailer/src/PHPMailer.php';
        require __DIR__ . '/../PHPMailer/src/SMTP.php';

        try {

            $sql = "SELECT id FROM $this->table WHERE email = :email";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() === 0) {
                return false;
            }

            $usuario = $stmt->fetch(PDO::FETCH_OBJ);

            $token = bin2hex(random_bytes(32));
            $expira = date('Y-m-d H:i:s', strtotime('+1 hour'));

            $sql = "INSERT INTO RecuperacaoSenha (idUsuarioFK, tokenRecuperacaoSenha, expiraRecuperacaoSenha)
                    VALUES (:id, :token, :expira)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $usuario->id);
            $stmt->bindParam(':token', $token);
            $stmt->bindParam(':expira', $expira);
            $stmt->execute();

            $protocolo = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
            $dominio = $_SERVER['HTTP_HOST'];
            $caminho = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

            $link = "$protocolo://$dominio$caminho/reset_senha.php?token=$token";

            $mail = new PHPMailer(true);

            $config = parse_ini_file(__DIR__ . '/../config.ini', true)['email'];

            $mail->isSMTP();
            $mail->Host = $config['Host'];
            $mail->SMTPAuth = true;
            $mail->Username = $config['Username'];
            $mail->Password = $config['Password'];
            $mail->SMTPSecure = $config['SMTPSecure'];
            $mail->Port = $config['Port'];

            $mail->setFrom($config['Username'], 'Innovamind');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->{$config['SMTPSecure']};

            $mail->Subject = $assunto ?? "Recuperação de Senha";
            $mail->Body = "
                <p>Olá,</p>
                <p>" . ($mensagem ?? "Você solicitou a recuperação de senha.") . "</p>
                <p>Clique no link abaixo para redefinir sua senha:</p>
                <p><a href='$link'>$link</a></p>
                <p>Esse link vale por 1 hora.</p>
            ";

            $mail->send();
            return true;

        } catch (Exception $e) {
            error_log("Erro email: {$mail->ErrorInfo}");
            return false;
        }
    }

    public function redefinirSenha($token, $novaSenha)
    {
        try {
            $sql = "SELECT idUsuarioFK, expiraRecuperacaoSenha
                    FROM RecuperacaoSenha 
                    WHERE tokenRecuperacaoSenha = :token";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':token', $token);
            $stmt->execute();

            if ($stmt->rowCount() === 0)
                return false;

            $dados = $stmt->fetch(PDO::FETCH_OBJ);

            if (strtotime($dados->expiraRecuperacaoSenha) < time())
                return false;

            $novaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

            $sql = "UPDATE $this->table SET senha = :senha WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':senha', $novaHash);
            $stmt->bindParam(':id', $dados->idUsuarioFK);
            $stmt->execute();

            $sql = "DELETE FROM RecuperacaoSenha WHERE tokenRecuperacaoSenha = :token";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':token', $token);
            $stmt->execute();

            return true;

        } catch (PDOException $e) {
            return false;
        }
    }

}
