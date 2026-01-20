<?php
// admin/index.php

// 1. Incluir a conexão (nota o "../" porque estamos numa subpasta)
require_once '../config/conexao.php';

// 2. Buscar todos os produtos (do mais recente para o mais antigo)
$sql = "SELECT * FROM produtos ORDER BY id DESC";
$stmt = $pdo->query($sql);
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - LP On Feet</title>

    <style>
        body {
            font-family: sans-serif;
            padding: 20px;
            background-color: #f4f4f4;
        }

        h1 {
            color: #333;
        }

        /* Estilo da Tabela */
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #333;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Imagens na tabela */
        .thumb-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        /* Botões */
        .btn {
            padding: 8px 12px;
            text-decoration: none;
            color: white;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        .btn-add {
            background-color: #28a745;
            display: inline-block;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .btn-editar {
            background-color: #007bff;
        }

        .btn-excluir {
            background-color: #dc3545;
        }

        .btn:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body>

    <h1>Painel de Gestão de Produtos</h1>

    <a href="adicionar.php" class="btn btn-add">+ Novo Produto</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Foto</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Destaque?</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $prod): ?>
                <tr>
                    <td><?php echo $prod['id']; ?></td>
                    <td>
                        <img src="../uploads/<?php echo $prod['imagem']; ?>" class="thumb-img" alt="Foto">
                    </td>
                    <td><?php echo $prod['nome']; ?></td>
                    <td>R$ <?php echo number_format($prod['preco'], 2, ',', '.'); ?></td>

                    <td><?php echo $prod['destaque'] ? '<strong>Sim</strong>' : 'Não'; ?></td>

                    <td>
                        <a href="#" class="btn btn-editar">Editar</a>
                        <a href="#" class="btn btn-excluir">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>