<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Eminent Car Dealership</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/favicon-admin.svg') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon-32x32.png') }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
            --dark-color: #34495e;
            --light-color: #ecf0f1;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .admin-sidebar {
            background: white;
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        
        .admin-sidebar .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid #e9ecef;
        }
        
        .admin-sidebar .sidebar-header h3 {
            color: var(--primary-color);
            margin: 0;
            font-size: 1.5rem;
        }
        
        .admin-sidebar .sidebar-header img {
            opacity: 0.9;
        }
        
        .admin-sidebar .nav-link {
            color: #495057;
            padding: 12px 20px;
            border-radius: 0;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        
        .admin-sidebar .nav-link:hover,
        .admin-sidebar .nav-link.active {
            color: var(--secondary-color);
            background-color: #f8f9fa;
            border-left-color: var(--secondary-color);
        }
        
        .admin-sidebar .nav-link i {
            width: 20px;
            margin-right: 10px;
            color: var(--secondary-color);
        }
        
        .admin-main {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
        }
        
                 .admin-header {
             background: white;
             padding: 15px 30px;
             border-radius: 10px;
             box-shadow: 0 2px 10px rgba(0,0,0,0.1);
             margin-bottom: 30px;
             display: flex;
             justify-content: space-between;
             align-items: center;
         }
        
        .admin-header h1 {
            margin: 0;
            color: var(--primary-color);
            font-size: 2rem;
        }
        
        .admin-content {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 30px;
        }
        
        .stats-card {
            background: linear-gradient(135deg, var(--secondary-color), #2980b9);
            color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }
        
        .stats-card.success {
            background: linear-gradient(135deg, var(--success-color), #229954);
            box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);
        }
        
        .stats-card.warning {
            background: linear-gradient(135deg, var(--warning-color), #e67e22);
            box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3);
        }
        
        .stats-card.danger {
            background: linear-gradient(135deg, var(--danger-color), #c0392b);
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
        }
        
        .stats-card.info {
            background: linear-gradient(135deg, #17a2b8, #138496);
            box-shadow: 0 4px 15px rgba(23, 162, 184, 0.3);
        }
        
        .stats-card.secondary {
            background: linear-gradient(135deg, #6c757d, #5a6268);
            box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
        }
        
        .stats-card.dark {
            background: linear-gradient(135deg, #343a40, #212529);
            box-shadow: 0 4px 15px rgba(52, 58, 64, 0.3);
        }
        
        .stats-card.light {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            color: #495057;
            box-shadow: 0 4px 15px rgba(248, 249, 250, 0.3);
        }
        
        .stats-card h3 {
            font-size: 2.5rem;
            margin: 0;
            font-weight: bold;
        }
        
        .stats-card p {
            margin: 5px 0 0 0;
            opacity: 0.9;
        }
        
        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }
        
        .btn-admin {
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-admin:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
                 .user-dropdown {
             position: relative;
         }
         
         .user-dropdown .dropdown-menu {
             border: none;
             box-shadow: 0 4px 15px rgba(0,0,0,0.1);
             border-radius: 10px;
         }
         
         /* Profile Icon Styles */
         .profile-icon-container {
             display: flex;
             align-items: center;
             gap: 10px;
         }
         
         .profile-icon-wrapper {
             position: relative;
             display: inline-block;
         }
         
         .profile-icon {
             font-size: 2.5rem;
             color: var(--primary-color);
             transition: all 0.3s ease;
         }
         
         .profile-icon:hover {
             color: var(--secondary-color);
             transform: scale(1.05);
         }
         
         .online-indicator {
             position: absolute;
             bottom: 2px;
             right: 2px;
             width: 12px;
             height: 12px;
             background-color: #27ae60;
             border: 2px solid white;
             border-radius: 50%;
             box-shadow: 0 2px 4px rgba(0,0,0,0.2);
             animation: pulse 2s infinite;
         }
         
         @keyframes pulse {
             0% {
                 box-shadow: 0 0 0 0 rgba(39, 174, 96, 0.7);
             }
             70% {
                 box-shadow: 0 0 0 10px rgba(39, 174, 96, 0);
             }
             100% {
                 box-shadow: 0 0 0 0 rgba(39, 174, 96, 0);
             }
         }
         
         .profile-dropdown-toggle {
             color: var(--primary-color);
             text-decoration: none;
             font-weight: 500;
             padding: 0;
             border: none;
             background: none;
         }
         
         .profile-dropdown-toggle:hover,
         .profile-dropdown-toggle:focus {
             color: var(--secondary-color);
             text-decoration: none;
             box-shadow: none;
         }
         
         .user-name {
             font-size: 1rem;
             font-weight: 500;
         }
         
         .dropdown-header {
             padding: 15px 20px;
             background-color: #f8f9fa;
             border-bottom: 1px solid #e9ecef;
         }
         
         .dropdown-header .profile-icon {
             font-size: 2rem;
         }
         
         .dropdown-header .online-indicator {
             width: 10px;
             height: 10px;
         }
        
        /* Badge styling for white sidebar */
        .admin-sidebar .badge {
            background-color: var(--secondary-color) !important;
            color: white !important;
        }
        
        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--primary-color);
            font-size: 1.5rem;
        }
        
        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }
            
            .admin-sidebar.show {
                transform: translateX(0);
            }
            
            .admin-main {
                margin-left: 0;
            }
            
            .sidebar-toggle {
                display: block;
            }
            
            /* Make header sticky on small screens */
            .admin-header {
                position: sticky;
                top: 0;
                z-index: 1100;
            }
            
            /* Utilities to stack elements on mobile */
            .mobile-stack > * {
                width: 100% !important;
                margin-bottom: 10px !important;
            }
            .btn-group-mobile .btn {
                width: 100% !important;
                margin-bottom: 10px !important;
            }
        }
        
        /* Sidebar overlay for mobile */
        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 999; /* below sidebar (1000) */
            display: none;
        }
        .sidebar-overlay.show {
            display: block;
        }
        
        /* Prevent body scroll when sidebar is open */
        body.no-scroll {
            overflow: hidden;
        }
    </style>
</head>
<body>
    <!-- Admin Sidebar -->
    <nav class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-header">
            <div class="d-flex align-items-center mb-2">
                <img src="{{ asset('assets/images/Eminent-LOGO-No-BG.png') }}" alt="Eminent Car Dealership" height="35" class="me-2">
            </div>
            <h3><i class="fas fa-cog"></i> Admin Panel</h3>
        </div>
        
        <ul class="nav flex-column">
            {{-- <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li> --}}
            
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/vehicles*') ? 'active' : '' }}" href="{{ route('admin.vehicles.index') }}">
                    <i class="fas fa-car"></i> Vehicles
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/customers*') ? 'active' : '' }}" href="{{ route('admin.customers.index') }}">
                    <i class="fas fa-users"></i> Customers
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/sales*') ? 'active' : '' }}" href="{{ route('admin.sales.index') }}">
                    <i class="fas fa-chart-line"></i> Sales
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/customer-orders*') ? 'active' : '' }}" href="{{ route('admin.customer-orders.index') }}">
                    <i class="fas fa-shopping-cart"></i> Customer Orders
                    @php
                        $pendingOrdersCount = \App\Models\CustomerOrder::where('status', 'pending')->count();
                    @endphp
                    @if($pendingOrdersCount > 0)
                        <span class="badge bg-warning ms-2">{{ $pendingOrdersCount }}</span>
                    @endif
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/content*') ? 'active' : '' }}" href="{{ route('admin.content.index') }}">
                    <i class="fas fa-file-alt"></i> Content
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/about-us*') ? 'active' : '' }}" href="{{ route('admin.about-us.index') }}">
                    <i class="fas fa-info-circle"></i> About Us
                </a>
            </li>
            
            {{-- <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/blog*') ? 'active' : '' }}" href="{{ route('admin.blog.index') }}">
                    <i class="fas fa-blog"></i> Blog Posts
                </a>
            </li> --}}
            

            
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/contact-messages*') ? 'active' : '' }}" href="{{ route('admin.contact-messages.index') }}">
                    <i class="fas fa-envelope"></i> Contact Messages
                    @php
                        $newMessagesCount = \App\Models\ContactMessage::where('status', 'new')->count();
                    @endphp
                    @if($newMessagesCount > 0)
                        <span class="badge bg-danger ms-2">{{ $newMessagesCount }}</span>
                    @endif
                </a>
            </li>
            

            
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
                    <i class="fas fa-cog"></i> Settings
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/system-info*') ? 'active' : '' }}" href="{{ route('admin.system.info') }}">
                    <i class="fas fa-server"></i> System Info
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/activity-log*') ? 'active' : '' }}" href="{{ route('admin.activity.log') }}">
                    <i class="fas fa-history"></i> Activity Log
                </a>
            </li>
            
            <li class="nav-item mt-4">
                <a class="nav-link" href="{{ url('/') }}">
                    <i class="fas fa-home"></i> Back to Site
                </a>
            </li>
        </ul>
    </nav>
    <!-- Mobile Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Main Content -->
    <div class="admin-main">
        <!-- Header -->
        <div class="admin-header">
                         <div class="d-flex align-items-center">
                 <button class="sidebar-toggle me-3" id="sidebarToggle">
                     <i class="fas fa-bars"></i>
                 </button>
                 <h1 class="mb-0">@yield('title', 'Admin Panel')</h1>
             </div>
            
            <div class="user-dropdown">
                <button class="btn btn-link dropdown-toggle profile-dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="profile-icon-container">
                        <div class="profile-icon-wrapper">
                            <i class="fas fa-user-circle profile-icon"></i>
                            <div class="online-indicator"></div>
                        </div>
                        <span class="user-name">{{ auth()->user()->name ?? 'Admin' }}</span>
                    </div>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li class="dropdown-header">
                        <div class="d-flex align-items-center">
                            <div class="profile-icon-wrapper me-2">
                                <i class="fas fa-user-circle profile-icon"></i>
                                <div class="online-indicator"></div>
                            </div>
                            <div>
                                <div class="fw-bold">{{ auth()->user()->name ?? 'Admin' }}</div>
                                <small class="text-muted">Online</small>
                            </div>
                        </div>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="fas fa-user-edit"></i> Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a></li>
                </ul>
            </div>
        </div>

        <!-- Content -->
        <div class="admin-content">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Logout Form -->
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Sidebar toggle for mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const willShow = !sidebar.classList.contains('show');
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show', willShow);
            document.body.classList.toggle('no-scroll', willShow);
        });

        // Close sidebar when clicking on overlay
        document.getElementById('sidebarOverlay').addEventListener('click', function() {
            const sidebar = document.getElementById('adminSidebar');
            this.classList.remove('show');
            sidebar.classList.remove('show');
            document.body.classList.remove('no-scroll');
        });

        // Auto-close sidebar when a nav link is tapped on mobile
        Array.from(document.querySelectorAll('.admin-sidebar .nav-link')).forEach(function(link) {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    const sidebar = document.getElementById('adminSidebar');
                    const overlay = document.getElementById('sidebarOverlay');
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                    document.body.classList.remove('no-scroll');
                }
            });
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
    
    @stack('scripts')
</body>
</html>
