<?php
require_once 'config/conexao.php';
$sql = "SELECT * FROM produtos WHERE destaque = 1";
$stmt = $pdo->query($sql);
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LP On Feet | O Melhor do Streetwear</title>
  <link rel="stylesheet" href="style.css" />

  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Permanent+Marker&display=swap"
    rel="stylesheet" />
</head>

<body>
  <header>
    <div class="logo">LP ON FEET</div>
    <nav>
      <a href="#">Início</a>
      <a href="#">Ténis</a>
      <a href="#">Roupas</a>
      <a href="#" class="btn-destaque">Carrinho</a>
    </nav>
  </header>

  <section class="hero">
    <div class="hero-content">
      <h1>Pisando Fofo <span class="destaque-cor">e com Estilo</span></h1>
      <p>Os lançamentos mais exclusivos e a melhor qualidade importada.</p>
      <button class="btn-principal">Ver Coleção</button>
    </div>
  </section>

  <section class="produtos">
    <h2 class="titulo-secao">Destaques da Semana</h2>

    <div class="grid-produtos">

      <?php if (count($produtos) > 0): ?>

        <?php foreach ($produtos as $prod): ?>
          <div class="card">
            <div class="img-placeholder" style="background-image: url('uploads/<?php echo $prod['imagem']; ?>'); background-size: cover; background-position: center; color: transparent;">
              <?php echo $prod['nome']; ?>
            </div>

            <h3><?php echo $prod['nome']; ?></h3>

            <p class="preco">R$ <?php echo number_format($prod['preco'], 2, ',', '.'); ?></p>

            <button>Comprar</button>
          </div>
        <?php endforeach; ?>

      <?php else: ?>
        <p>Nenhum produto em destaque no momento.</p>
      <?php endif; ?>

    </div>
  </section>

  <footer>
    <p>LP On Feet © 2024 - Qualidade Importada</p>
  </footer>
</body>

</html>