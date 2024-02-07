<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class PostsController extends Controller
{

    public function index(Request $request)
    {
        $resolutionQuery = DB::table('posts')
            ->selectRaw("substr(description, instr(description, 'Resolution:') + length('Resolution:') + 1, 
                instr(substr(description, instr(description, 'Resolution:') + length('Resolution:') + 1), ',') - 1) as resolution")
            ->where('description', 'like', '%Resolution:%')
            ->get();

        $displaySizeQuery = DB::table('posts')
            ->selectRaw("substr(description, instr(description, 'Display Size:') + length('Display Size:') + 1, 
                instr(substr(description, instr(description, 'Display Size:') + length('Display Size:') + 1), ',') - 1) as display_size")
            ->where('description', 'like', '%Display Size:%')
            ->get();

        $panelTypeQuery = DB::table('posts')
            ->selectRaw("substr(description, instr(description, 'Panel Type:') + length('Panel Type:') + 1, 
                instr(substr(description, instr(description, 'Panel Type:') + length('Panel Type:') + 1), ',') - 1) as panel_type")
            ->where('description', 'like', '%Panel Type:%')
            ->get();

        $refreshRateQuery = DB::table('posts')
            ->selectRaw("substr(description, instr(description, 'Refresh Rate:') + length('Refresh Rate:') + 1, 
                instr(substr(description, instr(description, 'Refresh Rate:') + length('Refresh Rate:') + 1), ',') - 1) as refresh_rate")
            ->where('description', 'like', '%Refresh Rate:%')
            ->get();

        $responseTimeQuery = DB::table('posts')
            ->selectRaw("substr(description, instr(description, 'Response Time:') + length('Response Time:') + 1, 
                instr(substr(description, instr(description, 'Response Time:') + length('Response Time:') + 1), ',') - 1) as response_time")
            ->where('description', 'like', '%Response Time:%')
            ->get();

        $processorQuery = DB::table('posts')
            ->selectRaw("SUBSTR(tags, INSTR(tags, 'Processor:') + LENGTH('Processor:'), INSTR(SUBSTR(tags, INSTR(tags, 'Processor:') + LENGTH('Processor:')), ',') - 1) as processor")
            ->where('tags', 'like', '%Processor:%')
            ->get();

        $graphicsCardQuery = DB::table('posts')
            ->selectRaw("SUBSTR(tags, INSTR(tags, 'Graphics Card:') + LENGTH('Graphics Card:'), INSTR(SUBSTR(tags, INSTR(tags, 'Graphics Card:') + LENGTH('Graphics Card:')), ',') - 1) as graphics_card")
            ->where('tags', 'like', '%Graphics Card:%')
            ->get();

        $memoryQuery = DB::table('posts')
            ->selectRaw("SUBSTR(tags, INSTR(tags, 'Memory (RAM):') + LENGTH('Memory (RAM):'), INSTR(SUBSTR(tags, INSTR(tags, 'Memory (RAM):') + LENGTH('Memory (RAM):')), ',') - 1) as memory_ram")
            ->where('tags', 'like', '%Memory (RAM):%')
            ->get();
        
        $storageQuery = DB::table('posts')
            ->selectRaw("SUBSTR(tags, INSTR(tags, 'Storage:') + LENGTH('Storage:'), INSTR(SUBSTR(tags, INSTR(tags, 'Storage:') + LENGTH('Storage:')), ',') - 1) as storage")
            ->where('tags', 'like', '%Storage:%')
            ->get();
            
        $osQuery = DB::table('posts')
            ->selectRaw("SUBSTR(tags, INSTR(tags, 'Operating System:') + LENGTH('Operating System:'), INSTR(SUBSTR(tags, INSTR(tags, 'Operating System:') + LENGTH('Operating System:')), ',') - 1) as operating_system")
            ->where('tags', 'like', '%Operating System:%')
            ->get();

        $displayQuery = DB::table('posts')
            ->selectRaw("SUBSTR(tags, INSTR(tags, 'Display:') + LENGTH('Display:'), INSTR(SUBSTR(tags, INSTR(tags, 'Display:') + LENGTH('Display:')), ',') - 1) as display")
            ->where('tags', 'like', '%Display:%')
            ->get();
    

        if ($request->has('price')) {
            $price = $request->input('price');
            $posts = Post::where('price', '<=', $price)->with('user')->latest()->get();
        } else {
            $posts = Post::with('user')->latest()->get();
        }

        return view('products.index', compact('posts','resolutionQuery', 'displaySizeQuery', 'panelTypeQuery', 'refreshRateQuery', 'responseTimeQuery','processorQuery','graphicsCardQuery','memoryQuery','storageQuery','osQuery','displayQuery'));
    }

    public function create(){

        return view('products.create');
    }

    public function store()
    {
        $data= request()->validate([
            'title'=>'required',
            'image'=>['required','image'],
            'price'=>'required',
            'description'=>'required',
            'tags'=>'required',
            'amount'=>'required',
        ]);

        $imagePath= request('image')->store('uploads','public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(600, 600);
        $image->save();

        auth()->user()->posts()->create([
            'title'=> $data['title'],
            'price'=> $data['price'],
            'description'=> $data['description'],
            'tags'=> $data['tags'],
            'amount'=> $data['amount'],
            'image'=>$imagePath,
        ]);

        return redirect('/products');

    }

    public function show(\App\Models\Post $post)
    {
        return view('products.show',compact('post'));
    }

    public function filterPosts(Request $request)
    {
        $price = $request->input('price');

        $filterPosts = Post::where('price', '<=', $price)->get();

        return view('products.index', compact('filterPosts'));
    }

    public function search(){

        $search_text=$_GET['query'];
        $posts=Post::where('title','LIKE','%'.$search_text.'%')->get();

        return view('search.index', compact('posts'));

    }

    public function delete($post){
        Post::find($post)->delete();
        return redirect('/');
    }
    

}
