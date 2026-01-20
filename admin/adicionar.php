<?php
// admin/adicionar.php
require_once '../config/conexao.php';

// Variável para mensagens de erro ou sucesso
$mensagem = "";

// Verifica se o formulário foi enviado (Método POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 1. Receber os dados do texto
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    // Se a checkbox estiver marcada, vale 1, senão 0
    $destaque = isset($_POST['destaque']) ? 1 : 0;

    // 2. Lidar com o Upload da Imagem
    // Verifica se foi enviado um arquivo e se não houve erro técnico
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {

        $arquivo = $_FILES['foto'];

        // Gera um nome único para a imagem (ex: 65a8b9.jpg) para não substituir arquivos com mesmo nome
        $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
        $novo_nome_imagem = uniqid() . "." . $extensao;

        // Define onde vamos guardar (pasta uploads que criamos antes)
        $destino = '../uploads/' . $novo_nome_imagem;

        // Tenta mover o arquivo da memória temporária para a pasta final
        if (move_uploaded_file($arquivo['tmp_name'], $destino)) {

            // 3. Se a imagem foi salva, agora salvamos tudo no Banco de Dados
            $sql = "INSERT INTO produtos (nome, descricao, preco, imagem, destaque) 
                    VALUES (:nome, :descricao, :preco, :imagem, :destaque)";

            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':descricao', $descricao);
            $stmt->bindValue(':preco', $preco);
            $stmt->bindValue(':imagem', $novo_nome_imagem); // Salvamos apenas o nome do arquivo
            $stmt->bindValue(':destaque', $destaque);

            if ($stmt->execute()) {
                // Sucesso! Redireciona de volta para a lista
                header('Location: index.php');
                exit;
            } else {
                $mensagem = "Erro ao gravar no banco de dados.";
            }
        } else {
            $mensagem = "Falha ao mover a imagem para a pasta uploads.";
        }
    } else {
        $mensagem = "Por favor, selecione uma imagem válida.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Adicionar Produto</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
            font-size: 1rem;
            width: 100%;
        }

        button:hover {
            background-color: #218838;
        }

        .voltar {
            display: block;
            margin-bottom: 20px;
            text-decoration: none;
            color: #555;
        }

        .erro {
            color: red;
            background: #ffe6e6;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <div class="container">
        <a href="index.php" class="voltar">← Voltar para a Lista</a>

        <h2>Novo Produto</h2>

        <?php if (!empty($mensagem)): ?>
            <div class="erro"><?php echo $mensagem; ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">

            <label>Nome do Produto:</label>
            <input type="text" name="nome" required placeholder="Ex: Nike Air Force">

            <label>Descrição:</label>
            <textarea name="descricao" rows="4" placeholder="Detalhes do produto..."></textarea>

            <label>Preço (R$):</label>
            <input type="number" name="preco" step="0.01" required placeholder="0.00">

            <label>Foto do Produto:</label>
            <input type="file" name="foto" accept="image/*" required>

            <label style="margin-top: 20px;">
                <input type="checkbox" name="destaque" checked>
                Mostrar na Página Inicial (Destaque)?
            </label>

            <button type="submit">Salvar Produto</button>
        </form>
    </div>

</body>

</html>