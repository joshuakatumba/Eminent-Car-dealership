<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogPost;
use App\Models\User;
use App\Services\TagExtractionService;
use Illuminate\Support\Str;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('email', 'admin@cardealership.com')->first();
        $tagService = new TagExtractionService();

        $blogPosts = [
            [
                'title' => 'Top 10 Car Maintenance Tips for 2024',
                'slug' => 'top-10-car-maintenance-tips-2024',
                'excerpt' => 'Keep your vehicle running smoothly with these essential maintenance tips that every car owner should know.',
                'content' => '<p>Regular car maintenance is crucial for keeping your vehicle in top condition and avoiding costly repairs. Here are our top 10 maintenance tips for 2024:</p>
                
                <h3>1. Regular Oil Changes</h3>
                <p>Change your oil every 5,000-7,500 miles or as recommended by your manufacturer. Fresh oil keeps your engine running smoothly and prevents wear.</p>
                
                <h3>2. Check Tire Pressure</h3>
                <p>Maintain proper tire pressure for better fuel efficiency and safety. Check monthly and before long trips.</p>
                
                <h3>3. Replace Air Filters</h3>
                <p>Dirty air filters reduce engine performance and fuel efficiency. Replace them every 12,000-15,000 miles.</p>
                
                <h3>4. Brake Inspection</h3>
                <p>Have your brakes inspected regularly. Squeaking or grinding sounds indicate it\'s time for maintenance.</p>
                
                <h3>5. Battery Care</h3>
                <p>Clean battery terminals and check battery life every 6 months. Most batteries last 3-5 years.</p>
                
                <h3>6. Fluid Levels</h3>
                <p>Regularly check all fluid levels: coolant, brake fluid, transmission fluid, and windshield washer fluid.</p>
                
                <h3>7. Wiper Blades</h3>
                <p>Replace wiper blades every 6-12 months for clear visibility during rain or snow.</p>
                
                <h3>8. Light Bulbs</h3>
                <p>Check all lights regularly - headlights, taillights, brake lights, and turn signals.</p>
                
                <h3>9. Alignment</h3>
                <p>Get wheel alignment checked if you notice pulling to one side or uneven tire wear.</p>
                
                <h3>10. Professional Inspection</h3>
                <p>Schedule annual professional inspections to catch issues before they become major problems.</p>
                
                <p>Following these maintenance tips will help extend your vehicle\'s life and keep you safe on the road.</p>',
                'featured_image' => null,
                'meta_title' => 'Top 10 Car Maintenance Tips for 2024 - Car Dealership',
                'meta_description' => 'Essential car maintenance tips for 2024. Learn how to keep your vehicle running smoothly and avoid costly repairs.',
                'meta_keywords' => 'car maintenance, vehicle care, automotive tips, car service',
                'status' => 'published',
                'published_at' => now()->subDays(5),
                'author_id' => $admin->id,
            ],
            [
                'title' => 'Electric vs Hybrid: Which is Right for You?',
                'slug' => 'electric-vs-hybrid-which-is-right-for-you',
                'excerpt' => 'Compare electric and hybrid vehicles to find the perfect eco-friendly option for your lifestyle and driving needs.',
                'content' => '<p>As the automotive industry moves toward greener solutions, many drivers are considering electric and hybrid vehicles. But which option is best for you?</p>
                
                <h3>Electric Vehicles (EVs)</h3>
                <p><strong>Pros:</strong></p>
                <ul>
                    <li>Zero emissions during operation</li>
                    <li>Lower fuel costs</li>
                    <li>Reduced maintenance (no oil changes)</li>
                    <li>Instant torque and smooth acceleration</li>
                    <li>Federal and state incentives available</li>
                </ul>
                
                <p><strong>Cons:</strong></p>
                <ul>
                    <li>Limited range (though improving)</li>
                    <li>Charging infrastructure still developing</li>
                    <li>Higher upfront cost</li>
                    <li>Longer charging times</li>
                </ul>
                
                <h3>Hybrid Vehicles</h3>
                <p><strong>Pros:</strong></p>
                <ul>
                    <li>Better fuel efficiency than gas-only cars</li>
                    <li>No range anxiety</li>
                    <li>Lower emissions than traditional vehicles</li>
                    <li>Familiar driving experience</li>
                    <li>Wide variety of models available</li>
                </ul>
                
                <p><strong>Cons:</strong></p>
                <ul>
                    <li>Still uses gasoline</li>
                    <li>More complex than traditional vehicles</li>
                    <li>Battery replacement costs</li>
                    <li>Limited electric-only range</li>
                </ul>
                
                <h3>Making Your Decision</h3>
                <p>Consider your daily driving distance, access to charging stations, budget, and environmental priorities when choosing between electric and hybrid vehicles.</p>',
                'featured_image' => null,
                'meta_title' => 'Electric vs Hybrid Vehicles Comparison - Car Dealership',
                'meta_description' => 'Compare electric and hybrid vehicles to find the perfect eco-friendly option for your lifestyle and driving needs.',
                'meta_keywords' => 'electric vehicles, hybrid cars, eco-friendly cars, green vehicles',
                'status' => 'published',
                'published_at' => now()->subDays(3),
                'author_id' => $admin->id,
            ],
            [
                'title' => 'Financing Your Dream Car: A Complete Guide',
                'slug' => 'financing-your-dream-car-complete-guide',
                'excerpt' => 'Everything you need to know about car financing, from loan types to credit scores and getting the best rates.',
                'content' => '<p>Buying a car is one of the biggest financial decisions most people make. Understanding your financing options can save you thousands of dollars.</p>
                
                <h3>Types of Car Loans</h3>
                
                <h4>1. Dealership Financing</h4>
                <p>Many dealerships offer in-house financing or work with multiple lenders. This can be convenient but may not always offer the best rates.</p>
                
                <h4>2. Bank Loans</h4>
                <p>Traditional banks and credit unions often offer competitive rates, especially for existing customers with good credit.</p>
                
                <h4>3. Online Lenders</h4>
                <p>Online lenders can offer quick approval and competitive rates, but always research the lender thoroughly.</p>
                
                <h3>Understanding Your Credit Score</h3>
                <p>Your credit score significantly impacts your loan terms:</p>
                <ul>
                    <li><strong>Excellent (720+):</strong> Best rates available</li>
                    <li><strong>Good (690-719):</strong> Competitive rates</li>
                    <li><strong>Fair (630-689):</strong> Higher rates, may need cosigner</li>
                    <li><strong>Poor (300-629):</strong> Limited options, high rates</li>
                </ul>
                
                <h3>Getting the Best Deal</h3>
                <ol>
                    <li><strong>Check your credit report</strong> before applying</li>
                    <li><strong>Shop around</strong> for the best rates</li>
                    <li><strong>Negotiate the car price</strong> before discussing financing</li>
                    <li><strong>Consider a larger down payment</strong> to reduce loan amount</li>
                    <li><strong>Choose the shortest term</strong> you can afford</li>
                </ol>
                
                <h3>Red Flags to Watch For</h3>
                <ul>
                    <li>Dealers who won\'t let you shop around</li>
                    <li>Hidden fees or charges</li>
                    <li>Pressure to buy add-ons</li>
                    <li>Unusually low monthly payments (may indicate longer terms)</li>
                </ul>
                
                <p>Take your time, do your research, and don\'t be afraid to walk away if the deal doesn\'t feel right.</p>',
                'featured_image' => null,
                'meta_title' => 'Car Financing Guide - How to Finance Your Dream Car',
                'meta_description' => 'Complete guide to car financing including loan types, credit scores, and tips for getting the best rates.',
                'meta_keywords' => 'car financing, auto loans, car loans, vehicle financing',
                'status' => 'published',
                'published_at' => now()->subDays(1),
                'author_id' => $admin->id,
            ],
        ];

        foreach ($blogPosts as $post) {
            $blogPost = BlogPost::create($post);
            
            // Extract and add tags based on content
            $tags = $tagService->extractTagsAsString(
                $post['content'], 
                $post['title'], 
                $post['excerpt']
            );
            
            $blogPost->update(['tags' => $tags]);
        }

        $this->command->info('Created ' . count($blogPosts) . ' sample blog posts.');
    }
}
