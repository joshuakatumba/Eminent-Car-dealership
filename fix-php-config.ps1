# PHP Upload Configuration Fix Script
# Run this script as Administrator

Write-Host "========================================" -ForegroundColor Green
Write-Host "PHP Upload Configuration Fix" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Green
Write-Host ""

$phpIniPath = "C:\Program Files\php-8.2.21\php.ini"

# Check if php.ini exists
if (-not (Test-Path $phpIniPath)) {
    Write-Host "ERROR: PHP configuration file not found at:" -ForegroundColor Red
    Write-Host $phpIniPath -ForegroundColor Red
    Write-Host "Please check your PHP installation." -ForegroundColor Red
    exit 1
}

Write-Host "Current PHP Configuration:" -ForegroundColor Yellow
php -r "echo 'upload_max_filesize: ' . ini_get('upload_max_filesize') . PHP_EOL; echo 'post_max_size: ' . ini_get('post_max_size') . PHP_EOL; echo 'max_file_uploads: ' . ini_get('max_file_uploads') . PHP_EOL;"

Write-Host ""
Write-Host "========================================" -ForegroundColor Green
Write-Host "Updating PHP Configuration..." -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Green

# Read the current php.ini file
$content = Get-Content $phpIniPath

# Create backup
$backupPath = $phpIniPath + ".backup." + (Get-Date -Format "yyyyMMdd-HHmmss")
Copy-Item $phpIniPath $backupPath
Write-Host "Backup created: $backupPath" -ForegroundColor Yellow

# Update configuration values
$updatedContent = @()
$changesMade = $false

foreach ($line in $content) {
    $updatedLine = $line
    
    # Update upload_max_filesize
    if ($line -match "^upload_max_filesize\s*=") {
        $updatedLine = "upload_max_filesize = 10M"
        $changesMade = $true
        Write-Host "Updated: upload_max_filesize = 10M" -ForegroundColor Green
    }
    
    # Update post_max_size
    elseif ($line -match "^post_max_size\s*=") {
        $updatedLine = "post_max_size = 12M"
        $changesMade = $true
        Write-Host "Updated: post_max_size = 12M" -ForegroundColor Green
    }
    
    # Update max_execution_time
    elseif ($line -match "^max_execution_time\s*=") {
        $updatedLine = "max_execution_time = 300"
        $changesMade = $true
        Write-Host "Updated: max_execution_time = 300" -ForegroundColor Green
    }
    
    # Update memory_limit
    elseif ($line -match "^memory_limit\s*=") {
        $updatedLine = "memory_limit = 256M"
        $changesMade = $true
        Write-Host "Updated: memory_limit = 256M" -ForegroundColor Green
    }
    
    $updatedContent += $updatedLine
}

# Write the updated content back to the file
if ($changesMade) {
    Set-Content -Path $phpIniPath -Value $updatedContent
    Write-Host ""
    Write-Host "Configuration updated successfully!" -ForegroundColor Green
    Write-Host ""
    Write-Host "========================================" -ForegroundColor Green
    Write-Host "NEXT STEPS:" -ForegroundColor Yellow
    Write-Host "========================================" -ForegroundColor Green
    Write-Host "1. Restart your web server (Apache/Nginx)" -ForegroundColor White
    Write-Host "2. Restart your Laravel development server" -ForegroundColor White
    Write-Host "3. Test the upload functionality" -ForegroundColor White
    Write-Host ""
    Write-Host "To restart Laravel server:" -ForegroundColor Yellow
    Write-Host "php artisan serve" -ForegroundColor White
} else {
    Write-Host "No changes were made. Configuration may already be correct." -ForegroundColor Yellow
}

Write-Host ""
Write-Host "Press any key to continue..."
$null = $Host.UI.RawUI.ReadKey("NoEcho,IncludeKeyDown")
