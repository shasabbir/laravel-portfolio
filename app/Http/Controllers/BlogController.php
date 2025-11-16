<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Redirect;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $blogs = Blog::query()->orderByDesc('date')->paginate(10);
        return view('blog.index', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        return view('blog.show', compact('blog'));
    }

    public function create()
    {
        return view('blog.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'min:1'],
            'excerpt' => ['required', 'string', 'min:1'],
            'content' => ['required', 'string', 'min:1'],
            // Require at least one of image_url or image
            'image_url' => ['nullable', 'string', 'required_without:image'],
            'image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:4096','required_without:image_url'],
            'image_hint' => ['required', 'string'],
            'tags' => ['nullable', 'string'], // comma separated
            'slug' => ['nullable', 'string'],
        ]);

        $slug = $data['slug'] ?? str( $data['title'] )
            ->lower()->squish()->replace(' ', '-')
            ->replaceMatches('/[^\w-]+/', '');

        $tags = isset($data['tags']) && $data['tags'] !== ''
            ? collect(explode(',', $data['tags']))->map(fn($t)=>trim($t))->filter()->values()->all()
            : [];

        $imageUrl = $data['image_url'] ?? null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/blog', 'public');
            $imageUrl = '/storage/' . $path;
        }

        $blog = Blog::create([
            'title' => $data['title'],
            'excerpt' => $data['excerpt'],
            'content' => $data['content'],
            'image_url' => $imageUrl ?? '',
            'image_hint' => $data['image_hint'],
            'slug' => $slug,
            'tags' => $tags,
            'date' => now(),
            'author_name' => auth()->user()?->name ?? 'GAZI SALAH UDDIN NUHASH',
            'author_avatar' => auth()->user()?->email ? 'https://www.gravatar.com/avatar/' . md5(strtolower(trim(auth()->user()->email))) . '?s=200&d=identicon' : 'https://i.postimg.cc/50FkXX3x/nuhash.jpg',
        ]);

        return Redirect::route('blog.show', $blog)->with('status', 'Blog created');
    }

    public function edit(Blog $blog)
    {
        return view('blog.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'min:1'],
            'excerpt' => ['required', 'string', 'min:1'],
            'content' => ['required', 'string', 'min:1'],
            'image_url' => ['nullable', 'string'],
            'image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:4096'],
            'image_hint' => ['required', 'string'],
            'tags' => ['nullable', 'string'], // comma separated
            'slug' => ['nullable', 'string'],
        ]);

        $slug = $data['slug'] ?? str( $data['title'] )
            ->lower()->squish()->replace(' ', '-')
            ->replaceMatches('/[^\w-]+/', '');

        $tags = isset($data['tags']) && $data['tags'] !== ''
            ? collect(explode(',', $data['tags']))->map(fn($t)=>trim($t))->filter()->values()->all()
            : [];

        $imageUrl = $data['image_url'] ?? $blog->image_url;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/blog', 'public');
            $imageUrl = '/storage/' . $path;
        }

        $blog->update([
            'title' => $data['title'],
            'excerpt' => $data['excerpt'],
            'content' => $data['content'],
            'image_url' => $imageUrl,
            'image_hint' => $data['image_hint'],
            'slug' => $slug,
            'tags' => $tags,
        ]);

        return Redirect::route('blog.show', $blog)->with('status', 'Blog updated');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return Redirect::route('blog.index')->with('status', 'Blog deleted');
    }
}
