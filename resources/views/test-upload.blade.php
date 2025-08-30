<!DOCTYPE html>
<html>
<head>
    <title>Test Upload</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Test File Upload</h1>
    
    <div style="margin-bottom: 20px;">
        <h3>Supported Image Formats:</h3>
        <ul>
            <li>JPEG (.jpg, .jpeg)</li>
            <li>PNG (.png)</li>
            <li>GIF (.gif)</li>
            <li>AVIF (.avif) - Modern high-efficiency format</li>
        </ul>
    </div>
    
    <form action="/test-upload" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="test_file" accept="image/*,.avif">
        <button type="submit">Upload Test</button>
    </form>
    
    @if(session('upload_result'))
        <div style="margin-top: 20px; padding: 10px; background: #f0f0f0;">
            <h3>Upload Result:</h3>
            <pre>{{ session('upload_result') }}</pre>
        </div>
    @endif
    
    <div style="margin-top: 20px;">
        <h3>PHP Upload Settings:</h3>
        <ul>
            <li>file_uploads: {{ ini_get('file_uploads') ? 'On' : 'Off' }}</li>
            <li>upload_max_filesize: {{ ini_get('upload_max_filesize') }}</li>
            <li>post_max_size: {{ ini_get('post_max_size') }}</li>
            <li>max_file_uploads: {{ ini_get('max_file_uploads') }}</li>
        </ul>
    </div>
</body>
</html>
