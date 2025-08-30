<?php

namespace App\Services;

class TagExtractionService
{
    /**
     * Automotive keywords and their related tags
     */
    private $keywordMap = [
        // Maintenance related
        'maintenance' => ['Maintenance', 'Service'],
        'oil change' => ['Maintenance', 'Oil'],
        'tire pressure' => ['Maintenance', 'Tires'],
        'brake' => ['Maintenance', 'Safety'],
        'battery' => ['Maintenance', 'Electrical'],
        'filter' => ['Maintenance'],
        'fluid' => ['Maintenance'],
        'inspection' => ['Maintenance', 'Safety'],
        
        // Vehicle types
        'suv' => ['SUV'],
        'sedan' => ['Sedan'],
        'truck' => ['Truck'],
        'hatchback' => ['Hatchback'],
        'convertible' => ['Convertible'],
        'luxury' => ['Luxury'],
        'sports car' => ['Sports', 'Performance'],
        
        // Fuel types
        'electric' => ['Electric', 'EV'],
        'hybrid' => ['Hybrid'],
        'gasoline' => ['Gasoline'],
        'diesel' => ['Diesel'],
        'fuel economy' => ['Fuel Economy'],
        'mpg' => ['Fuel Economy'],
        
        // Financing
        'financing' => ['Financing'],
        'loan' => ['Financing'],
        'credit' => ['Financing'],
        'payment' => ['Financing'],
        'interest rate' => ['Financing'],
        'down payment' => ['Financing'],
        
        // Safety
        'safety' => ['Safety'],
        'airbag' => ['Safety'],
        'backup camera' => ['Safety', 'Technology'],
        'lane departure' => ['Safety', 'Technology'],
        'blind spot' => ['Safety'],
        'collision' => ['Safety'],
        
        // Technology
        'technology' => ['Technology'],
        'infotainment' => ['Technology'],
        'navigation' => ['Technology'],
        'bluetooth' => ['Technology'],
        'apple carplay' => ['Technology'],
        'android auto' => ['Technology'],
        
        // Performance
        'performance' => ['Performance'],
        'horsepower' => ['Performance'],
        'torque' => ['Performance'],
        'acceleration' => ['Performance'],
        'handling' => ['Performance'],
        
        // Brands (common ones)
        'toyota' => ['Toyota'],
        'honda' => ['Honda'],
        'ford' => ['Ford'],
        'chevrolet' => ['Chevrolet'],
        'nissan' => ['Nissan'],
        'bmw' => ['BMW', 'Luxury'],
        'mercedes' => ['Mercedes', 'Luxury'],
        'audi' => ['Audi', 'Luxury'],
        'lexus' => ['Lexus', 'Luxury'],
        'tesla' => ['Tesla', 'Electric'],
        
        // General automotive terms
        'vehicle' => ['Automotive'],
        'car' => ['Automotive'],
        'automotive' => ['Automotive'],
        'dealership' => ['Dealership'],
        'warranty' => ['Warranty'],
        'insurance' => ['Insurance'],
        'registration' => ['Registration'],
    ];

    /**
     * Extract tags from blog post content
     */
    public function extractTags($content, $title = '', $excerpt = '')
    {
        $text = strtolower($content . ' ' . $title . ' ' . $excerpt);
        $extractedTags = [];

        foreach ($this->keywordMap as $keyword => $tags) {
            if (strpos($text, strtolower($keyword)) !== false) {
                $extractedTags = array_merge($extractedTags, $tags);
            }
        }

        // Remove duplicates and sort
        $extractedTags = array_unique($extractedTags);
        sort($extractedTags);

        // Limit to top 8 most relevant tags
        return array_slice($extractedTags, 0, 8);
    }

    /**
     * Get all available tags for admin selection
     */
    public function getAllAvailableTags()
    {
        $allTags = [];
        foreach ($this->keywordMap as $tags) {
            $allTags = array_merge($allTags, $tags);
        }
        
        return array_unique($allTags);
    }

    /**
     * Combine automatic and manual tags
     */
    public function combineTags($automaticTags, $manualTags = [])
    {
        $combined = array_merge($automaticTags, $manualTags);
        return array_unique($combined);
    }

    /**
     * Extract tags and return as comma-separated string
     */
    public function extractTagsAsString($content, $title = '', $excerpt = '', $manualTags = [])
    {
        $automaticTags = $this->extractTags($content, $title, $excerpt);
        $combinedTags = $this->combineTags($automaticTags, $manualTags);
        
        return implode(',', $combinedTags);
    }
}
