<?php

namespace App\Http\Controllers\Admin;


use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $posts = Post::latest()->get();
        return view('admin.post.index',compact('posts'));
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
        return view('admin.post.create',compact('categories', 'tags'));
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
        $post->is_approved = true;
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



        return redirect()->route('admin.post.index');



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.edit',compact('post','categories', 'tags'));
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
            'image' => 'required',
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
        $post->is_approved = true;
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



        return redirect()->route('admin.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        
        $post->categories()->detach();
        $post->tags()->detach();
        $post->delete();
        return redirect()->route('admin.post.index');
    }


    public function pending()
    {
        $posts = Post::where('is_approved',false)->get();
        return view('admin.post.pending_post', compact('posts'));

    }

    public function approve($id)
    {
        $post = Post::find($id);
        if ($post->is_approved == false) {
            $post->is_approved = true;
            $post->save();
            return redirect()->route('admin.post.index');
        }else{
            echo "Error";
        }
            return redirect()->back();
    }


}
