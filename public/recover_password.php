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
  <title>EcoGym - Recuperar Senha</title>

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

  <a href="./login.php" class="button btn-primary btn-primary-p6 back-index">Voltar ao login</a>

  <div class="login-container active-form">
    <div class="logo-section">
      <div class="logo-login">EcoGym</div>
      <div class="tagline">
        Digite o email para recuperar a senha.
      </div>
    </div>

    <form class="form-login" id="recoverForm">
      <div class="form-group">
        <label class="form-label" for="email-recover">E-mail</label>
        <input type="email" class="form-input" id="email-recover" name="email-recover" placeholder="seu@email.com">
      </div>

      <button type="submit" class="button btn-primary btn-primary-p6 btn-login">
        Recuperar senha
      </button>
    </form>
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

  <script type="module" src="./js/recover_password.js"></script>

  <!-- jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
</body>

</html>