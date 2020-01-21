<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Title;
use App\Category;
use App\Http\Requests\Title\CreateTitleRequest;
use App\Http\Requests\Title\UpdateTitleRequest;
class TitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $arr['titles']=Title::all();
         return view('title.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arr['categories'] = Category::all();
         return view('title.create')->with($arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(CreateTitleRequest $request,Title $title)
    {
        $title->title=$request->name;
        $title->category_id =$request->category;
        $title->save();
        session()->flash('success','Title add Success');
        return redirect()->route('title.index');
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
    public function edit(Title $title)
    {
        $arr['categories'] = Category::all();
       return view('title.create')->with('title',$title)->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTitleRequest $request,Title $title)
    {
        $title->title=$request->name;
        $title->category_id =$request->category;
        $title->save();
        session()->flash('success','Title Updated Success');
        return redirect()->route('title.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Title $title)
    {
        if($title->posts()->count()>0){
              session()->flash('error','Tag Cannot delete beacuse it related to '.$title->posts()->count().'post');
            return redirect()->back();
        }
        $title->delete();
        session()->flash('success','Title Deleted Success');
        return redirect()->route('title.index');
    }
}
