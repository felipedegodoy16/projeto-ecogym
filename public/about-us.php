<?php 
  require_once __DIR__ . '/header.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EcoGym - Sobre nós</title>

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
    <!-- About Section -->
    <section id="home" class="hero-bg">
      <div class="hero">
        <h1 class="font-1-xl fadeInOutTop">Sobre nós</h1>
        <p class="font-2-xs fadeInOutTop">Pioneiros em transformar exercício físico em <span class="font-3 cor-p1">energia</span> renovável para um futuro mais sustentável</p>
      </div>
    </section>

    <!-- History Section -->
    <section id="historia">
      <div class="section-content fadeInOutBottom">
        <div class="section-text">
          <h2 class="font-1-xl cor-11">A ideia que virou <span class="font-3 cor-p1">energia</span></h2>
          <p class="font-2-xs cor-6">A EcoGym nasceu em 2018 com um sonho simples: criar uma academia que cuidasse tanto da <span class="cor-11">saúde das pessoas quanto do planeta</span>. Nossos fundadores, apaixonados por fitness e sustentabilidade, decidiram <span class="cor-11">revolucionar</span> o conceito tradicional de academia.</p>
          <p class="font-2-xs cor-6">Começamos com equipamentos movidos a <span class="cor-11">energia humana</span>. Hoje, somos <span class="cor-11">referência em sustentabilidade</span> no setor fitness, com mais de 5 mil alunos que compartilham nossa visão de um mundo mais verde.</p>
        </div>
        <div class="section-image historia-img"></div>
      </div>
    </section>

    <!-- Missão Section -->
    <section id="missao" class="missao-bg">
      <div class="section-content fadeInOutBottom">
        <div class="section-image missao-img"></div>
        <div class="section-text">
          <h2 class="font-1-xl cor-11">Sustentabilidade em <span class="font-3 cor-p1">movimento</span></h2>
          <p class="font-2-xs cor-7"><span class="cor-11">Transformar vidas</span> através do movimento consciente, <span class="cor-11">promovendo saúde e bem-estar</span> enquanto preservamos o meio ambiente para as futuras gerações.</p>
          <p class="font-2-xs cor-7">Acreditamos que cada treino é uma oportunidade de <span class="cor-11">gerar energia limpa</span>, cada gota de suor contribui para um futuro mais sustentável.</p>
        </div>
      </div>
    </section>

    <!-- Equipe Section -->
    <section id="equipe" class="equipe-bg">
      <div class="section-content fadeInOutBottom">
        <div class="section-text">
          <h2 class="font-1-xl cor-0">Time da transformação <span class="font-3 cor-p1">sustentável</span></h2>
          <p class="font-2-xs cor-5">Nossa equipe é formada por profissionais apaixonados que compartilham os mesmos valores de <span class="cor-0">sustentabilidade e excelência</span>. Cada membro é cuidadosamente selecionado não apenas por sua competência técnica, mas também por seu <span class="cor-0">comprometimento</span> com nossa causa.</p>
          <p class="font-2-xs cor-5">Contamos com <span class="cor-0">personal trainers certificados</span>, <span class="cor-0">nutricionistas</span>, <span class="cor-0">fisioterapeutas</span> e <span class="cor-0">especialistas em bem-estar holístico</span>. Todos unidos por um objetivo comum: proporcionar a melhor experiência fitness sustentável.</p>
        </div>
        <div class="section-image equipe-img"></div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer id="footer" class="footer-bg">
    <div class="footer">
      <div class="contact-footer font-2-xs cor-5 fadeInOutTop">
        <div class="logo-footer">
          <img src="./assets/vetores/ecogym.svg" alt="Logo EcoGym no rodapé do site.">
        </div>
        <p>Estamos sempre à disposição para esclarecer suas dúvidas e ouvir suas sugestões. Entre em contato conosco, será um prazer responder sua mensagem.</p>
        <span><span><img src="./assets/vetores/phone.svg"></span>+55 99 99999-9999</span>
        <span><span><img src="./assets/vetores/email.svg"></span>contato@ecogym.com.br</span>
      </div>
      <div class="pages-footer">
        <div class="navigation-footer fadeInOutTop">
          <h3 class="font-1-s">Navegação</h3>
          <ul class="font-2-xs">
            <li><a href="index.php">Início</a></li>
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
</body>

</html>