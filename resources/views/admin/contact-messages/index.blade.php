@extends('admin.layouts.app')

@section('title', 'Contact Messages')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-envelope me-2"></i>Contact Messages
                    </h4>
                    <div class="d-flex gap-2">
                        <span class="badge bg-primary">{{ $messages->total() }} Total Messages</span>
                        <span class="badge bg-warning">{{ $messages->where('status', 'new')->count() }} New</span>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($messages->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Message Preview</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($messages as $message)
                                        <tr class="{{ $message->status === 'new' ? 'table-warning' : '' }}">
                                            <td>{{ $message->id }}</td>
                                            <td>
                                                <strong>{{ $message->name }}</strong>
                                                @if($message->status === 'new')
                                                    <span class="badge bg-danger ms-1">NEW</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="mailto:{{ $message->email }}" class="text-decoration-none">
                                                    {{ $message->email }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="tel:{{ $message->phone }}" class="text-decoration-none">
                                                    {{ $message->phone }}
                                                </a>
                                            </td>
                                            <td>
                                                {{ Str::limit($message->message, 50) }}
                                            </td>
                                            <td>
                                                @switch($message->status)
                                                    @case('new')
                                                        <span class="badge bg-warning">New</span>
                                                        @break
                                                    @case('read')
                                                        <span class="badge bg-info">Read</span>
                                                        @break
                                                    @case('replied')
                                                        <span class="badge bg-success">Replied</span>
                                                        @break
                                                    @default
                                                        <span class="badge bg-secondary">{{ ucfirst($message->status) }}</span>
                                                @endswitch
                                            </td>
                                            <td>
                                                <small>{{ $message->created_at->format('M d, Y H:i') }}</small>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.contact-messages.show', $message) }}" 
                                                       class="btn btn-sm btn-primary">
                                                        <i class="fas fa-eye"></i> View
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-danger" 
                                                            onclick="deleteMessage({{ $message->id }})">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            {{ $messages->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No Contact Messages</h5>
                            <p class="text-muted">No contact messages have been received yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this contact message? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function deleteMessage(messageId) {
    if (confirm('Are you sure you want to delete this message?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/contact-messages/${messageId}`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection
