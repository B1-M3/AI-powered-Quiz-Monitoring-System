@echo off
REM Run APEXIA workflow tests without TTY (avoids "TTY mode is not supported on Windows platform")
cd /d "%~dp0"
php artisan test tests/Feature/ApexiaWorkflowTest.php --no-interaction
exit /b %ERRORLEVEL%
