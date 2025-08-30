<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogPosts = BlogPost::with('author')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.blog.index', compact('blogPosts'));
    }

    public function create()
    {
        $authors = User::where('role', 'admin')->get();
        return view('admin.blog.create', compact('authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'author_id' => 'required|exists:users,id',
            'status' => 'required|in:draft,published',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'tags' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['published_at'] = $request->status === 'published' ? now() : null;

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('blog-images', 'public');
            $data['featured_image'] = $imagePath;
        }

        BlogPost::create($data);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post created successfully!');
    }

    public function edit(BlogPost $blogPost)
    {
        $authors = User::where('role', 'admin')->get();
        return view('admin.blog.edit', compact('blogPost', 'authors'));
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'author_id' => 'required|exists:users,id',
            'status' => 'required|in:draft,published',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'tags' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        
        // Set published_at if status is changing to published
        if ($request->status === 'published' && $blogPost->status !== 'published') {
            $data['published_at'] = now();
        }

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($blogPost->featured_image) {
                Storage::disk('public')->delete($blogPost->featured_image);
            }
            
            $imagePath = $request->file('featured_image')->store('blog-images', 'public');
            $data['featured_image'] = $imagePath;
        }

        $blogPost->update($data);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post updated successfully!');
    }

    public function destroy(BlogPost $blogPost)
    {
        // Delete featured image if exists
        if ($blogPost->featured_image) {
            Storage::disk('public')->delete($blogPost->featured_image);
        }

        $blogPost->delete();

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post deleted successfully!');
    }

    public function toggleStatus(BlogPost $blogPost)
    {
        if ($blogPost->status === 'draft') {
            $blogPost->update([
                'status' => 'published',
                'published_at' => now()
            ]);
            $message = 'Blog post published successfully!';
        } else {
            $blogPost->update([
                'status' => 'draft',
                'published_at' => null
            ]);
            $message = 'Blog post moved to draft!';
        }

        return redirect()->route('admin.blog.index')
            ->with('success', $message);
    }
}
