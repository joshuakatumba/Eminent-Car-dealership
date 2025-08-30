@extends('admin.layouts.app')

@section('title', 'System Information')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">System Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-primary mb-3">Application Information</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>PHP Version:</strong></td>
                                <td>{{ $systemInfo['php_version'] }}</td>
                            </tr>
                            <tr>
                                <td><strong>Laravel Version:</strong></td>
                                <td>{{ $systemInfo['laravel_version'] }}</td>
                            </tr>
                            <tr>
                                <td><strong>Environment:</strong></td>
                                <td>
                                    <span class="badge bg-{{ $systemInfo['app_environment'] === 'production' ? 'success' : 'warning' }}">
                                        {{ ucfirst($systemInfo['app_environment']) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Debug Mode:</strong></td>
                                <td>
                                    <span class="badge bg-{{ $systemInfo['app_debug'] ? 'danger' : 'success' }}">
                                        {{ $systemInfo['app_debug'] ? 'Enabled' : 'Disabled' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Timezone:</strong></td>
                                <td>{{ $systemInfo['timezone'] }}</td>
                            </tr>
                        </table>
                    </div>
                    
                    <div class="col-md-6">
                        <h6 class="text-primary mb-3">System Configuration</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Database:</strong></td>
                                <td>{{ ucfirst($systemInfo['database']) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Cache Driver:</strong></td>
                                <td>{{ ucfirst($systemInfo['cache_driver']) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Session Driver:</strong></td>
                                <td>{{ ucfirst($systemInfo['session_driver']) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Queue Driver:</strong></td>
                                <td>{{ ucfirst($systemInfo['queue_driver']) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Server Time:</strong></td>
                                <td>{{ now()->format('Y-m-d H:i:s') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <hr>
                
                <div class="row">
                    <div class="col-12">
                        <h6 class="text-primary mb-3">System Status</h6>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="card bg-success text-white">
                                    <div class="card-body text-center">
                                        <i class="fas fa-database fa-2x mb-2"></i>
                                        <h6>Database</h6>
                                        <small>Connected</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="card bg-info text-white">
                                    <div class="card-body text-center">
                                        <i class="fas fa-memory fa-2x mb-2"></i>
                                        <h6>Memory</h6>
                                        <small>{{ number_format(memory_get_usage(true) / 1024 / 1024, 2) }} MB</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="card bg-warning text-white">
                                    <div class="card-body text-center">
                                        <i class="fas fa-clock fa-2x mb-2"></i>
                                        <h6>Uptime</h6>
                                        <small>{{ gmdate('H:i:s', time() - $_SERVER['REQUEST_TIME']) }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="card bg-primary text-white">
                                    <div class="card-body text-center">
                                        <i class="fas fa-server fa-2x mb-2"></i>
                                        <h6>Server</h6>
                                        <small>{{ $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown' }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
