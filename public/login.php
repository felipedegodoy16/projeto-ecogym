<?php 
  session_start();

  $_SESSION['logged'] = $_SESSION['logged'] ?? false;

  if($_SESSION['logged']) {
    header('Location: http://localhost/projeto-ecogym/public/');
    exit();
  }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EcoGym - Login</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="./assets/vetores/logo.svg" type="image/x-icon">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@600&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="css/style.css">
</head>

<body class="body-login">
  <div class="energy-bg" id="energyBg"></div>

  <a href="./index.php" class="button btn-primary btn-primary-p6 back-index">Voltar ao início</a>

  <div class="login-container active-form">
    <div class="logo-section">
      <div class="logo-login">EcoGym</div>
      <div class="tagline">
        Transformando movimento em <span class="energy-highlight">energia</span>!
      </div>
    </div>

    <form class="form-login" id="loginForm" action="./../apis/files/login.php" method="post">
      <div class="form-group">
        <label class="form-label" for="user-email">E-mail</label>
        <input type="email" class="form-input" id="user-email" name="user-email" placeholder="seu@email.com" required>
      </div>

      <div class="form-group">
        <label class="form-label" for="user-password">Senha</label>
        <input type="password" class="form-input" id="user-password" name="user-password" placeholder="Sua senha" required><span class="position-icon-input reveal-password"><img src="./assets/vetores/visibility.svg" alt=""></span>
        <div class="forgot-password">
          <a href="#" onclick="alert('Funcionalidade em desenvolvimento!')">Esqueceu sua senha?</a>
        </div>
      </div>

      <button type="submit" class="button btn-primary btn-primary-p6 btn-login">
        Acessar
      </button>
    </form>

    <div class="div-open-cadastro">
      <p>Não possui uma conta? <span class="open-cadastro-form">Cadastre-se</span></p>
    </div>
  </div>

  <!-- Formulário de Pré-Cadastro -->
  <div class="login-container cadastro-container">
    <div class="logo-section">
      <div class="logo-login">EcoGym</div>
      <div class="tagline">
        Transformando movimento em <span class="energy-highlight">energia</span>!
      </div>
    </div>

    <form class="form-cadastro" id="cadastroForm">
      <h2 class="font-1-xs personal-informations">Dados Pessoais</h2>

      <div class="form-group">
        <label class="form-label" for="register-name">Nome</label>
        <input type="text" class="register-datas form-input" id="register-name" name="register-name" placeholder="Digite seu nome">
        <span class="font-2-xs warning-data">Preencha este campo</span>
      </div>

      <div class="form-group">
        <label class="form-label" for="register-email">E-mail</label>
        <input type="email" class="register-datas form-input" id="register-email" name="register-email" placeholder="seu@email.com">
        <span class="font-2-xs warning-data">Preencha este campo</span>
      </div>

      <div class="form-group">
        <label class="form-label" for="register-password">Senha</label>
        <input type="password" class="register-datas form-input compare-password" id="register-password" name="register-password" placeholder="Digite sua senha">
        <span class="font-2-xs warning-data">Preencha este campo</span>
        <span class="position-icon-input reveal-password"><img src="./assets/vetores/visibility.svg" alt=""></span>
      </div>

      <div class="form-group">
        <label class="form-label" for="register-password-confirm">Confirmar Senha</label>
        <input type="password" class="form-input compare-password" id="register-password-confirm" name="register-password-confirm" placeholder="Confirme sua senha">
        <span class="font-2-xs warning-data">Preencha este campo</span>
        <span class="position-icon-input reveal-password"><img src="./assets/vetores/visibility.svg" alt=""></span>
      </div>

      <button id="submitRegister" type="submit" class="button btn-primary btn-primary-p6 btn-login btn-cadastro">
        Cadastrar
      </button>
    </form>

    <div class="div-open-login">
      <p>Já possui uma conta? <span class="open-login-form">Acessar</span></p>
    </div>
  </div>

  <!-- Modal de Sucesso/Erro -->
  <div class="modal-overlay" id="modalOverlay">
    <div class="modal" id="modal">
      <div class="modal-icon" id="modalIcon"></div>
      <h2 class="modal-title" id="modalTitle"></h2>
      <p class="modal-message" id="modalMessage"></p>
      <button class="button btn-modal" id="modalButton"></button>
    </div>
  </div>

  <script type="module" src="./js/login.js"></script>

  <!-- jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
</body>

</html>