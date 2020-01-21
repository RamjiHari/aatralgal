<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Title;
use App\Category;
use App\Tag;
use App\Post;
use Illuminate\Support\Facades\DB;
class GetContentController extends Controller
{
    

	  public function gettitle(Request $request)
    {
        $data = Title::where("category_id",$request->value)->get();
     $output = '<option value="">Select</option>';
     foreach($data as $row)
     {
      $output .= '<option value="'.$row->id.'">'.$row->title.'</option>';
     }
     echo $output;
    }
     public function getsidetitle(Request $request)
    {
              // $data = DB::table('titles')->leftJoin('posts', 'titles.id', '=', 'posts.title_id')->where("posts.category_id",$request->id)->select('titles.*')->get();
        $data = Title::leftJoin('posts', 'titles.id', '=', 'posts.title_id')->where("posts.category_id",$request->id)->select('titles.*')->get();
              $output='';
     foreach($data as $row)
     {
      $output .= '<li class="nav-item active" id='.$row->id.'><a href="#" class="nav-link remov side-menu-li'.$row->id.'" onclick="getSidebar('.$row->id.')"><i class="far fa-circle nav-icon"></i><p>'.$row->title.'</p></a></li>';
     }
     echo $output;
    }

        public function getcontent(Request $request)
    {
             $data = Post::where("title_id",$request->id)->get();
             if($data->count()>0){
             echo json_encode($data);
         }else{
         	echo "0";
         }
    }
}
