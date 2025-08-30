@echo off
echo Starting Car Dealership Servers...
echo.
echo Port 8000 - Main Website
echo Port 8001 - Admin Panel
echo.
echo Starting servers in separate windows...

start "Website (Port 8000)" cmd /k "php artisan serve --port=8000"
start "Admin Panel (Port 8001)" cmd /k "php artisan serve --port=8001"

echo.
echo Servers are starting...
echo.
echo Website: http://localhost:8000
echo Admin Panel: http://localhost:8001
echo.
echo Press any key to exit this window...
pause > nul
