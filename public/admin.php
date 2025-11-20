<?php 

  session_start();

  $_SESSION['logged'] = $_SESSION['logged'] ?? false;
  
  if(!$_SESSION['logged'] || $_SESSION['permissao'] !== 'A') {
    header('Location: http://localhost/projeto-ecogym/public/');
    exit();
  }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EcoGym - Admin</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="./assets/vetores/logo.svg" type="image/x-icon">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@600&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <main id="admin">
    <nav class="side-nav-admin font-1-xs cor-6">
      <ul>
        <li><a href="#" class="active-link-admin"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px">
              <path d="M153.22-120q-14.22 0-23.72-9.58-9.5-9.59-9.5-23.75v-44q0-14.17 9.62-23.75 9.61-9.59 23.83-9.59 14.22 0 23.72 9.59 9.5 9.58 9.5 23.75v44q0 14.16-9.62 23.75-9.62 9.58-23.83 9.58Zm163.33 0q-14.22 0-23.72-9.58-9.5-9.59-9.5-23.75V-364q0-14.17 9.62-23.75t23.83-9.58q14.22 0 23.72 9.58 9.5 9.58 9.5 23.75v210.67q0 14.16-9.62 23.75-9.61 9.58-23.83 9.58Zm163.33 0q-14.21 0-23.71-9.58-9.5-9.59-9.5-23.75v-144q0-14.17 9.61-23.75 9.62-9.59 23.84-9.59 14.21 0 23.71 9.59 9.5 9.58 9.5 23.75v144q0 14.16-9.61 23.75-9.62 9.58-23.84 9.58Zm163.34 0q-14.22 0-23.72-9.58-9.5-9.59-9.5-23.75V-384q0-14.17 9.62-23.75 9.61-9.58 23.83-9.58 14.22 0 23.72 9.58 9.5 9.58 9.5 23.75v230.67q0 14.16-9.62 23.75-9.62 9.58-23.83 9.58Zm163.33 0q-14.22 0-23.72-9.58-9.5-9.59-9.5-23.75v-364q0-14.17 9.62-23.75 9.62-9.59 23.83-9.59 14.22 0 23.72 9.59 9.5 9.58 9.5 23.75v364q0 14.16-9.62 23.75-9.61 9.58-23.83 9.58ZM559.67-493q-13 0-25.15-5.13-12.14-5.13-22.19-14.54L400-625 177.33-403q-10.04 10-23.85 9.5-13.81-.5-23.73-10.5-9.08-10-9.25-23.5-.17-13.5 9.5-23.17l223-221.66q10.05-9.92 22.19-14.46 12.14-4.54 24.81-4.54 12.67 0 25.23 4.54T447-672.33l113 113 223.33-223.34q10-10 23.5-9.83 13.5.17 23.42 10.17 9.08 10 9.25 23.5.17 13.5-9.5 23.16l-223 223Q598-503 585.33-498q-12.66 5-25.66 5Z" />
            </svg>Dashboard</a></li>
        <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px">
              <path d="M480-480.67q-66 0-109.67-43.66Q326.67-568 326.67-634t43.66-109.67Q414-787.33 480-787.33t109.67 43.66Q633.33-700 633.33-634t-43.66 109.67Q546-480.67 480-480.67Zm-320 254V-260q0-36.67 18.5-64.17T226.67-366q65.33-30.33 127.66-45.5 62.34-15.17 125.67-15.17t125.33 15.5q62 15.5 127.28 45.3 30.54 14.42 48.96 41.81Q800-296.67 800-260v33.33q0 27.5-19.58 47.09Q760.83-160 733.33-160H226.67q-27.5 0-47.09-19.58Q160-199.17 160-226.67Zm66.67 0h506.66V-260q0-14.33-8.16-27-8.17-12.67-20.5-19-60.67-29.67-114.34-41.83Q536.67-360 480-360t-111 12.17Q314.67-335.67 254.67-306q-12.34 6.33-20.17 19-7.83 12.67-7.83 27v33.33ZM480-547.33q37 0 61.83-24.84Q566.67-597 566.67-634t-24.84-61.83Q517-720.67 480-720.67t-61.83 24.84Q393.33-671 393.33-634t24.84 61.83Q443-547.33 480-547.33Zm0-86.67Zm0 407.33Z" />
            </svg>Usuários</a></li>
        <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px">
              <path d="m826-585-56-56 30-31-128-128-31 30-57-57 30-31q23-23 57-22.5t57 23.5l129 129q23 23 23 56.5T857-615l-31 30ZM346-104q-23 23-56.5 23T233-104L104-233q-23-23-23-56.5t23-56.5l30-30 57 57-31 30 129 129 30-31 57 57-30 30Zm397-336 57-57-303-303-57 57 303 303ZM463-160l57-58-302-302-58 57 303 303Zm-6-234 110-109-64-64-109 110 63 63Zm63 290q-23 23-57 23t-57-23L104-406q-23-23-23-57t23-57l57-57q23-23 56.5-23t56.5 23l63 63 110-110-63-62q-23-23-23-57t23-57l57-57q23-23 56.5-23t56.5 23l303 303q23 23 23 56.5T857-441l-57 57q-23 23-57 23t-57-23l-62-63-110 110 63 63q23 23 23 56.5T577-161l-57 57Z" />
            </svg>Equipamentos</a></li>
        <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px">
              <path d="M425-80q-18.33 0-32.17-12-13.83-12-16.5-30l-13-84.67q-17-6.33-34.83-16.66-17.83-10.34-32.17-21.67l-78 35.33Q200.67-202 183-208q-17.67-6-27.67-22.33L101-327q-10-16.33-5.67-34.33 4.34-18 19.34-29.67l71-52.67q-1.67-8.33-2-18.16-.34-9.84-.34-18.17 0-8.33.34-18.17.33-9.83 2-18.16l-71-52.67q-15-11.67-19.34-29.67Q91-616.67 101-633l54.33-96.67Q165.33-746 183-752t35.33 1.67l78 35.33q14.34-11.33 32.34-21.67 18-10.33 34.66-16l13-85.33q2.67-18 16.5-30 13.84-12 32.17-12h110q18.33 0 32.17 12 13.83 12 16.5 30l13 84.67q17 6.33 35.16 16.33 18.17 10 31.84 22l78-35.33q17.66-7.67 35-1.67Q794-746 804-729.67L859-633q10 16.33 5.67 34.67Q860.33-580 845.33-569l-71 51.33q1.67 9 2 18.84.34 9.83.34 18.83 0 9-.34 18.5Q776-452 774-443l71 52q15 11 19.33 29.33 4.34 18.34-5.66 34.67L804-230.33Q794-214 776.33-208q-17.66 6-35.33-1.67L663.67-245q-14.34 11.33-32 22-17.67 10.67-35 16.33l-13 84.67q-2.67 18-16.5 30Q553.33-80 535-80H425Zm12.33-66.67h85l14-110q32.34-8 60.84-24.5T649-321l103.67 44.33 39.66-70.66L701-415q4.33-16 6.67-32.17Q710-463.33 710-480q0-16.67-2-32.83-2-16.17-7-32.17l91.33-67.67-39.66-70.66L649-638.67q-22.67-25-50.83-41.83-28.17-16.83-61.84-22.83l-13.66-110h-85l-14 110q-33 7.33-61.5 23.83T311-639l-103.67-44.33-39.66 70.66L259-545.33Q254.67-529 252.33-513 250-497 250-480q0 16.67 2.33 32.67 2.34 16 6.67 32.33l-91.33 67.67 39.66 70.66L311-321.33q23.33 23.66 51.83 40.16 28.5 16.5 60.84 24.5l13.66 110Zm43.34-200q55.33 0 94.33-39T614-480q0-55.33-39-94.33t-94.33-39q-55.67 0-94.5 39-38.84 39-38.84 94.33t38.84 94.33q38.83 39 94.5 39ZM480-480Z" />
            </svg>Configurações</a></li>
      </ul>
    </nav>

    <!-- Section Dashboard -->
    <section class="body-section body-section-active" id="dashboard-section">
      <header class="header-pages-admin">
        <h2 class="font-1-l cor-3 fadeInOutRight">Dashboard</h2>
      </header>

      <div>
        <ul id="dashboards-list"></ul>
      </div>
      <div class="loading-container">
        <div class="spinner-container">
          <div class="spinner"></div>
        </div>
      </div>
    </section>

    <!-- Section Users -->
    <section class="body-section" id="users-section">
      <header class="header-pages-admin">
        <h2 class="font-1-l cor-3">Usuários</h2>
        <a class="button btn-primary btn-primary-p6 btn-add-item btn-visible-form"><svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px">
            <path d="M446.67-446.67H233.33q-14.16 0-23.75-9.61-9.58-9.62-9.58-23.84 0-14.21 9.58-23.71 9.59-9.5 23.75-9.5h213.34v-213.34q0-14.16 9.61-23.75 9.62-9.58 23.84-9.58 14.21 0 23.71 9.58 9.5 9.59 9.5 23.75v213.34h213.34q14.16 0 23.75 9.61 9.58 9.62 9.58 23.84 0 14.21-9.58 23.71-9.59 9.5-23.75 9.5H513.33v213.34q0 14.16-9.61 23.75-9.62 9.58-23.84 9.58-14.21 0-23.71-9.58-9.5-9.59-9.5-23.75v-213.34Z" />
          </svg>Novo</a>
      </header>

      <div class="loading-container">
        <div class="spinner-container">
          <div class="spinner"></div>
        </div>
      </div>

      <div class="users-body-items">
        <div class="form-container-modal">
          <form class="form-cadastro form-hidden form-visibility" id="cadastroForm">
            <h2 class="font-1-xs personal-informations">Dados Pessoais</h2>

            <input type="hidden" id="user-id" value="">
            <div class="form-group">
              <label class="form-label" for="register-name">Nome</label>
              <input type="text" class="register-datas form-input" id="register-name" name="register-name" placeholder="Digite seu nome">
              <span class="font-2-xs warning-data">Preencha este campo</span>
            </div>

            <div class="form-group">
              <label class="form-label" for="register-cpf">CPF</label>
              <input type="text" class="form-input" id="register-cpf" name="register-cpf" data-mask="000.000.000-00" placeholder="999.999.999-99" maxlength="14">
              <span class="font-2-xs warning-data">Preencha este campo</span>
            </div>

            <div class="form-group">
              <label class="form-label" for="register-email">E-mail</label>
              <input type="email" class="register-datas form-input" id="register-email" name="register-email" placeholder="seu@email.com">
              <span class="font-2-xs warning-data">Preencha este campo</span>
            </div>

            <div class="form-group">
              <label class="form-label" for="register-phone">Telefone</label>
              <input type="text" class="form-input" data-mask="+00 (00) 00000-0000" id="register-phone" name="register-phone" placeholder="+55 (99) 99999-9999">
              <span class="font-2-xs warning-data">Preencha este campo</span>
            </div>

            <div class="form-group">
              <label class="form-label" for="register-genre">Gênero</label>
              <select class="form-select" name="register-genre" id="register-genre">
                <option value="fail-genre">Selecione</option>
                <option value="male">Masculino</option>
                <option value="female">Feminino</option>
                <option value="other">Outro</option>
                <option value="no-information">Não informar</option>
              </select>
              <span class="font-2-xs warning-data">Preencha este campo</span>
              <!-- <span class="position-icon-input"><img src="./assets/vetores/arrow-down.svg" alt=""></span> -->
            </div>

            <div class="form-group">
              <label class="form-label" for="cadastro-plan">Plano</label>
              <select class="form-select" name="cadastro-plan" id="cadastro-plan">
                <option value="fail-plan">Selecione</option>
                <option value="ecoplan">EcoPlan - R$ 99,90</option>
                <option value="powergym">PowerGym - R$ 199,90</option>
              </select>
              <span class="font-2-xs warning-data">Preencha este campo</span>
              <!-- <span class="position-icon-input"><img src="./assets/vetores/arrow-down.svg" alt=""></span> -->
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

            <span class="divisor"></span>

            <!-- Infos de Endereço -->
            <h2 class="font-1-xs address-informations">Endereço</h2>
            <div class="form-group">
              <label class="form-label" for="register-cep">CEP</label>
              <input type="text" class="form-input" id="register-cep" data-mask="00000-000" name="register-cep" placeholder="99999-999" oninput="buscaCep()">
              <span class="font-2-xs warning-data">Preencha este campo</span>
            </div>

            <div class="form-group">
              <label class="form-label" for="register-state">Estado (UF)</label>
              <select class="form-select" name="register-state" id="register-state">
                <option value="fail-state">Selecione</option>
                <option value="sp">SP - São Paulo</option>
                <option value="mg">MG - Minas Gerais</option>
                <option value="rj">RJ - Rio de Janeiro</option>
              </select>
              <span class="font-2-xs warning-data">Preencha este campo</span>
              <!-- <span class="position-icon-input"><img src="./assets/img/vetores/arrow-down.svg" alt=""></span> -->
            </div>

            <div class="form-group">
              <label class="form-label" for="register-city">Cidade</label>
              <input type="text" class="form-input" id="register-city" name="register-city" placeholder="Digite sua cidade">
              <span class="font-2-xs warning-data">Preencha este campo</span>
            </div>

            <div class="form-group">
              <label class="form-label" for="register-bairro">Bairro</label>
              <input type="text" class="form-input" id="register-bairro" name="register-bairro" placeholder="Digite seu bairro">
              <span class="font-2-xs warning-data">Preencha este campo</span>
            </div>

            <div class="form-group">
              <label class="form-label" for="register-street">Rua</label>
              <input type="text" class="form-input" id="register-street" name="register-street" placeholder="Digite sua rua">
              <span class="font-2-xs warning-data">Preencha este campo</span>
            </div>

            <div class="form-group">
              <label class="form-label" for="register-number">Número</label>
              <input type="text" class="form-input" id="register-number" name="register-number" placeholder="Digite o número">
              <span class="font-2-xs warning-data">Preencha este campo</span>
            </div>

            <div class="btn-actions">
              <button class="button btn-primary btn-primary-p6 btn-add-edit">
                Adicionar
              </button>
              <a class="button btn-close btn-visible-form" id="btn-close-user">
                Fechar
              </a>
            </div>
          </form>
        </div>

        <ul class="list-items" id="users-list">
          <div class="card-focus-bg" id="cardFocusBg">
            <div class="card-focus card-item card-user card-focus-visible" id="cardFocus">
              <span class="card-id font-1-s" id="id-card-focus"></span>
              <div class="card-header">
                <div class="card-img"></div>
                <h3 class="card-name font-1-l" id="name-user-card-focus"></h3>
              </div>
              <ul class="card-body">
                <li class="font-1-xs cor-8 aditional-informations">Dados Pessoais</li>
                <li class="font-2-xs cor-4" id="cpf-user-card-focus"></li>
                <li class="font-2-xs cor-4" id="dataNasc-user-card-focus"></li>
                <li class="font-1-xs cor-8 aditional-informations">Contato</li>
                <li class="font-2-xs cor-4" id="phone-user-card-focus"></li>
                <li class="font-2-xs cor-4" id="email-user-card-focus"></li>
                <li class="font-1-xs cor-8 aditional-informations">Dados Contratuais</li>
                <li class="font-2-xs cor-4"><span>Plano:</span> EcoGym</li>
                <li class="font-2-xs cor-4 card-situation"><span class="card-tag" id="situation-user-card-focus"></span></li>
                <li class="font-2-xs cor-4"><span>Ações:</span> <a class="card-actions" id="edit-user">Editar</a><a class="card-actions" id="delete-user">Excluir</a></li>
              </ul>
            </div>
          </div>
        </ul>
      </div>
    </section>

    <!-- Section Equipments -->
    <section class="body-section" id="equips-section">
      <header class="header-pages-admin">
        <h2 class="font-1-l cor-3">Equipamentos</h2>
        <a class="button btn-primary btn-primary-p6 btn-add-item btn-visible-form"><svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px">
            <path d="M446.67-446.67H233.33q-14.16 0-23.75-9.61-9.58-9.62-9.58-23.84 0-14.21 9.58-23.71 9.59-9.5 23.75-9.5h213.34v-213.34q0-14.16 9.61-23.75 9.62-9.58 23.84-9.58 14.21 0 23.71 9.58 9.5 9.59 9.5 23.75v213.34h213.34q14.16 0 23.75 9.61 9.58 9.62 9.58 23.84 0 14.21-9.58 23.71-9.59 9.5-23.75 9.5H513.33v213.34q0 14.16-9.61 23.75-9.62 9.58-23.84 9.58-14.21 0-23.71-9.58-9.5-9.59-9.5-23.75v-213.34Z" />
          </svg>Novo</a>
      </header>

      <div class="loading-container">
        <div class="spinner-container">
          <div class="spinner"></div>
        </div>
      </div>

      <div class="equips-body-items">
        <div class="form-container-modal">
          <form class="form-hidden form-visibility form-equips-item" id="cadastroEquips">
            <input type="hidden" id="equip-id" value="">
            <div class="form-group">
              <label class="form-label" for="equip-name">Nome</label>
              <input type="text" class="form-input" id="equip-name" name="equip-name" placeholder="Equipamento">
              <span class="font-2-xs warning-data">Preencha este campo</span>
            </div>

            <div class="form-group">
              <label class="form-label" for="equip-kcal">Kcal/h</label>
              <input type="text" class="form-input" id="equip-kcal" name="equip-kcal" placeholder="99.9">
              <span class="font-2-xs warning-data">Preencha este campo</span>
            </div>

            <div class="form-group form-radio">
              <input type="radio" class="form-input" id="active" name="equip-situation" value="a" checked>
              <label class="form-label label-radio" for="active">Ativo</label>

              <input type="radio" class="form-input" id="inactive" name="equip-situation" value="i">
              <label class="form-label label-radio" for="inactive">Inativo</label>

              <input type="radio" class="form-input" id="maintenance" name="equip-situation" value="m">
              <label class="form-label label-radio" for="maintenance">Manutenção</label>
            </div>

            <div class="btn-actions">
              <button class="button btn-primary btn-primary-p6 btn-add-edit">
                Adicionar
              </button>
              <a class="button btn-close btn-visible-form">
                Fechar
              </a>
            </div>
          </form>
        </div>

        <ul class="list-items" id="equips-list"></ul>
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
            <li><a href="#">Sobre nós</a></li>
            <li><a href="#">Área do Aluno</a></li>
            <li><a href="contato.html">Contato</a></li>
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

  <script type="module" src="./js/admin/sidenav.js"></script>
  <script type="module" src="./js/admin/admin.js"></script>
  <script src="./js/animations.js"></script>
  <script src="./js/buscaCep.js"></script>

  <!-- jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
</body>

</html>