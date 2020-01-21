<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Title;
use App\Category;
use App\Tag;
use App\Post;
use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        $this->middleware('verifyCategoriesCount')->only(['store','create']);
    }
    
    public function index()
    {
        $arr['posts']=Post::all();
        return view('posts.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $arr['categories'] = Category::all();
       $arr['titles'] = Title::all();
       $arr['tags']=Tag::all();
       return view('posts.create')->with($arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request,Post $post)
    {
        $data = Post::where("title_id",$request->title)->get();
        if(count($data)==0){
        if(isset($request->image) && $request->image->getClientOriginalName()){
            $ext =  $request->image->getClientOriginalExtension();
            $file = date('YmdHis').rand(1,99999).'.'.$ext;
            $request->image->storeAs('public/posts',$file);
        }
        else
        {
             if(!$post->image)
                $file = 'avtar1.jpeg';
        }

        $post->image = $file;
        $post->title_id = $request->title;
        $post->category_id = $request->category;
        $post->ptitle = $request->ptitle;
        $post->content = $request->content;
        $post->example = $request->example;
        $post->published_at = $request->published_at;
        $post->potedby = auth()->user()->id;
        $post->save();
        // if($request->tags){
        //     $post->tags()->attach($request->tags);
        // }
        session()->flash('success','Post add Success');
        return redirect()->route('post.index');
    }else{
       session()->flash('error','Post Already Exits');
        return redirect()->route('post.index'); 
    }

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
    public function edit(Post $post)
    {
         $arr['categories']=Category::all();
         $arr['titles']=Title::all();
         $arr['tags']=Tag::all();
      return view('posts.create')->with('posts',$post)->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request,Post $post)
    {
       
        if(isset($request->image) && $request->image->getClientOriginalName()){
            $ext =  $request->image->getClientOriginalExtension();
            $file = date('YmdHis').rand(1,99999).'.'.$ext;
            $request->image->storeAs('public/posts',$file);
            $post->deleteimage();
        }
        else
        {
             if(!$post->image)
                $file = 'avtar1.jpeg';
            else
                $file = $post->image;
        }

        $post->image = $file;
        $post->title_id = $request->title;
        $post->category_id = $request->category;
        $post->ptitle = $request->ptitle;
        $post->content = $request->content;
        $post->example = $request->example;
        $post->published_at = $request->published_at;
        $post->potedby = auth()->user()->id;
        $post->save();
        //  if($request->tags){
        //     $post->tags()->sync($request->tags);
        // }
        session()->flash('success','Post Updated Success');
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=POST::withTrashed()->where('id',$id)->firstorFail();
        if($post->trashed()){
              $post->deleteimage();
             $post->forceDelete();

        }else{
             $post->delete();
        }
        session()->flash('success','Post Deleted Success');
        return redirect()->route('post.index');
    }

     public function trashed()
    {
         $trashed=Post::onlyTrashed()->get();
          return view('posts.index')->with('posts',$trashed);
    }

        public function restore($id)
    {
        $post=POST::withTrashed()->where('id',$id)->firstorFail();
         $post->restore();
         session()->flash('success','Post Restore Success');
         return redirect()->back();
    }

    

     
}
