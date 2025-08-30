<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'customer_name' => 'John Smith',
                'customer_email' => 'john.smith@email.com',
                'content' => 'Excellent service! The team helped me find the perfect car within my budget. The entire process was smooth and transparent. Highly recommended!',
                'rating' => 5,
                'is_approved' => true,
            ],
            [
                'customer_name' => 'Sarah Johnson',
                'customer_email' => 'sarah.johnson@email.com',
                'content' => 'I had a great experience buying my Honda Civic here. The staff was knowledgeable and didn\'t pressure me into anything. The car was exactly as described.',
                'rating' => 5,
                'is_approved' => true,
            ],
            [
                'customer_name' => 'Michael Brown',
                'customer_email' => 'michael.brown@email.com',
                'content' => 'Outstanding dealership! They have a great selection of quality vehicles and the financing options were very competitive. Will definitely return for my next car.',
                'rating' => 5,
                'is_approved' => true,
            ],
            [
                'customer_name' => 'Emily Davis',
                'customer_email' => 'emily.davis@email.com',
                'content' => 'The best car buying experience I\'ve ever had. The team was professional, honest, and really cared about finding the right car for me. Thank you!',
                'rating' => 5,
                'is_approved' => true,
            ],
            [
                'customer_name' => 'David Wilson',
                'customer_email' => 'david.wilson@email.com',
                'content' => 'Great prices and even better service. The after-sales support has been excellent. I\'m very happy with my purchase and would recommend this dealership to anyone.',
                'rating' => 5,
                'is_approved' => true,
            ],
            [
                'customer_name' => 'Lisa Anderson',
                'customer_email' => 'lisa.anderson@email.com',
                'content' => 'Professional, courteous, and honest. They made the car buying process enjoyable instead of stressful. The quality of their vehicles is outstanding.',
                'rating' => 5,
                'is_approved' => true,
            ],
        ];

        foreach ($testimonials as $testimonialData) {
            Testimonial::create($testimonialData);
        }

        $this->command->info('Sample testimonials seeded successfully!');
    }
}
