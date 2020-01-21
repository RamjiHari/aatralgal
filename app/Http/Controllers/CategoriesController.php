<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr['categories']=Category::all();
        return view('categories.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request,Category $category)
    {

        if(isset($request->image) && $request->image->getClientOriginalName()){
            $ext =  $request->image->getClientOriginalExtension();
            $file = date('YmdHis').rand(1,99999).'.'.$ext;
            $request->image->storeAs('public/category',$file);

        }
        else
        {
             if(!$category->image)
                $file = 'avtar1.jpeg';
        }

      $category->name=$request->name;
      $category->description=$request->description;
      $category->image = $file;
       $category->save();
       session()->flash('success','Subject add Success');
       return redirect()->route('categories.index');
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
    public function edit(Category $category)
    {
         return view('categories.create')->with('category',$category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
       public function update(UpdateCategoryRequest $request,Category $category)
    {

        if(isset($request->image) && $request->image->getClientOriginalName()){
            $ext =  $request->image->getClientOriginalExtension();
            $file = date('YmdHis').rand(1,99999).'.'.$ext;
            $request->image->storeAs('public/category',$file);
            $category->deletecatimage();
        }
        else
        {
             if(!$category->image)
                $file = 'avtar1.jpeg';
            else
                $file = $category->image;
        }
        $category->name=$request->name;
        $category->description=$request->description;
        $category->image = $file;
       $category->save();
       session()->flash('success','Subject Update Success');
       return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        
        if($category->posts()->count()>0){

              session()->flash('error','Subject Cannot delete beacuse it related to '.$category->posts()->count().'post');
            return redirect()->back();
        }
        $category->delete();
        $category->deletecatimage();
        session()->flash('success','Subject Deleted Success');
        return redirect()->route('categories.index');
    }
}
