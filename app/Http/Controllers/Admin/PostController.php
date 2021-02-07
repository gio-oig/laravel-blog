<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.form')->with('categories', Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->category_id);
        $request->validate([
            'title' => ['required', 'max:150', 'string'],
            'text' => ['required', 'min:5'],
            'image'=> ['required', 'image'],
            'category_id' => ['required'],
        ]);
        $image = $request->file('image');
        $fileName = time() . $image->getClientOriginalName();
        $image->move(public_path('/images'), $fileName);


        Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'text' => $request->text,
            'image' => "/images/$fileName",
            'category_id' => $request->category_id
        ]);

        return redirect()->route('admin.post.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $post = Post::with('category')->find($id);
        return view('admin.post.form', compact('categories','post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::where('id', $id)->first();

        // dd($request->all());

        $request->validate([
        'title' => ['required', 'min:5', 'max:150'],
        'text' => ['required'],
        'image' => ['nullable', 'image'],
        'category_id' => ['required'],
        ]);

        if($request->file('image')) {
            $fileName = $request->file('image')->getClientOriginalName();
            $savedFileName = time() . $fileName;
            $request->file('image')->move(public_path('/images'), $savedFileName);

            $post->image = '/images/' . $savedFileName;
        }

        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->category_id = $request->category_id;
        $post->text = $request->text;
        $post->save();

        return redirect()->route('admin.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
