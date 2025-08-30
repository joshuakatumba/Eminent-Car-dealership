@extends('admin.layouts.app')

@section('title', 'Activity Log')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Activity Log</h2>
    <div>
        <button class="btn btn-outline-secondary" onclick="window.print()">
            <i class="fas fa-print"></i> Print
        </button>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5 class="mb-0">System Activities</h5>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-end">
                    <div class="input-group" style="max-width: 300px;">
                        <input type="text" class="form-control" id="searchInput" placeholder="Search activities...">
                        <button class="btn btn-outline-secondary" type="button" id="searchBtn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if($activities->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Action</th>
                            <th>Description</th>
                            <th>IP Address</th>
                            <th>Date & Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activities as $activity)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2">
                                            <i class="fas fa-user-circle fa-2x text-secondary"></i>
                                        </div>
                                        <div>
                                            <strong>{{ $activity->user->name ?? 'Unknown User' }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $activity->user->email ?? 'N/A' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $activity->action === 'login' ? 'success' : ($activity->action === 'logout' ? 'warning' : ($activity->action === 'create' ? 'primary' : ($activity->action === 'update' ? 'info' : ($activity->action === 'delete' ? 'danger' : 'secondary')))) }}">
                                        {{ $activity->formatted_action }}
                                    </span>
                                </td>
                                <td>
                                    <div class="activity-description">
                                        {{ $activity->description }}
                                        @if($activity->model_type && $activity->model_id)
                                            <br>
                                            <small class="text-muted">
                                                Related: {{ class_basename($activity->model_type) }} #{{ $activity->model_id }}
                                            </small>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <code class="small">{{ $activity->ip_address ?? 'N/A' }}</code>
                                </td>
                                <td>
                                    <div class="text-nowrap">
                                        <div>{{ $activity->created_at->format('M d, Y') }}</div>
                                        <small class="text-muted">{{ $activity->created_at->format('H:i:s') }}</small>
                                        <br>
                                        <small class="text-muted">{{ $activity->time_ago }}</small>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $activities->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-history fa-3x text-muted mb-3"></i>
                <h5>No activities found</h5>
                <p class="text-muted">Activities will appear here as they occur.</p>
            </div>
        @endif
    </div>
</div>

<style>
    .avatar-sm {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .activity-description {
        max-width: 300px;
        word-wrap: break-word;
    }
    
    /* Medium-sized pagination styling */
    .pagination {
        --bs-pagination-padding-x: 1rem;
        --bs-pagination-padding-y: 0.5rem;
        --bs-pagination-font-size: 1.1rem;
        --bs-pagination-border-radius: 0.4rem;
    }
    
    .pagination .page-link {
        padding: 0.5rem 1rem;
        font-size: 1.1rem;
        font-weight: 500;
    }
    
    .pagination .page-item.active .page-link {
        font-weight: 600;
    }
    
    @media print {
        .btn, .input-group {
            display: none !important;
        }
        
        .card {
            border: none !important;
            box-shadow: none !important;
        }
        
        .table {
            font-size: 12px;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const searchBtn = document.getElementById('searchBtn');
    const tableRows = document.querySelectorAll('tbody tr');
    
    function filterActivities() {
        const searchTerm = searchInput.value.toLowerCase();
        
        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
    
    searchBtn.addEventListener('click', filterActivities);
    searchInput.addEventListener('keyup', filterActivities);
});
</script>
@endsection
