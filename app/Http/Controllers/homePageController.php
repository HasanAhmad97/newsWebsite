<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Category,Post,Urgent};
class homePageController extends Controller
{
    public function home(){
        $posts = Post::get();
        $categories= Category::get();
        $urgents = Urgent::select('name')->first();
        return view('website.homePage',compact('posts','categories','urgents'));
    }
    public function newsType($id){
        // $id = Post::select('category_id');
        // $posts = Post::select('title','post','created_at','photo')->get();
        // $categories= Category::get();
        $posts = Post::where('category_id',$id)->get();
        $categories= Category::get();

        return view('website.news.newsType',compact('posts','categories'));
    }

    // public function siasa(){
    //     $posts = Post::where('category_id',2)->get();
    //     $categories= Category::get();
    //     return view('website.news.sport',compact('posts','categories'));
    // }

    // public function aflam(){
    //     $posts = Post::where('category_id',5)->get();
    //     $categories= Category::get();
    //     return view('website.news.sport',compact('posts','categories'));
    // }


}
