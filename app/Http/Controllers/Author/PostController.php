<?php

namespace App\Http\Controllers\Author;

use App\Post;
use App\Category;
use App\Tag;
use App\User;
use App\Notifications\NewAuthorPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Auth::User()->posts()->latest()->get();
        return view('author.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('author.post.create',compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'image' => 'required',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',
        ]);

        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = str_slug($request->title);
        $post->image = 'Picther';
        $post->body = $request->body;
        if(isset($request->status)){
            $post->status = true;
        }else{
            $post->status = false;
        }
        $post->is_approved = false;
        $post->save();

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);


        $lastId = $post->id;
        $prictureInfo = $request->file('image');
        $picName = $lastId.$prictureInfo->getClientOriginalName();
                                          
        $folder = "PostImage/";
        $prictureInfo->move($folder,$picName);
        $picUrl = $folder.$picName;
        $productPic = Post::find($lastId);
        $productPic->image = $picUrl;
        $productPic->save();


        $users = User::where('role_id','1')->get();
        Notification::send($users, new NewAuthorPost($post));
        return redirect()->route('author.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if ($post->user_id != Auth::id()) {
            return redirect()->back();
        }
        return view('author.post.show',compact('post'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if ($post->user_id != Auth::id()) {
            return redirect()->back();
        }

        $categories = Category::all();
        $tags = Tag::all();
        return view('author.post.edit',compact('post','categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request,[
            'title' => 'required',
            'image' => 'images',
            'tags' => 'required',
            'body' => 'required',
        ]);

        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = str_slug($request->title);
        $post->image = 'Picther';
        $post->body = $request->body;
        if(isset($request->status)){
            $post->status = true;
        }else{
            $post->status = false;
        }
        $post->is_approved = false;
        $post->save();

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);


        if($request->image){
            $lastId = $post->id;
        $prictureInfo = $request->file('image');
        $picName = $lastId.$prictureInfo->getClientOriginalName();
                                          
        $folder = "PostImage/";
        $prictureInfo->move($folder,$picName);
        $picUrl = $folder.$picName;
        $productPic = Post::find($lastId);
        $productPic->image = $picUrl;
        $productPic->save();
        }



        return redirect()->route('author.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->user_id != Auth::id()) {
            return redirect()->back();
        }
        $post->categories()->detach();
        $post->tags()->detach();
        $post->delete();
        return redirect()->route('author.post.index');
    }
}
