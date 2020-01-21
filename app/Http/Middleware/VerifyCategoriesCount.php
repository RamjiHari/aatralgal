<?php

namespace App\Http\Middleware;

use Closure;
use App\Category;
use App\Title;
class VerifyCategoriesCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
         if(Category::all()->count()===0){
            session()->flash('error','please add category you need to add post');
            return redirect()->route('categories.create');
        }
                 if(Title::all()->count()===0){
            session()->flash('error','please add Title you need to add post');
            return redirect()->route('title.create');
         }
        return $next($request);
    }
}
