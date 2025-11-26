<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/baseSite.css">
    <title>Editais Externos</title>

    <style>
        .titulo-editais {
            font-size: 2.4rem;
            font-weight: 700;
        }

        .subtitulo-editais {
            font-size: 1.1rem;
            color: #d0c9e8;
        }

        .card-edital {
            background-color: #252525ff;
            color: #ffff;re
            border: 1px solid #3b2d53;
            transition: 0.3s;
        }

        .card-edital:hover {
            transform: translateY(-5px);
            border-color: #7b42ff;
        }

        .categoria-titulo {
            font-size: 1.8rem;
            color: #bba8ff;
            margin-bottom: 25px;
            border-left: 5px solid #7b42ff;
            padding-left: 12px;
        }

        .btn-edital {
            background-color: #7b42ff;
            border: none;
            padding: 8px 20px;
        }

        .btn-edital:hover {
            background-color: #a278ff;
        }
    </style>
</head>

<body class="text-light">

    <nav><?php require_once "_parts/_navbar.php"; ?></nav>

    <main class="container my-5">

        <div class="text-center mb-5">
            <h1 class="titulo-editais">Editais Externos</h1>
            <p class="subtitulo-editais">Oportunidades reais para projetos, bolsas, inovação e impacto social.</p>
        </div>
