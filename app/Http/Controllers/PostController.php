<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use App\Category;

use App\Http\Requests\StoreBlogPost;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');

        $this->middleware('checkCategory')->only('create');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts= Post::paginate(5);
        
        return view("posts.index",compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories= Category::all();
        $tags= Tag::all();
        return view("posts.create", compact("categories","tags"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response  
     */
    public function store(StoreBlogPost  $request)
    {
        $validated = $request->validated();
       
        $post=Post::create(
            [
                'title'=>  $request->title,
                'description'=> $request->description,
                'content'=> $request->content,
                'category_id'=> $request->categoryId,
                'image'=>  $request->image->store('images','public')
            ]
        );if(isset($request->tagId) && count($request->tagId)!=0)
        $post->tags()->attach($request->tagId);
       $request->session()->flash("success","Post created successefly");
     return redirect(route('posts.index'));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view("posts.create")->withPost($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $validated = $request->validated();

        $data= $request->only(['title','description','content']);
        
        if ($request->hasFile('image')) {
            $image=$request->image->store('images','public');
            Storage::disk('public')->delete($post->image);
            $data['image']=$image;
        }        
        $post->update($data);
        $request->session()->flash("success","Post updated successefly");
        return redirect(route('posts.index'));
           
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->whereId($id)->first();
        if($post->trashed())
        {
            Storage::disk('public')->delete($post->image);
            $post->forceDelete();
            
            session()->flash("success","Post deleted successefly");
        }
         else
        {
            $post->delete();
            session()->flash("success","Post trashed successefly");
        }
        return redirect(route('posts.index'));               
    }
    public function trashed()
    {
        $trashed= Post::onlyTrashed()->paginate(5);
        return view('posts.index')->withPosts($trashed);               
    }
    public function restore($id)
    {  
        Post::withTrashed()->whereId($id)->restore();
        session()->flash("success","Post restored successefly");        
        return redirect()->back();
    }
}
