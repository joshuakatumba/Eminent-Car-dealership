<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    
    <!-- Favicon - Same as admin dashboard -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/favicon-admin.svg') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon-32x32.png') }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .login-header img {
            max-width: 100%;
            height: auto;
            margin-bottom: 15px;
        }
        
        .login-header h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 5px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .btn-login {
            width: 100%;
            background-color: #007bff;
            border: none;
            padding: 10px;
        }
        
        .btn-login:hover {
            background-color: #0056b3;
        }
        
        .demo-info {
            background-color: #e9ecef;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="mb-3">
                <img src="{{ asset('assets/images/Eminent-LOGO-No-BG.png') }}" alt="Eminent Car Dealership" height="60" class="mb-3">
            </div>
            <h1>Admin Login</h1>
            <p>Car Dealership Management</p>
        </div>
        
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif
        
        <div class="demo-info">
            <strong>Demo:</strong> admin@cardealership.com / password
        </div>
        
        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" 
                       value="{{ old('email') }}" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn btn-primary btn-login">
                Login
            </button>
        </form>
        
        <div class="text-center mt-3">
            <a href="http://localhost:8000" class="text-decoration-none">Back to Website</a>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
