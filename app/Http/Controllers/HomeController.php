<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        $randomPost = Post::inRandomOrder()->first();
        $prebuildSale = Post::where('tags', 'like', '%sale%')->where('title', 'like', '%prebuild%')->inRandomOrder()->limit(4)->get();
        $notebookSale=Post::where('tags', 'like', '%sale%')->where('title', 'like', '%notebook%')->inRandomOrder()->limit(4)->get();
        $monitorSale=Post::where('tags', 'like', '%sale%')->where('title', 'like', '%monitor%')->inRandomOrder()->limit(4)->get();


        return view('home', compact('posts', 'randomPost', 'prebuildSale', 'notebookSale', 'monitorSale'));
    }
    
}
