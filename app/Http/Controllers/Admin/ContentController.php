<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $blogPosts = BlogPost::with('author')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.content.index', compact('blogPosts'));
    }

    public function create()
    {
        return view('admin.content.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|in:draft,published',
            'meta_title' => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string',
        ]);

        $data = $request->all();
        
        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            try {
                $image = $request->file('featured_image');
                $imageName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $image->getClientOriginalName());
                $imagePath = $image->storeAs('blog-images', $imageName, 'public');
                $data['featured_image'] = '/storage/' . $imagePath;
            } catch (\Exception $e) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['featured_image' => 'Failed to upload image. Please try again.']);
            }
        }

        $post = BlogPost::create($data + [
            'slug' => Str::slug($request->title),
            'author_id' => auth()->id(),
            'published_at' => $request->status === 'published' ? now() : null,
        ]);

        return redirect()->route('admin.content.index')
            ->with('success', 'Blog post created successfully!');
    }

    public function show(BlogPost $content)
    {
        $content->load('author');
        
        return view('admin.content.show', compact('content'));
    }

    public function edit(BlogPost $content)
    {
        return view('admin.content.edit', compact('content'));
    }

    public function update(Request $request, BlogPost $content)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|in:draft,published',
            'meta_title' => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string',
        ]);

        $data = $request->all();
        
        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            try {
                $image = $request->file('featured_image');
                $imageName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $image->getClientOriginalName());
                $imagePath = $image->storeAs('blog-images', $imageName, 'public');
                $data['featured_image'] = '/storage/' . $imagePath;
            } catch (\Exception $e) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['featured_image' => 'Failed to upload image. Please try again.']);
            }
        }

        $content->update($data + [
            'slug' => Str::slug($request->title),
            'published_at' => $request->status === 'published' && !$content->published_at ? now() : $content->published_at,
        ]);

        return redirect()->route('admin.content.index')
            ->with('success', 'Blog post updated successfully!');
    }

    public function destroy(BlogPost $content)
    {
        $content->delete();

        return redirect()->route('admin.content.index')
            ->with('success', 'Blog post deleted successfully!');
    }

    public function testimonials()
    {
        $testimonials = Testimonial::orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.content.testimonials', compact('testimonials'));
    }

    public function approveTestimonial(Testimonial $testimonial)
    {
        $testimonial->update(['is_approved' => true]);

        return redirect()->route('admin.content.testimonials')
            ->with('success', 'Testimonial approved!');
    }

    public function rejectTestimonial(Testimonial $testimonial)
    {
        $testimonial->update(['is_approved' => false]);

        return redirect()->route('admin.content.testimonials')
            ->with('success', 'Testimonial rejected!');
    }

    public function deleteTestimonial(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('admin.content.testimonials')
            ->with('success', 'Testimonial deleted successfully!');
    }
}
