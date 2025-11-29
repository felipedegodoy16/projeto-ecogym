<?php 

  session_start();

  $_SESSION['logged'] = $_SESSION['logged'] ?? false;
  
  if(!$_SESSION['logged']) {
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
  <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@600&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="./css/style.css" id="css-theme">
</head>

<body>
  <main id="admin">
    <nav class="side-nav-admin font-1-xs cor-6">
      <ul>
        <li><a class="active-link-admin"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px">
              <path d="M153.22-120q-14.22 0-23.72-9.58-9.5-9.59-9.5-23.75v-44q0-14.17 9.62-23.75 9.61-9.59 23.83-9.59 14.22 0 23.72 9.59 9.5 9.58 9.5 23.75v44q0 14.16-9.62 23.75-9.62 9.58-23.83 9.58Zm163.33 0q-14.22 0-23.72-9.58-9.5-9.59-9.5-23.75V-364q0-14.17 9.62-23.75t23.83-9.58q14.22 0 23.72 9.58 9.5 9.58 9.5 23.75v210.67q0 14.16-9.62 23.75-9.61 9.58-23.83 9.58Zm163.33 0q-14.21 0-23.71-9.58-9.5-9.59-9.5-23.75v-144q0-14.17 9.61-23.75 9.62-9.59 23.84-9.59 14.21 0 23.71 9.59 9.5 9.58 9.5 23.75v144q0 14.16-9.61 23.75-9.62 9.58-23.84 9.58Zm163.34 0q-14.22 0-23.72-9.58-9.5-9.59-9.5-23.75V-384q0-14.17 9.62-23.75 9.61-9.58 23.83-9.58 14.22 0 23.72 9.58 9.5 9.58 9.5 23.75v230.67q0 14.16-9.62 23.75-9.62 9.58-23.83 9.58Zm163.33 0q-14.22 0-23.72-9.58-9.5-9.59-9.5-23.75v-364q0-14.17 9.62-23.75 9.62-9.59 23.83-9.59 14.22 0 23.72 9.59 9.5 9.58 9.5 23.75v364q0 14.16-9.62 23.75-9.61 9.58-23.83 9.58ZM559.67-493q-13 0-25.15-5.13-12.14-5.13-22.19-14.54L400-625 177.33-403q-10.04 10-23.85 9.5-13.81-.5-23.73-10.5-9.08-10-9.25-23.5-.17-13.5 9.5-23.17l223-221.66q10.05-9.92 22.19-14.46 12.14-4.54 24.81-4.54 12.67 0 25.23 4.54T447-672.33l113 113 223.33-223.34q10-10 23.5-9.83 13.5.17 23.42 10.17 9.08 10 9.25 23.5.17 13.5-9.5 23.16l-223 223Q598-503 585.33-498q-12.66 5-25.66 5Z" />
            </svg>Informações</a></li>
        <li><a><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px">
              <path d="M480-480.67q-66 0-109.67-43.66Q326.67-568 326.67-634t43.66-109.67Q414-787.33 480-787.33t109.67 43.66Q633.33-700 633.33-634t-43.66 109.67Q546-480.67 480-480.67Zm-320 254V-260q0-36.67 18.5-64.17T226.67-366q65.33-30.33 127.66-45.5 62.34-15.17 125.67-15.17t125.33 15.5q62 15.5 127.28 45.3 30.54 14.42 48.96 41.81Q800-296.67 800-260v33.33q0 27.5-19.58 47.09Q760.83-160 733.33-160H226.67q-27.5 0-47.09-19.58Q160-199.17 160-226.67Zm66.67 0h506.66V-260q0-14.33-8.16-27-8.17-12.67-20.5-19-60.67-29.67-114.34-41.83Q536.67-360 480-360t-111 12.17Q314.67-335.67 254.67-306q-12.34 6.33-20.17 19-7.83 12.67-7.83 27v33.33ZM480-547.33q37 0 61.83-24.84Q566.67-597 566.67-634t-24.84-61.83Q517-720.67 480-720.67t-61.83 24.84Q393.33-671 393.33-634t24.84 61.83Q443-547.33 480-547.33Zm0-86.67Zm0 407.33Z" />
            </svg>Meu Perfil</a></li>
        <li><a><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px">
              <path d="m826-585-56-56 30-31-128-128-31 30-57-57 30-31q23-23 57-22.5t57 23.5l129 129q23 23 23 56.5T857-615l-31 30ZM346-104q-23 23-56.5 23T233-104L104-233q-23-23-23-56.5t23-56.5l30-30 57 57-31 30 129 129 30-31 57 57-30 30Zm397-336 57-57-303-303-57 57 303 303ZM463-160l57-58-302-302-58 57 303 303Zm-6-234 110-109-64-64-109 110 63 63Zm63 290q-23 23-57 23t-57-23L104-406q-23-23-23-57t23-57l57-57q23-23 56.5-23t56.5 23l63 63 110-110-63-62q-23-23-23-57t23-57l57-57q23-23 56.5-23t56.5 23l303 303q23 23 23 56.5T857-441l-57 57q-23 23-57 23t-57-23l-62-63-110 110 63 63q23 23 23 56.5T577-161l-57 57Z" />
            </svg>Meus Treinos</a></li>
        <li><a href="index.php"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#39b934">
              <path d="M240-200h120v-200q0-17 11.5-28.5T400-440h160q17 0 28.5 11.5T600-400v200h120v-360L480-740 240-560v360Zm-80 0v-360q0-19 8.5-36t23.5-28l240-180q21-16 48-16t48 16l240 180q15 11 23.5 28t8.5 36v360q0 33-23.5 56.5T720-120H560q-17 0-28.5-11.5T520-160v-200h-80v200q0 17-11.5 28.5T400-120H240q-33 0-56.5-23.5T160-200Zm320-270Z" />
            </svg>Voltar</a></li>
      </ul>
    </nav>

    <button class="btn-css-theme">
      <svg xmlns='http://www.w3.org/2000/svg' height='40px' viewBox='0 -960 960 960' width='40px' fill='#39b934'>
        <path d='M480-760q-17 0-28.5-11.5T440-800v-80q0-17 11.5-28.5T480-920q17 0 28.5 11.5T520-880v80q0 17-11.5 28.5T480-760Zm198 82q-11-11-11-27.5t11-28.5l56-57q12-12 28.5-12t28.5 12q11 11 11 28t-11 28l-57 57q-11 11-28 11t-28-11Zm122 238q-17 0-28.5-11.5T760-480q0-17 11.5-28.5T800-520h80q17 0 28.5 11.5T920-480q0 17-11.5 28.5T880-440h-80ZM480-40q-17 0-28.5-11.5T440-80v-80q0-17 11.5-28.5T480-200q17 0 28.5 11.5T520-160v80q0 17-11.5 28.5T480-40ZM226-678l-57-56q-12-12-12-29t12-28q11-11 28-11t28 11l57 57q11 11 11 28t-11 28q-12 11-28 11t-28-11Zm508 509-56-57q-11-12-11-28.5t11-27.5q11-11 27.5-11t28.5 11l57 56q12 11 11.5 28T791-169q-12 12-29 12t-28-12ZM80-440q-17 0-28.5-11.5T40-480q0-17 11.5-28.5T80-520h80q17 0 28.5 11.5T200-480q0 17-11.5 28.5T160-440H80Zm89 271q-11-11-11-28t11-28l57-57q11-11 27.5-11t28.5 11q12 12 12 28.5T282-225l-56 56q-12 12-29 12t-28-12Zm311-71q-100 0-170-70t-70-170q0-100 70-170t170-70q100 0 170 70t70 170q0 100-70 170t-170 70Zm0-80q66 0 113-47t47-113q0-66-47-113t-113-47q-66 0-113 47t-47 113q0 66 47 113t113 47Zm0-160Z' />
      </svg>
    </button>

    <!-- Section Dashboard -->
    <section class="body-section body-section-active" id="dashboard-section">
      <header class="header-pages-admin">
        <h2 class="font-1-l cor-3">Informações</h2>
      </header>

      <div>
        <!-- Stats Cards -->
        <div class="stats-grid" id="stats-cards">
          <div class="stat-card">
            <div class="stat-icon"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#39b934">
                <path d="m480-483-68 52q-6 5-12 .5t-4-11.5l26-84-70-56q-5-5-3-11.5t9-6.5h86l26-82q2-7 10-7t10 7l26 82h85q7 0 9.5 6.5T608-582l-71 56 26 84q2 7-4 11.5t-12-.5l-67-52Zm0 363L293-58q-20 7-36.5-5T240-95v-254q-38-42-59-96t-21-115q0-134 93-227t227-93q134 0 227 93t93 227q0 61-21 115t-59 96v254q0 20-16.5 32T667-58l-187-62Zm0-200q100 0 170-70t70-170q0-100-70-170t-170-70q-100 0-170 70t-70 170q0 100 70 170t170 70ZM320-159l160-41 160 41v-124q-35 20-75.5 31.5T480-240q-44 0-84.5-11.5T320-283v124Zm160-62Z" />
              </svg></div>
            <div class="stat-label">Minha garação de energia e colocação</div>
            <div class="stat-value" id="kwh-generated-month">...</div>
            <div class="stat-change font-1-s" id="ranking-position">...</div>
          </div>

          <div class="stat-card">
            <div class="stat-icon"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#39b934">
                <path d="m422-232 207-248H469l29-227-185 267h139l-30 208Zm-62-128H236q-24 0-35.5-21.5T203-423l299-430q10-14 26-19.5t33 .5q17 6 25 21t6 32l-32 259h155q26 0 36.5 23t-6.5 43L416-100q-11 13-27 17t-31-3q-15-7-23.5-21.5T328-139l32-221Zm111-110Z" />
              </svg></div>
            <div class="stat-label">Energia Gerada Pela Academia</div>
            <div class="stat-value" id="kwh-generated">...</div>
            <div class="stat-change" id="month-kwh">...</div>
          </div>
        </div>

        <!-- Charts Area -->
        <div class="charts-section">
          <div class="card">
            <h2 class="card-title"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#39b934">
                <path d="M200-120q-33 0-56.5-23.5T120-200v-600q0-17 11.5-28.5T160-840q17 0 28.5 11.5T200-800v600h600q17 0 28.5 11.5T840-160q0 17-11.5 28.5T800-120H200Zm80-120q-17 0-28.5-11.5T240-280v-280q0-17 11.5-28.5T280-600h80q17 0 28.5 11.5T400-560v280q0 17-11.5 28.5T360-240h-80Zm200 0q-17 0-28.5-11.5T440-280v-480q0-17 11.5-28.5T480-800h80q17 0 28.5 11.5T600-760v480q0 17-11.5 28.5T560-240h-80Zm200 0q-17 0-28.5-11.5T640-280v-120q0-17 11.5-28.5T680-440h80q17 0 28.5 11.5T800-400v120q0 17-11.5 28.5T760-240h-80Z" />
              </svg> Distribuição de Energia</h2>
            <p class="card-subtitle">Meu histórico de energia</p>
            <div class="chart-wrap">
              <canvas id="barChart"></canvas>
            </div>
          </div>

          <div class="card">
            <h2 class="card-title"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#39b934">
                <path d="M480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-130 75-234t199-145q29-10 53.5 7t24.5 46q0 20-11.5 36.5T391-747q-86 27-138.5 100.5T200-480q0 117 81.5 198.5T480-200q52 0 100.5-18t86.5-52q15-14 36.5-14t36.5 14q23 21 24 47.5T742-176q-54 47-120.5 71.5T480-80Zm280-400q0-92-53-165.5T568-747q-18-6-29.5-22.5T527-806q0-29 24.5-46t53.5-7q125 42 200 146t75 233q0 18-1.5 36.5T873-403q-5 29-29.5 41.5T790-360q-19-7-29.5-25.5T754-424q3-17 4.5-30t1.5-26Z" />
              </svg> Meta de Energia Mensal</h2>
            <p class="card-subtitle">Exibição do quanto falta para a meta</p>
            <div class="card-body-doughnut">
              <div class="doughnut-chart-body">
                <canvas id="doughnut"></canvas>
                <div class="doughnut-inside">
                  <div class="cor-p1 perc-legend" id="pct">...</div>
                  <div class="cor-3 rest-legend" id="raw">...</div>
                </div>
              </div>
              <div class="doughnut-legend">
                <div class="cor-p1 meta-legend" id="meta-legend">...</div>
                <div class="cor-2 generated-legend" id="generated-legend">...</div>
              </div>
            </div>
          </div>
        </div>

        <div class="content-grid">
          <!-- Ranking de Alunos -->
          <div class="card" id="rankingUsers">
            <div class="card-header">
              <div>
                <h2 class="card-title"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#39b934">
                    <path d="M440-200v-124q-49-11-87.5-41.5T296-442q-75-9-125.5-65.5T120-640v-40q0-33 23.5-56.5T200-760h80q0-33 23.5-56.5T360-840h240q33 0 56.5 23.5T680-760h80q33 0 56.5 23.5T840-680v40q0 76-50.5 132.5T664-442q-18 46-56.5 76.5T520-324v124h120q17 0 28.5 11.5T680-160q0 17-11.5 28.5T640-120H320q-17 0-28.5-11.5T280-160q0-17 11.5-28.5T320-200h120ZM280-528v-152h-80v40q0 38 22 68.5t58 43.5Zm200 128q50 0 85-35t35-85v-240H360v240q0 50 35 85t85 35Zm200-128q36-13 58-43.5t22-68.5v-40h-80v152Zm-200-52Z" />
                  </svg> Top 5 Alunos</h2>
                <p class="card-subtitle">Maiores geradores de energia</p>
              </div>
            </div>
          </div>

          <!-- Atividade Semanal -->
          <div class="card" id="rankingEquips">
            <div class="card-header">
              <div>
                <h2 class="card-title"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#39b934">
                    <path d="M480-160q75 0 127.5-52.5T660-340q0-75-52.5-127.5T480-520q-75 0-127.5 52.5T300-340q0 75 52.5 127.5T480-160ZM363-572q20-11 42.5-17.5T451-598L350-800H250l113 228ZM256-208q-17-29-26.5-62.5T220-340q0-36 9.5-69.5T256-472q-42 14-69 49.5T160-340q0 47 27 82.5t69 49.5Zm448 0q42-14 69-49.5t27-82.5q0-47-27-82.5T704-472q17 29 26.5 62.5T740-340q0 36-9.5 69.5T704-208ZM480-80q-40 0-76.5-11.5T336-123q-9 2-18 2.5t-19 .5q-91 0-155-64T80-339q0-87 58-149t143-69L149-822q-10-20 1.5-39t34.5-19h166q23 0 41.5 12t29.5 32l58 116 58-116q11-20 29.5-32t41.5-12h166q23 0 34.5 19t1.5 39L680-559q85 8 142.5 70T880-340q0 92-64 156t-156 64q-9 0-18.5-.5T623-123q-31 20-67 31.5T480-80Zm0-260ZM363-572 250-800l113 228Zm117 286-49 37q-6 5-12 .5t-4-11.5l19-61-49-35q-6-5-4-11.5t10-6.5h60l19-65q2-7 10-7t10 7l19 65h60q8 0 10 6.5t-4 11.5l-49 35 19 61q2 7-4 11.5t-12-.5l-49-37Zm117-286 114-228H610l-85 170 19 38q14 4 27 8.5t26 11.5Z" />
                  </svg> Top 5 Equipamentos</h2>
                <p class="card-subtitle">Nossos equipamentos campeões</p>
              </div>
            </div>
          </div>
        </div>

        <!-- <ul id="dashboards-list"></ul> -->
      </div>

      <div class="loading-container">
        <div class="spinner-container">
          <div class="spinner"></div>
        </div>
      </div>
    </section>

    <!-- Section Profile -->
    <section class="body-section" id="profile-section">
      <header class="header-pages-admin">
        <h2 class="font-1-l cor-3">Meu Perfil</h2>
      </header>

      <div class="users-body-items">
        <form class="form-cadastro form-update-profile" id="updateProfileForm" enctype="multipart/form-data">
          <div class="card-photo-profile">
            <div class="img-profile"></div>
            <div class="main-informations font-2-xs cor-6">
              <h3 class="font-1-s cor-1" id="user-name-profile-photo">...</h3>
              <span id="user-cpf-profile-photo">...</span>
              <span id="user-email-profile-photo">...</span>
            </div>

            <input type="file" name="update-picture" id="update-picture" style="display: none;">
          </div>

          <div class="datas-section-profile">
            <div class="card-datas-profile">
              <h2 class="font-1-xs personal-informations">Dados Pessoais</h2>

              <div class="form-group">
                <label class="form-label" for="update-name">Nome</label>
                <input type="text" class="register-datas form-input" id="update-name" name="update-name" placeholder="Digite seu nome">
                <span class="font-2-xs warning-data">Preencha este campo</span>
              </div>

              <div class="form-group">
                <label class="form-label" for="update-cpf">CPF</label>
                <input type="text" class="form-input" id="update-cpf" name="update-cpf" data-mask="000.000.000-00" placeholder="999.999.999-99" maxlength="14">
                <span class="font-2-xs warning-data">Preencha este campo</span>
              </div>

              <div class="form-group">
                <label class="form-label" for="update-email">E-mail</label>
                <input type="email" class="register-datas form-input" id="update-email" name="update-email" placeholder="seu@email.com">
                <span class="font-2-xs warning-data">Preencha este campo</span>
              </div>

              <div class="form-group">
                <label class="form-label" for="update-phone">Telefone</label>
                <input type="text" class="form-input" data-mask="+00 (00) 00000-0000" id="update-phone" name="update-phone" placeholder="+55 (99) 99999-9999">
                <span class="font-2-xs warning-data">Preencha este campo</span>
              </div>

              <div class="form-group">
                <label class="form-label" for="update-genre">Gênero</label>
                <select class="form-select" name="update-genre" id="update-genre">
                  <option value="fail-genre">Selecione</option>
                  <option value="male">Masculino</option>
                  <option value="female">Feminino</option>
                  <option value="other">Outro</option>
                  <option value="no-information">Não informar</option>
                </select>
                <span class="font-2-xs warning-data">Preencha este campo</span>
                <span class="position-icon-input"><img src="./assets/vetores/arrow-down.svg" alt=""></span>
              </div>

              <div class="form-group">
                <label class="form-label" for="update-nasc-date">Data de Nascimento:</label>
                <input type="text" class="register-datas form-input" id="update-nasc-date" name="update-nasc-date" data-mask="00/00/0000" placeholder="01/01/2001">
                <span class="font-2-xs warning-data">Preencha este campo</span>
              </div>
            </div>

            <div class="card-datas-profile address-datas-profile">
              <!-- Infos de Endereço -->
              <h2 class="font-1-xs address-informations">Endereço</h2>
              <div class="form-group">
                <label class="form-label" for="update-cep">CEP</label>
                <input type="text" class="form-input" id="update-cep" data-mask="00000-000" name="update-cep" placeholder="99999-999" oninput="buscaCep()">
                <span class="font-2-xs warning-data">Preencha este campo</span>
              </div>

              <div class="form-group">
                <label class="form-label" for="update-state">Estado (UF)</label>
                <select class="form-select" name="update-state" id="update-state">
                  <option value="fail-state">Selecione</option>
                  <option value="sp">SP - São Paulo</option>
                  <option value="mg">MG - Minas Gerais</option>
                  <option value="rj">RJ - Rio de Janeiro</option>
                </select>
                <span class="font-2-xs warning-data">Preencha este campo</span>
                <span class="position-icon-input"><img src="./assets/vetores/arrow-down.svg" alt=""></span>
              </div>

              <div class="form-group">
                <label class="form-label" for="update-city">Cidade</label>
                <input type="text" class="form-input" id="update-city" name="update-city" placeholder="Digite sua cidade">
                <span class="font-2-xs warning-data">Preencha este campo</span>
              </div>

              <div class="form-group">
                <label class="form-label" for="update-bairro">Bairro</label>
                <input type="text" class="form-input" id="update-bairro" name="update-bairro" placeholder="Digite seu bairro">
                <span class="font-2-xs warning-data">Preencha este campo</span>
              </div>

              <div class="form-group">
                <label class="form-label" for="update-street">Rua</label>
                <input type="text" class="form-input" id="update-street" name="update-street" placeholder="Digite sua rua">
                <span class="font-2-xs warning-data">Preencha este campo</span>
              </div>

              <div class="form-group">
                <label class="form-label" for="update-number">Número</label>
                <input type="text" class="form-input" id="update-number" name="update-number" placeholder="Digite o número">
                <span class="font-2-xs warning-data">Preencha este campo</span>
              </div>
            </div>

            <div class="btn-actions">
              <button class="button btn-primary btn-primary-p6 btn-add-edit">
                Salvar alterações
              </button>
            </div>
          </div>
        </form>
      </div>
    </section>

    <!-- Section Practices -->
    <section class="body-section" id="prac-section">
      <header class="header-pages-admin">
        <h2 class="font-1-l cor-3">Treinos</h2>
        <a class="button btn-primary btn-primary-p6 btn-add-item btn-visible-form"><svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px">
            <path d="M446.67-446.67H233.33q-14.16 0-23.75-9.61-9.58-9.62-9.58-23.84 0-14.21 9.58-23.71 9.59-9.5 23.75-9.5h213.34v-213.34q0-14.16 9.61-23.75 9.62-9.58 23.84-9.58 14.21 0 23.71 9.58 9.5 9.59 9.5 23.75v213.34h213.34q14.16 0 23.75 9.61 9.58 9.62 9.58 23.84 0 14.21-9.58 23.71-9.59 9.5-23.75 9.5H513.33v213.34q0 14.16-9.61 23.75-9.62 9.58-23.84 9.58-14.21 0-23.71-9.58-9.5-9.59-9.5-23.75v-213.34Z" />
          </svg>Novo</a>
      </header>

      <div class="loading-container">
        <div class="spinner-container">
          <div class="spinner"></div>
        </div>
      </div>

      <div class="prac-body-items">
        <div class="form-container-modal">
          <form class="form-hidden form-visibility form-prac-item form-cadastro" id="cadastroPrac">
            <input type="hidden" id="prac-id" value="">
            <div class="form-group">
              <label class="form-label" for="prac-name">Nome</label>
              <input type="text" class="form-input" id="prac-name" name="prac-name" placeholder="Treino">
              <span class="font-2-xs warning-data">Preencha este campo</span>
            </div>

            <div class="form-group">
              <label class="form-label" for="prac-relax">Descanso</label>
              <select class="form-select" name="prac-relax" id="prac-relax">
                <option value="fail-relax">Selecione</option>
                <option value="30">30s</option>
                <option value="45">45s</option>
                <option value="60">1min</option>
                <option value="90">1min 30s</option>
                <option value="105">1min 45s</option>
                <option value="120">2min</option>
              </select>
              <span class="font-2-xs warning-data">Preencha este campo</span>
              <!-- <span class="position-icon-input"><img src="./assets/img/vetores/arrow-down.svg" alt=""></span> -->
            </div>

            <div class="exer-list"></div>

            <div class="div-btn-add-exercise">
              <button class="button btn-primary btn-primary-p6">Adicionar Exercício</button>
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

        <ul class="list-items" id="prac-list"></ul>
      </div>
    </section>

    <!-- Card Informations Pracs -->
    <div class="card-focus-bg" id="cardPracFocusBg">
      <div class="card-focus card-item card-user card-focus-visible card-active" id="cardPracFocus">
        <div class="card-header">
          <h3 class="card-name font-1-l" id="name-prac-card-focus"></h3>
          <span class="font-2-s" id="relax-card-focus"></span>
        </div>
        <ul class="card-body">
          <li class="li-table">
            <table>
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Exercício</th>
                  <th>Séries</th>
                  <th>Repetições</th>
                  <th>Carga</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </li>
          <li class="font-2-xs cor-4 card-prac-actions"><span>Ações:</span> <a class="card-actions" id="edit-prac">Editar</a><a class="card-actions" id="delete-prac">Excluir</a></li>
        </ul>
      </div>
    </div>
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

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script type="module" src="./js/profile/sidenavProfile.js"></script>
  <script type="module" src="./js/profile/profile.js"></script>
  <script src="./js/admin/exer.js"></script>
  <script type="module" src="./js/admin/prac.js"></script>
  <script src="./js/animations.js"></script>
  <script src="./js/buscaCepProfile.js"></script>

  <!-- jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
</body>

</html>