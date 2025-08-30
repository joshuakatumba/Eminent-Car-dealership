<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class AboutUsController extends Controller
{
    public function index()
    {
        $settings = Setting::whereIn('key', [
            'about_title',
            'about_paragraph_1',
            'about_paragraph_2', 
            'about_paragraph_3',
            'about_image',
            'why_choose_title',
            'feature_1_icon',
            'feature_1_title',
            'feature_1_description',
            'feature_2_icon',
            'feature_2_title',
            'feature_2_description',
            'feature_3_icon',
            'feature_3_title',
            'feature_3_description'
        ])->pluck('value', 'key')->toArray();

        return view('admin.about-us.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'about_title' => 'required|string|max:255',
            'about_paragraph_1' => 'required|string',
            'about_paragraph_2' => 'required|string',
            'about_paragraph_3' => 'required|string',
            'about_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB max
            'why_choose_title' => 'required|string|max:255',
            'feature_1_icon' => 'required|string',
            'feature_1_title' => 'required|string|max:255',
            'feature_1_description' => 'required|string',
            'feature_2_icon' => 'required|string',
            'feature_2_title' => 'required|string|max:255',
            'feature_2_description' => 'required|string',
            'feature_3_icon' => 'required|string',
            'feature_3_title' => 'required|string|max:255',
            'feature_3_description' => 'required|string',
        ]);

        // Handle image upload
        $aboutImagePath = null;
        if ($request->hasFile('about_image')) {
            $image = $request->file('about_image');
            $imageName = 'about-us-' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/about-us', $imageName);
            $aboutImagePath = 'storage/about-us/' . $imageName;
        }

        $fields = [
            'about_title',
            'about_paragraph_1',
            'about_paragraph_2',
            'about_paragraph_3',
            'why_choose_title',
            'feature_1_icon',
            'feature_1_title',
            'feature_1_description',
            'feature_2_icon',
            'feature_2_title',
            'feature_2_description',
            'feature_3_icon',
            'feature_3_title',
            'feature_3_description'
        ];

        foreach ($fields as $field) {
            Setting::updateOrCreate(
                ['key' => $field],
                ['value' => $request->input($field)]
            );
        }

        // Update image path if a new image was uploaded
        if ($aboutImagePath) {
            Setting::updateOrCreate(
                ['key' => 'about_image'],
                ['value' => $aboutImagePath]
            );
        }

        return redirect()->route('admin.about-us.index')->with('success', 'About Us content updated successfully!');
    }
}
