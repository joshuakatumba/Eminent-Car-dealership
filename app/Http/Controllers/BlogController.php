<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use App\Services\TagExtractionService;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::with('author')
            ->where('status', 'published')
            ->whereNotNull('published_at');

        // Filter by tag if provided
        if ($request->has('tag') && $request->tag) {
            $query->withTag($request->tag);
        }

        $blogPosts = $query->orderBy('published_at', 'desc')->paginate(9);

        // Get recent posts for sidebar
        $recentPosts = BlogPost::with('author')
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        // Get tag counts for tag cloud
        $tagCounts = BlogPost::getTagCounts();

        // Get current tag for highlighting
        $currentTag = $request->tag;

        return view('blog-post', compact('blogPosts', 'recentPosts', 'tagCounts', 'currentTag'));
    }

    public function show($slug)
    {
        $blogPost = BlogPost::with('author')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->firstOrFail();

        // Get related posts
        $relatedPosts = BlogPost::with('author')
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('id', '!=', $blogPost->id)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        // Get tag counts for sidebar
        $tagCounts = BlogPost::getTagCounts();

        return view('blog-read', compact('blogPost', 'relatedPosts', 'tagCounts'));
    }
}
