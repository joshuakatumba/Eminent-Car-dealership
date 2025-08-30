@echo off
echo ========================================
echo PHP Upload Configuration Fix
echo ========================================
echo.

echo Current PHP Configuration:
php -r "echo 'upload_max_filesize: ' . ini_get('upload_max_filesize') . PHP_EOL; echo 'post_max_size: ' . ini_get('post_max_size') . PHP_EOL; echo 'max_file_uploads: ' . ini_get('max_file_uploads') . PHP_EOL;"

echo.
echo ========================================
echo INSTRUCTIONS TO FIX UPLOAD ISSUE:
echo ========================================
echo.
echo 1. Open the PHP configuration file as Administrator:
echo    C:\Program Files\php-8.2.21\php.ini
echo.
echo 2. Find and update these lines:
echo    upload_max_filesize = 10M
echo    post_max_size = 12M
echo    max_execution_time = 300
echo    memory_limit = 256M
echo.
echo 3. Save the file and restart your web server
echo.
echo 4. Run this script again to verify the changes
echo.
echo ========================================
echo NOTE: You may need to run your text editor
echo as Administrator to edit the php.ini file
echo ========================================
pause
