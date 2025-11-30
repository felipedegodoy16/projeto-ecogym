<?php 
  require_once __DIR__ . '/header.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EcoGym - Contato</title>

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
                          <a href="profile.php">Rankings</a>
                          <a href="profile.php">Meu Perfil</a>
                          <a href="/treinos">Meus Treinos</a>' . 
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
    <!-- Hero Section -->
    <section class="hero-bg">
      <div class="hero">
        <h1 class="font-1-xl fadeInOutTop">Fale Conosco</h1>
        <p class="font-2-xs fadeInOutTop">Entre em contato e faça parte da revolução <span class="font-3 cor-p1">sustentável</span> no fitness</p>
      </div>
    </section>

    <section class="faq-section-bg">
      <div class="faq-section">
        <h2 class="font-1-l cor-12 title-faq fadeInOutBottom">Dúvidas frequentes</h2>
        <dl class="faq">
          <div class="fadeInOutBottom">
            <dt><button class="font-1-xs cor-11" aria-controls="pergunta1" aria-expanded="true">Qual forma de pagamento vocês aceitam?</button></dt>
            <dd id="pergunta1" class="font-2-xs cor-9 active-faq">Aceitamos pagamentos parcelados em todos os cartões de crédito. Para pagamentos à vista também aceitarmos PIX e Boleto através do PagSeguro.</dd>
          </div>
          <div class="fadeInOutBottom">
            <dt><button class="font-1-xs cor-11" aria-controls="pergunta2" aria-expanded="false">Como posso entrar em contato?</button></dt>
            <dd id="pergunta2" class="font-2-xs cor-9">Aceitamos pagamentos parcelados em todos os cartões de crédito. Para pagamentos à vista também aceitarmos PIX e Boleto através do PagSeguro.</dd>
          </div>
          <div class="fadeInOutBottom">
            <dt><button class="font-1-xs cor-11" aria-controls="pergunta3" aria-expanded="false">Vocês possuem algum desconto?</button></dt>
            <dd id="pergunta3" class="font-2-xs cor-9">Aceitamos pagamentos parcelados em todos os cartões de crédito. Para pagamentos à vista também aceitarmos PIX e Boleto através do PagSeguro.</dd>
          </div>
          <div class="fadeInOutBottom">
            <dt><button class="font-1-xs cor-11" aria-controls="pergunta4" aria-expanded="false">Qual a garantia que possuo?</button></dt>
            <dd id="pergunta4" class="font-2-xs cor-9">Aceitamos pagamentos parcelados em todos os cartões de crédito. Para pagamentos à vista também aceitarmos PIX e Boleto através do PagSeguro.</dd>
          </div>
          <div class="fadeInOutBottom">
            <dt><button class="font-1-xs cor-11" aria-controls="pergunta5" aria-expanded="false">Posso parcelar no boleto?</button></dt>
            <dd id="pergunta5" class="font-2-xs cor-9">Aceitamos pagamentos parcelados em todos os cartões de crédito. Para pagamentos à vista também aceitarmos PIX e Boleto através do PagSeguro.</dd>
          </div>
          <div class="fadeInOutBottom">
            <dt><button class="font-1-xs cor-11" aria-controls="pergunta6" aria-expanded="false">Quantas trocas posso fazer ao ano?</button></dt>
            <dd id="pergunta6" class="font-2-xs cor-9">Aceitamos pagamentos parcelados em todos os cartões de crédito. Para pagamentos à vista também aceitarmos PIX e Boleto através do PagSeguro.</dd>
          </div>
        </dl>
      </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
      <div class="contact-container">
        <div class="contact-grid fadeInOutBottom">
          <!-- Contact Form -->
          <form class="contact-form" id="contactForm">
            <!-- <div class="success-message" id="successMessage">
              <p>✅ Mensagem enviada com sucesso! Entraremos em contato em breve.</p>
            </div> -->

            <h2 class="font-1-s cor-3 title-contact">Envie sua mensagem</h2>
            <p class="font-2-xs contact-description cor-4">Preencha o formulário abaixo e nossa equipe responderá o mais breve possível.</p>

            <div class="form-group">
              <label class="form-label" for="name">Nome completo</label>
              <input type="text" class="form-input" id="name" name="name" placeholder="Digite seu nome" required>
            </div>

            <div class="form-group">
              <label class="form-label" for="email">E-mail</label>
              <input type="email" class="form-input" id="email" name="email" placeholder="seu@email.com" required>
            </div>

            <div class="form-group">
              <label class="form-label" for="phone">Telefone</label>
              <input type="tel" class="form-input" id="phone" name="phone" data-mask="+00 (00) 00000-0000" placeholder="+55 (19) 99999-9999" required>
            </div>

            <div class="form-group">
              <label class="form-label" for="subject">Assunto</label>
              <input type="text" class="form-input" id="subject" name="subject" placeholder="Sobre o que deseja falar?" required>
            </div>

            <div class="form-group">
              <label class="form-label" for="message">Mensagem</label>
              <textarea class="form-textarea" id="message" name="message" placeholder="Escreva sua mensagem aqui..." required></textarea>
            </div>

            <button type="submit" class="button btn-primary btn-primary-p6">
              Enviar
            </button>
          </form>

          <!-- Location Info -->
          <div class="contact-info">
            <div class="fadeInOutBottom">
              <h3 class="info-title font-1-s"><svg class="icons-contact" xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px">
                  <path d="M480-168q129.33-118 191.33-214.17 62-96.16 62-169.83 0-114.86-73.36-188.1-73.36-73.23-179.97-73.23T300.03-740.1q-73.36 73.24-73.36 188.1 0 73.67 63 169.83Q352.67-286 480-168Zm-.17 65.67q-11.83 0-23.5-4-11.66-4-20.66-12.67-49.67-45.33-99-97.33-49.34-52-88.5-107.84Q209-380 184.5-437.83 160-495.67 160-552q0-150 96.5-239T480-880q127 0 223.5 89T800-552q0 56.33-24.5 114.17Q751-380 711.83-324.17q-39.16 55.84-88.5 107.84-49.33 52-99 97.33-9 8.67-20.83 12.67-11.83 4-23.67 4ZM480-560Zm.06 73.33q30.27 0 51.77-21.56 21.5-21.55 21.5-51.83 0-30.27-21.56-51.77-21.55-21.5-51.83-21.5-30.27 0-51.77 21.56-21.5 21.55-21.5 51.83 0 30.27 21.56 51.77 21.55 21.5 51.83 21.5Z" />
                </svg>Localização</h3>
              <p class="info-text">
                Rua Sustentável, 1234<br>
                Bairro Verde - São Paulo, SP<br>
                CEP: 01234-567
              </p>
              <!-- <a href="#" class="info-link">Ver no mapa →</a> -->
            </div>

            <div class="divisor-contact"></div>

            <div class="fadeInOutBottom">
              <h3 class="info-title font-1-s"><svg class="icons-contact" xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px">
                  <path d="M798-120q-125 0-247-54.5T329-329Q229-429 174.5-551T120-798q0-18 12-30t30-12h162q14 0 25 9.5t13 22.5l26 140q2 16-1 27t-11 19l-97 98q20 37 47.5 71.5T387-386q31 31 65 57.5t72 48.5l94-94q9-9 23.5-13.5T670-390l138 28q14 4 23 14.5t9 23.5v162q0 18-12 30t-30 12ZM241-600l66-66-17-94h-89q5 41 14 81t26 79Zm358 358q39 17 79.5 27t81.5 13v-88l-94-19-67 67ZM241-600Zm358 358Z" />
                </svg>Telefone</h3>
              <p class="info-text">
                <a href="tel:+5511999999999" class="info-link">(11) 99999-9999</a><br>
                <a href="tel:+551133334444" class="info-link">(11) 3333-4444</a>
              </p>
              <h4 class="schedule-contact font-1-xs">Funcionamento</h4>
              <p class="info-text">
                Seg a Sex: 6h às 22h<br>
                Sáb e Dom: 8h às 20h
              </p>
            </div>

            <div class="divisor-contact"></div>

            <div class="fadeInOutBottom">
              <h3 class="info-title font-1-s"><svg class="icons-contact" xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px">
                  <path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm640-480L501-453q-5 3-10.5 4.5T480-447q-5 0-10.5-1.5T459-453L160-640v400h640v-400ZM480-520l320-200H160l320 200ZM160-640v10-59 1-32 32-.5 58.5-10 400-400Z" />
                </svg>E-mail</h3>
              <p class="info-text">
                <a href="mailto:contato@ecogym.com.br" class="info-link">contato@ecogym.com.br</a><br>
                <a href="mailto:comercial@ecogym.com.br" class="info-link">comercial@ecogym.com.br</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- Modal de Sucesso/Erro -->
  <div class="modal-overlay" id="modalOverlay">
    <div class="modal" id="modal">
      <div class="modal-icon" id="modalIcon"></div>
      <h2 class="modal-title" id="modalTitle"></h2>
      <p class="modal-message" id="modalMessage"></p>
      <button class="button btn-modal" id="modalButton"></button>
    </div>
  </div>

  <footer id="footer" class="footer-bg">
    <div class="footer">
      <div class="contact-footer font-2-xs cor-5 fadeInOutTop">
        <div class="logo-footer">
          <img src="./assets/vetores/ecogym.svg" alt="Logo EcoGym no rodapé do site.">
        </div>
        <p>Estamos sempre à disposição para esclarecer suas dúvidas e ouvir suas sugestões. Entre em contato conosco, será um prazer responder sua mensagem.</p>
        <span><span><img src="./assets/vetores/phone.svg"></span>+55 19 99817-4730</span>
        <span><span><img src="./assets/vetores/email.svg"></span>contato@ecogym.com.br</span>
      </div>
      <div class="pages-footer">
        <div class="navigation-footer fadeInOutTop">
          <h3 class="font-1-s">Navegação</h3>
          <ul class="font-2-xs">
            <li><a href="index.php">Início</a></li>
            <li><a href="about-us.php">Sobre nós</a></li>
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
  <script src="./js/contact.js"></script>
  <script src="./js/faq.js"></script>
  <script src="./js/navbar.js"></script>
  <script src="./js/animations.js"></script>

  <!-- jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
</body>

</html>