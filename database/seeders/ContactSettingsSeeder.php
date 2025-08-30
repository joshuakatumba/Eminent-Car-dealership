<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class ContactSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'contact_address',
                'value' => '123 Main Street, Kampala, Uganda',
                'description' => 'Company address for contact page'
            ],
            [
                'key' => 'contact_phone',
                'value' => '+256 774 959 446',
                'description' => 'Primary contact phone number'
            ],
            [
                'key' => 'contact_email',
                'value' => 'info@eminent.com',
                'description' => 'Primary contact email address'
            ],
            [
                'key' => 'working_hours',
                'value' => 'Mon - FRI / 9:30 AM - 6:30 PM',
                'description' => 'Business working hours'
            ],
            [
                'key' => 'map_embed_url',
                'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d805184.6320105711!2d144.49269039866502!3d-37.971237001538135!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad646b5d2ba4df7%3A0x4045675218ccd90!2sMelbourne%20VIC%2C%20Australia!5e0!3m2!1sen!2sin!4v1654250375825!5m2!1sen!2sin',
                'description' => 'Google Maps embed URL for contact page'
            ],
            [
                'key' => 'company_name',
                'value' => 'Eminent Car Dealership',
                'description' => 'Company name'
            ],
            [
                'key' => 'why_choose_us_title',
                'value' => 'Why Choose Us',
                'description' => 'Title for the why choose us section'
            ],
            [
                'key' => 'contact_form_title',
                'value' => 'Drop Us a Line',
                'description' => 'Title for the contact form section'
            ],
            [
                'key' => 'map_title',
                'value' => 'Find Us Map',
                'description' => 'Title for the map section'
            ]
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                [
                    'value' => $setting['value'],
                    'description' => $setting['description']
                ]
            );
        }
    }
}
