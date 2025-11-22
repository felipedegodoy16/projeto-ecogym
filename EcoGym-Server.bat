@echo off
title EcoGym - Servidor Local
color 0A
setlocal enabledelayedexpansion

:menu
cls
echo.
echo  ===============================================================
echo                      ECOGYM - SERVIDOR LOCAL
echo  ===============================================================
echo.
echo  [1] Iniciar Servidor (Apache + MySQL)
echo  [2] Parar Servidor
echo  [3] Abrir no Navegador
echo  [4] Ver IPs de Acesso
echo  [5] Configurar Acesso Rede Local
echo  [6] Abrir XAMPP Control Panel
echo  [0] Sair
echo.
echo  ===============================================================
echo.
choice /c 1234560 /n /m "Escolha uma opcao: "

if errorlevel 7 goto :sair
if errorlevel 6 goto :xampp_panel
if errorlevel 5 goto :config_rede
if errorlevel 4 goto :mostrar_ips
if errorlevel 3 goto :abrir_navegador
if errorlevel 2 goto :parar_servidor
if errorlevel 1 goto :iniciar_servidor

:iniciar_servidor
cls
echo.
echo  ===============================================================
echo                      INICIANDO SERVIDOR
echo  ===============================================================
echo.

if not exist "C:\xampp\xampp-control.exe" (
    echo  [ERRO] XAMPP nao encontrado em C:\xampp\
    echo  Por favor, instale o XAMPP primeiro.
    pause
    goto :menu
)

echo  [1/2] Iniciando Apache...
start /B C:\xampp\apache\bin\httpd.exe
timeout /t 2 /nobreak >nul 2>&1
echo  OK - Apache iniciado!

echo.
echo  [2/2] Iniciando MySQL...
start /B C:\xampp\mysql\bin\mysqld.exe --defaults-file=C:\xampp\mysql\bin\my.ini
timeout /t 3 /nobreak >nul 2>&1
echo  OK - MySQL iniciado!

echo.
echo  ===============================================================
echo                SERVIDOR INICIADO COM SUCESSO!
echo  ===============================================================
call :mostrar_ips
pause
goto :menu

:parar_servidor
cls
echo.
echo  ===============================================================
echo                      PARANDO SERVIDOR
echo  ===============================================================
echo.

echo  [1/2] Parando Apache...
C:\xampp\apache\bin\httpd.exe -k stop >nul 2>&1
taskkill /F /IM httpd.exe >nul 2>&1
timeout /t 1 /nobreak >nul 2>&1
echo  OK - Apache parado!

echo.
echo  [2/2] Parando MySQL...
C:\xampp\mysql\bin\mysqladmin.exe -u root shutdown >nul 2>&1
taskkill /F /IM mysqld.exe >nul 2>&1
timeout /t 1 /nobreak >nul 2>&1
echo  OK - MySQL parado!

echo.
echo  ===============================================================
echo                SERVIDOR PARADO COM SUCESSO!
echo  ===============================================================
echo.
timeout /t 2 /nobreak >nul 2>&1
goto :menu

:abrir_navegador
echo.
echo  Abrindo navegador...
start http://localhost/projeto-ecogym/public/
timeout /t 1 /nobreak >nul 2>&1
goto :menu

:mostrar_ips
echo.
echo  ===============================================================
echo                   INFORMACOES DE ACESSO
echo  ===============================================================
echo.
echo  [LOCAL] Acesso neste computador:
echo    http://localhost/projeto-ecogym/public/
echo.
echo  [REDE] Acesso de outros dispositivos:
for /f "tokens=2 delims=:" %%a in ('ipconfig ^| findstr /c:"IPv4" ^| findstr /v "127.0.0.1"') do (
    set IP=%%a
    set IP=!IP:~1!
    echo    http://!IP!/projeto-ecogym/public/
)
echo.
echo  ===============================================================
goto :eof

:config_rede
cls
echo.
echo  ===============================================================
echo              CONFIGURAR ACESSO NA REDE LOCAL
echo  ===============================================================
echo.
echo  Esta opcao configura o Firewall do Windows para
echo  permitir acesso de outros dispositivos na rede.
echo.
echo  ATENCAO: Requer privilegios de Administrador!
echo.
pause

net session >nul 2>&1
if %errorlevel% neq 0 (
    echo.
    echo  [ERRO] Execute este script como Administrador!
    echo  Clique com botao direito e "Executar como administrador"
    pause
    goto :menu
)

echo.
echo  Configurando Firewall...
netsh advfirewall firewall delete rule name="Apache EcoGym" >nul 2>&1
netsh advfirewall firewall add rule name="Apache EcoGym" dir=in action=allow protocol=TCP localport=80 >nul 2>&1
echo  OK - Firewall configurado!

echo.
echo  ===============================================================
echo              CONFIGURACAO CONCLUIDA!
echo  ===============================================================
echo.
echo  Agora outros dispositivos podem acessar usando o IP
echo  mostrado na opcao [4] Ver IPs de Acesso
echo.
pause
goto :menu

:xampp_panel
echo.
echo  Abrindo XAMPP Control Panel...
start "" "C:\xampp\xampp-control.exe"
timeout /t 1 /nobreak >nul 2>&1
goto :menu

:sair
cls
echo.
echo  Encerrando...
timeout /t 1 /nobreak >nul 2>&1
exit

