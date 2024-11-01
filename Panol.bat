@echo off

:: Definir títulos de las ventanas que deseas cerrar
set SERVER_TITLE=Servidor PHP
set VITE_TITLE=Vite
set MAIN_TITLE=Main CMD

:: Cerrar instancias de cmd.exe con los títulos específicos
for /f "tokens=2" %%i in ('tasklist ^| findstr /i "%SERVER_TITLE%"') do taskkill /PID %%i /F
for /f "tokens=2" %%i in ('tasklist ^| findstr /i "%VITE_TITLE%"') do taskkill /PID %%i /F

:: Cerrar todas las instancias de cmd.exe, excepto la ventana actual
for /f "tokens=2" %%i in ('tasklist ^| findstr /i "cmd.exe"') do (
    tasklist /FI "PID eq %%i" | findstr /I "%MAIN_TITLE%" >nul || taskkill /PID %%i /F
)

:: Cambiar al directorio donde está el archivo .bat
cd /d "%~dp0" || (echo No se pudo cambiar al directorio del archivo & pause & exit)

echo Cambiando al directorio: %cd%

:: Finaliza cualquier proceso existente de PHP y Node
taskkill /IM php.exe /F
taskkill /IM node.exe /F

:: Iniciar el servidor PHP en segundo plano con un título personalizado
start /B "Servidor PHP" php -S localhost:8000 -t public > nul 2>&1

:: Iniciar Vite en segundo plano con un título personalizado
start /B "Vite" npx vite --port=4000 > nul 2>&1

:: Abrir el navegador con la página local
start chrome "http://localhost:8000/"