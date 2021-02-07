<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
   public function home() {
       $posts = Post::leftJoin('categories','categories.id','=','posts.category_id')
       ->select('posts.*', 'categories.name as category_name', 'categories.slug as category_slug')
       ->get();
    //    dd($posts);
        return view('pages.index', compact('posts'));
   }
   public function singlePost($slug) {
        $post = Post::where('slug', $slug)->with('category')->firstOrFail();

        return view('pages.post', compact('post'));
   }

   public function singleCategory($slug) {
    $category = Category::where('slug', $slug)->with('posts')->firstOrFail();

    // dd($category);
    return view('pages.category', compact('category'));
   }

}
