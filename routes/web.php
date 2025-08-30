<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// This file now serves as the main entry point
// Routes are handled by PortRouteServiceProvider based on port
// - Port 8000: User routes (routes/user.php)
// - Port 8001: Admin routes (routes/admin.php)

// No routes defined here - all routing is handled by PortRouteServiceProvider

// Test route for file upload debugging
Route::get('/test-upload', function () {
    return view('test-upload');
});

Route::post('/test-upload', function (Request $request) {
    $result = [];
    
    if ($request->hasFile('test_file')) {
        $file = $request->file('test_file');
        $result['file_name'] = $file->getClientOriginalName();
        $result['file_size'] = $file->getSize();
        $result['mime_type'] = $file->getMimeType();
        $result['extension'] = $file->getClientOriginalExtension();
        $result['is_valid'] = $file->isValid();
        
        if ($file->isValid()) {
            try {
                $path = $file->store('test-uploads', 'public');
                $result['stored_path'] = $path;
                $result['success'] = true;
                $result['message'] = 'File uploaded successfully!';
            } catch (\Exception $e) {
                $result['error'] = $e->getMessage();
                $result['success'] = false;
            }
        } else {
            $result['error'] = 'File upload failed';
            $result['success'] = false;
        }
    } else {
        $result['error'] = 'No file uploaded';
        $result['success'] = false;
    }
    
    return redirect('/test-upload')->with('upload_result', json_encode($result, JSON_PRETTY_PRINT));
});
