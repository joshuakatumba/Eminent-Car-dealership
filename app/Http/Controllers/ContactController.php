<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        // Get contact information from settings
        $settings = Setting::pluck('value', 'key')->toArray();
        
        $contactInfo = [
            'address' => $settings['contact_address'] ?? '123 Street Name, City, Australia',
            'phone' => $settings['contact_phone'] ?? '+256 774 959 446',
            'email' => $settings['contact_email'] ?? 'info@eminent.com',
            'working_hours' => $settings['working_hours'] ?? 'Mon - FRI / 9:30 AM - 6:30 PM',
            'map_embed_url' => $settings['map_embed_url'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d805184.6320105711!2d144.49269039866502!3d-37.971237001538135!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad646b5d2ba4df7%3A0x4045675218ccd90!2sMelbourne%20VIC%2C%20Australia!5e0!3m2!1sen!2sin!4v1654250375825!5m2!1sen!2sin',
            'company_name' => $settings['company_name'] ?? 'Car Dealership',
            'why_choose_us_title' => $settings['why_choose_us_title'] ?? 'Why Choose Us',
            'contact_form_title' => $settings['contact_form_title'] ?? 'Drop Us a Line',
            'map_title' => $settings['map_title'] ?? 'Find Us Map'
        ];

        return view('contact', compact('contactInfo'));
    }

    public function submit(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string|max:1000',
        ]);

        // Save the contact message to database
        $contactMessage = ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'status' => 'new'
        ]);

        // Get contact email from settings
        $adminEmail = Setting::where('key', 'contact_email')->value('value') ?? 'admin@cardealership.com';
        $companyName = Setting::where('key', 'company_name')->value('value') ?? 'Car Dealership';

        // Send email notification to admin
        try {
            Mail::send('emails.new-contact-message', [
                'contactMessage' => $contactMessage,
                'companyName' => $companyName
            ], function ($message) use ($adminEmail, $companyName, $contactMessage) {
                $message->to($adminEmail)
                        ->subject("New Contact Message from {$contactMessage->name} - {$companyName}")
                        ->replyTo($contactMessage->email, $contactMessage->name);
            });
        } catch (\Exception $e) {
            // Log the email error but don't fail the form submission
            \Log::error('Failed to send contact message notification: ' . $e->getMessage());
        }

        // Send auto-reply to customer
        try {
            Mail::send('emails.contact-auto-reply', [
                'name' => $contactMessage->name,
                'companyName' => $companyName
            ], function ($message) use ($contactMessage, $companyName) {
                $message->to($contactMessage->email)
                        ->subject("Thank you for contacting {$companyName}")
                        ->from(config('mail.from.address'), $companyName);
            });
        } catch (\Exception $e) {
            // Log the email error but don't fail the form submission
            \Log::error('Failed to send contact auto-reply: ' . $e->getMessage());
        }

        return redirect()->route('contact')->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}
