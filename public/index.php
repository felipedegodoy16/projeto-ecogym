<?php 
  require_once __DIR__ . '/header.php';
?>

<!DOCTYPE html>
<html lang="pt-br" id="html-index">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EcoGym</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="./assets/vetores/logo.svg" type="image/x-icon">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@600&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <!-- Header -->
  <header class="header-bg">
    <div class="header">
      <a href="index.php" class="logo"><img src="./assets/vetores/ecogym.svg" alt="Logo EcoGym"></a>

      <nav class="nav-main">
        <div id="div-icon-hamburguer" class="div-icon-hamburguer">
          <span id="icon-hamburguer" class="icon-hamburguer"></span>
        </div>
        <ul id="links-nav-hamburguer" class="links-nav-main">
          <li><a class="font-1-xs" href="./index.php">Início</a></li>
          <li><a class="font-1-xs" href="./about-us.php">Nossa História</a></li>
          <li><a class="font-1-xs" href="./contact-new.php">Fale Conosco</a></li>
          <?php 
            if($_SESSION && $_SESSION['logged']) {
              $pos = strpos($_SESSION['name'], " ");

              $name = $_SESSION['name'];

              if($pos !== false) {
                $name = substr($_SESSION['name'], 0, $pos);
              }
              
              echo '<li>
                      <div class="user-menu font-1-xs">
                        <button class="user-btn" id="userMenuBtn">
                          <div class="img-user"><img src="./assets/users/user_default.png"></div>' . $name . ' ▾
                        </button> 

                        <div class="user-dropdown" id="userDropdown">
                          <a href="profile.php">Meu Perfil</a>' . 
                          (($_SESSION && $_SESSION['logged'] && $_SESSION['permissao'] === "A") ? '<a href="admin.php">Admin</a>' : '')
                          . '
                          <a href="?logout=1" class="logout">Sair</a>
                        </div>
                      </div>
                    </li>';
            } else {
              echo '<li><a href="./login.php" class="button">Entrar</a></li>';
            }
          ?>
        </ul>
      </nav>
    </div>
  </header>

  <main>
    <section class="intro-bg">
      <div class="intro">
        <div class="intro-texts fadeInOutRight">
          <h1 class="font-1-xl">Treine forte, <span class="cor-p1 font-3">energize</span> o futuro</h1>
          <p class="font-2-xs">Na nossa academia, seu treino vai além dos resultados físicos: ele gera <span class="cor-0">energia limpa</span> para o planeta. Cada pedalada, corrida ou movimento nos equipamentos transforma esforço em <span class="cor-0">eletricidade</span>, unindo saúde e sustentabilidade. </p>
          <a class="button" href="./about-us.php#historia">Saiba mais</a>
        </div>
        <div class="intro-img fadeInOutLeft">
          <img src="./assets/fisiculturista.png" alt="Atleta musculoso segurando pesos e olhano para o lado.">
        </div>
      </div>
    </section>

    <!-- Stats Section -->
    <!-- <section class="stats-section">
      <div class="stats-container fadeInOutTop">
        <h2 class="stats-title fade-in font-1-xl">Nosso impacto em <span class="font-3 cor-p6">números</span></h2>
        <div class="stats-grid">
          <div class="stat-card fade-in">
            <span class="stat-number" data-count="15847">0</span>
            <span class="stat-label">kWh Gerados</span>
          </div>
          <div class="stat-card fade-in">
            <span class="stat-number" data-count="2350">0</span>
            <span class="stat-label">Alunos Ativos</span>
          </div>
          <div class="stat-card fade-in">
            <span class="stat-number" data-count="89">0</span>
            <span class="stat-label">Equipamentos Inteligentes</span>
          </div>
          <div class="stat-card fade-in">
            <span class="stat-number" data-count="12">0</span>
            <span class="stat-label">Toneladas de CO² Evitadas</span>
          </div>
        </div>
      </div>
    </section> -->

    <article id="goals" class="goal">
      <div class="goal-img fadeInOutRight">
        <img src="./assets/academia.jpg" alt="Imagem da nossa academia dando destaque nos equipamentos que utilizamos para alcançar nossos objetivos.">
      </div>
      <div class="goal-texts fadeInOutLeft">
        <h2 class="font-1-xl">Treine gerando <span class="cor-p1 font-3">energia</span>!</h2>
        <p class="font-2-s">Nossos equipamentos transformam seu treino em <span class="cor-11">energia renovável</span>. Ao cuidar do corpo e da mente, você também cuida do planeta. Cada movimento gera <span class="cor-11">eletricidade limpa</span> e contribui para um futuro mais sustentável e consciente.</p>
        <a class="button btn-primary" href="./about-us.php#missao">Saiba mais</a>
      </div>
    </article>

    <section id="equipments" class="equipments-bg">
      <div class="equipments">
        <div class="equipments-header fadeInOutBottom">
          <span class="font-1-s">Junte-se ao futuro</span>
          <h2 class="font-1-xl"><span class="cor-p1 font-3">Energia</span> em todos os ambientes</h2>
        </div>
        <div class="equipments-images fadeInOutBottom">
          <div id="bicicleta"><a href="#">
              <h3 class="font-1-xs">Bicicleta</h3>
              <p class="font-2-xs">Simula a pedalada e fortalece as pernas. Enquanto você pedala, a energia gerada é convertida em eletricidade.</p>
            </a></div>
          <div id="esteira"><a href="#">
              <h3 class="font-1-xs">Esteira</h3>
              <p class="font-2-xs">Permite caminhar ou correr no mesmo lugar. O movimento dos pés é transformado em energia elétrica.</p>
            </a></div>
          <div id="eliptico"><a href="#">
              <h3 class="font-1-xs">Elíptico</h3>
              <p class="font-2-xs">Trabalha braços e pernas com pouco impacto. Seu esforço vira energia enquanto você treina.</p>
            </a></div>
          <div id="remo"><a href="#">
              <h3 class="font-1-xs">Remo</h3>
              <p class="font-2-xs">Imita o ato de remar e é um ótimo aeróbico para quem quer exercitar o corpo todo. A força aplicada gera energia limpa.</p>
            </a></div>
        </div>
      </div>
    </section>

    <article id="plans" class="plans-bg">
      <div class="plans">
        <h2 class="font-1-xl fadeInOutTop">Faça parte do nosso <span class="cor-p1 font-3">time</span>!</h2>
        <div class="plan-eco-img fadeInOutRight">
          <div class="plan-eco">
            <span class="font-2-s price cor-0">R$99,90 <span class="monthly cor-5">/ mês</span></span>
            <h3 class="font-1-s cor-6">EcoPlan</h3>
            <ul class="font-2-xs cor-4">
              <li>Desconto de até 20% na mensalidade.</li>
              <li>Suporte à dúvidas das 9hrs às 19hrs.</li>
              <li>Acesso à desafios semanais.</li>
              <li>Acesso à Areá do Aluno.</li>
            </ul>
            <?php 
              if(!$_SESSION) {
                echo '<a href="login.php" class="button">Inscreva-se</a>';
              }
            ?>
          </div>
          <img src="./assets/plans/ecoplan.png" alt="Atleta inscrita em nosso plano EcoPlan.">
        </div>
        <div class="plan-power-img fadeInOutLeft">
          <div class="plan-power">
            <span class="font-2-s price cor-0">R$199,90 <span class="monthly cor-5">/ mês</span></span>
            <h3 class="font-1-s cor-p6">PowerGym</h3>
            <ul class="font-2-xs">
              <li>Desconto de até 40% na mensalidade.</li>
              <li>Direito a participação no ranking.</li>
              <li>Acesso à Areá do Aluno.</li>
              <li>Pulseira inteligente gratuita.</li>
              <li>Programa de pontos Eco.</li>
              <li>Acesso prioritário a eventos.</li>
              <li>Suporte à dúvidas 24hrs.</li>
            </ul>
            <?php 
              if(!$_SESSION) {
                echo '<a href="login.php" class="button btn-color-0">Inscreva-se</a>';
              } 
            ?>

          </div>
          <img class="img-powergym" src="./assets/plans/powergym.png" alt="Atletas que são inscritos em nosso plano PowerGym.">
        </div>
      </div>
    </article>
  </main>

  <footer id="footer" class="footer-bg">
    <div class="footer">
      <div class="contact-footer font-2-xs cor-5 fadeInOutTop">
        <div class="logo-footer">
          <img src="./assets/vetores/ecogym.svg" alt="Logo EcoGym no rodapé do site.">
        </div>
        <p>Estamos sempre à disposição para esclarecer suas dúvidas e ouvir suas sugestões. Entre em contato conosco, será um prazer responder sua mensagem.</p>
        <span><span><img src="./assets/vetores/phone.svg"></span>+55 (99) 99999-9999</span>
        <span><span><img src="./assets/vetores/email.svg"></span>ecogym.contato@gmail.com</span>
      </div>
      <div class="pages-footer">
        <div class="navigation-footer fadeInOutTop">
          <h3 class="font-1-s">Navegação</h3>
          <ul class="font-2-xs">
            <li><a href="about-us.php">Sobre nós</a></li>
            <li><a href="contact-new.php">Contato</a></li>
          </ul>
        </div>
        <div class="security-footer fadeInOutTop">
          <h3 class="font-1-s">Segurança</h3>
          <ul class="font-2-xs">
            <li><a href="#">Políticas de Privacidade</a></li>
            <li><a href="#">Termos e Condições</a></li>
          </ul>
        </div>
      </div>
      <div class="copy-footer fadeInOutTop">
        <p class="font-2-xs cor-8">EcoGym 2025 &copy; Alguns direitos reservados.</p>
      </div>
    </div>
  </footer>
  <script src="./js/navbar.js"></script>
  <script src="./js/animations.js"></script>
  <script src="./js/stats-counter.js"></script>
</body>

</html>