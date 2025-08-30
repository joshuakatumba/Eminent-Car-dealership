<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class AboutPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // About Story Section
            'about_title' => 'Our Story',
            'about_paragraph_1' => 'Welcome to our premier car dealership, where we have been serving customers with excellence and integrity for many years. Our commitment to quality vehicles and exceptional service has made us a trusted name in the automotive industry.',
            'about_paragraph_2' => 'We take pride in offering a carefully curated selection of vehicles from top brands, ensuring that every car in our inventory meets our high standards for quality and reliability. Our team of experienced professionals is dedicated to helping you find the perfect vehicle that fits your needs and budget.',
            'about_paragraph_3' => 'At our dealership, we believe in building lasting relationships with our customers through transparent pricing, honest communication, and outstanding after-sales support. Your satisfaction is our top priority, and we strive to exceed your expectations at every step of your car-buying journey.',
            'about_image' => 'assets/images/landcruiser-series/01.jpg',
            
            // Why Choose Us Section
            'why_choose_title' => 'Why Choose Us',
            'feature_1_title' => 'Quality Assurance',
            'feature_1_description' => 'Every vehicle in our inventory undergoes rigorous quality checks to ensure you get a reliable and well-maintained car that meets our high standards.',
            'feature_1_icon' => 'assets/images/icons/delivery.webp',
            
            'feature_2_title' => 'Best Price Guarantee',
            'feature_2_description' => 'We offer competitive pricing and transparent deals. If you find a better price elsewhere, we\'ll match it to ensure you get the best value for your money.',
            'feature_2_icon' => 'assets/images/icons/money-bag.webp',
            
            'feature_3_title' => 'Expert Support',
            'feature_3_description' => 'Our team of automotive experts is here to help you make informed decisions. From selection to financing, we provide comprehensive support throughout your journey.',
            'feature_3_icon' => 'assets/images/icons/support.webp',
            
            // Contact Information
            'contact_phone' => '+1 (555) 123-4567',
            'contact_email' => 'info@cardealership.com',
            'business_address' => '123 Main Street, City, State 12345',
            'business_hours' => 'Monday - Friday: 9:00 AM - 6:00 PM, Saturday: 10:00 AM - 4:00 PM',
            
            // Social Media
            'facebook_url' => 'https://facebook.com/cardealership',
            'twitter_url' => 'https://twitter.com/cardealership',
            'instagram_url' => 'https://instagram.com/cardealership',
            'linkedin_url' => 'https://linkedin.com/company/cardealership',
            'youtube_url' => 'https://youtube.com/cardealership',
            'tiktok_url' => 'https://tiktok.com/@cardealership',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $this->command->info('About page settings seeded successfully!');
    }
}
