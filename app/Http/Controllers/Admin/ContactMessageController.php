<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Services\ActivityService;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.contact-messages.index', compact('messages'));
    }

    public function show(ContactMessage $contactMessage)
    {
        // Mark as read if it's new
        if ($contactMessage->status === 'new') {
            $contactMessage->update(['status' => 'read']);
        }
        
        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    public function update(Request $request, ContactMessage $contactMessage)
    {
        $request->validate([
            'status' => 'required|in:new,read,replied'
        ]);

        $contactMessage->update([
            'status' => $request->status
        ]);

        // Log the status update
        ActivityService::log('contact_status_update', "Updated contact message status to: {$request->status}", $contactMessage);

        return redirect()->route('admin.contact-messages.show', $contactMessage)
            ->with('success', 'Message status updated successfully.');
    }

    public function destroy(ContactMessage $contactMessage)
    {
        // Log the deletion before deleting
        ActivityService::logDelete($contactMessage, "Deleted contact message from {$contactMessage->name}");
        
        $contactMessage->delete();
        return redirect()->route('admin.contact-messages.index')
            ->with('success', 'Message deleted successfully.');
    }

    public function markAsReplied(ContactMessage $contactMessage)
    {
        $contactMessage->update(['status' => 'replied']);
        
        // Log the reply action
        ActivityService::logContactMessageReplied($contactMessage);
        
        return redirect()->route('admin.contact-messages.show', $contactMessage)
            ->with('success', 'Message marked as replied.');
    }
}
