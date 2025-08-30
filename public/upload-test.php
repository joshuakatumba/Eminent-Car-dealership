<?php
// Simple upload configuration test
echo "<h2>PHP Upload Configuration</h2>";
echo "<pre>";

echo "upload_max_filesize: " . ini_get('upload_max_filesize') . "\n";
echo "post_max_size: " . ini_get('post_max_size') . "\n";
echo "max_file_uploads: " . ini_get('max_file_uploads') . "\n";
echo "max_execution_time: " . ini_get('max_execution_time') . "\n";
echo "memory_limit: " . ini_get('memory_limit') . "\n";

echo "\nGD Extension: " . (extension_loaded('gd') ? 'Loaded' : 'Not Loaded') . "\n";
echo "Fileinfo Extension: " . (extension_loaded('fileinfo') ? 'Loaded' : 'Not Loaded') . "\n";

echo "\nStorage Directory Permissions:\n";
$storagePath = '../storage/app/public/vehicles';
if (is_dir($storagePath)) {
    echo "Storage directory exists: Yes\n";
    echo "Storage directory writable: " . (is_writable($storagePath) ? 'Yes' : 'No') . "\n";
} else {
    echo "Storage directory exists: No\n";
}

echo "\nPublic Storage Link:\n";
$publicStoragePath = 'storage';
if (is_link($publicStoragePath)) {
    echo "Public storage link exists: Yes\n";
    echo "Public storage link target: " . readlink($publicStoragePath) . "\n";
} else {
    echo "Public storage link exists: No\n";
}

echo "</pre>";
?>
