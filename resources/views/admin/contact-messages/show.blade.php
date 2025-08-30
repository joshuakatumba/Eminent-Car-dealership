@extends('admin.layouts.app')

@section('title', 'View Contact Message')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">
                            <i class="fas fa-envelope me-2"></i>Contact Message #{{ $contactMessage->id }}
                        </h4>
                        <small class="text-muted">Received on {{ $contactMessage->created_at->format('F d, Y \a\t g:i A') }}</small>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back to List
                        </a>
                        @if($contactMessage->status !== 'replied')
                            <form method="POST" action="{{ route('admin.contact-messages.replied', $contactMessage) }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-reply me-1"></i> Mark as Replied
                                </button>
                            </form>
                        @endif
                        <button type="button" class="btn btn-danger" onclick="deleteMessage({{ $contactMessage->id }})">
                            <i class="fas fa-trash me-1"></i> Delete
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-8">
                            <!-- Message Content -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-comment me-2"></i>Message Content
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="message-content p-3 bg-light rounded">
                                        {!! nl2br(e($contactMessage->message)) !!}
                                    </div>
                                </div>
                            </div>

                            <!-- Status Management -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-cog me-2"></i>Status Management
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('admin.contact-messages.update', $contactMessage) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="status" class="form-label">Current Status</label>
                                                <select name="status" id="status" class="form-select">
                                                    <option value="new" {{ $contactMessage->status === 'new' ? 'selected' : '' }}>New</option>
                                                    <option value="read" {{ $contactMessage->status === 'read' ? 'selected' : '' }}>Read</option>
                                                    <option value="replied" {{ $contactMessage->status === 'replied' ? 'selected' : '' }}>Replied</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 d-flex align-items-end">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save me-1"></i> Update Status
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Contact Information -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-user me-2"></i>Contact Information
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="contact-info">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Name</label>
                                            <p class="mb-0">{{ $contactMessage->name }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Email</label>
                                            <p class="mb-0">
                                                <a href="mailto:{{ $contactMessage->email }}" class="text-decoration-none">
                                                    {{ $contactMessage->email }}
                                                </a>
                                            </p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Phone</label>
                                            <p class="mb-0">
                                                <a href="tel:{{ $contactMessage->phone }}" class="text-decoration-none">
                                                    {{ $contactMessage->phone }}
                                                </a>
                                            </p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Status</label>
                                            <p class="mb-0">
                                                @switch($contactMessage->status)
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
                                                        <span class="badge bg-secondary">{{ ucfirst($contactMessage->status) }}</span>
                                                @endswitch
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Actions -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-bolt me-2"></i>Quick Actions
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <a href="mailto:{{ $contactMessage->email }}?subject=Re: Your message from {{ config('app.name') }}" 
                                           class="btn btn-outline-primary">
                                            <i class="fas fa-envelope me-1"></i> Reply via Email
                                        </a>
                                        <a href="tel:{{ $contactMessage->phone }}" class="btn btn-outline-success">
                                            <i class="fas fa-phone me-1"></i> Call {{ $contactMessage->name }}
                                        </a>
                                        @if($contactMessage->status === 'new')
                                            <form method="POST" action="{{ route('admin.contact-messages.update', $contactMessage) }}" style="display: inline;">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="read">
                                                <button type="submit" class="btn btn-outline-info w-100">
                                                    <i class="fas fa-eye me-1"></i> Mark as Read
                                                </button>
                                            </form>
                                        @endif
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

<script>
function deleteMessage(messageId) {
    if (confirm('Are you sure you want to delete this message? This action cannot be undone.')) {
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

<style>
.message-content {
    white-space: pre-wrap;
    font-family: inherit;
    line-height: 1.6;
}
</style>
@endsection
