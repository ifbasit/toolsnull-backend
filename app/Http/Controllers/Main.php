<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin;
use DB;
use Validator;
use Redirect;
use Session;
use \stdClass;
Use Exception;

class Main extends Controller {
    
    public function index(Request $req){

        $a = self::getLastestArticles();
        $c =  self::getLatestCodeSolutions();
     
       return view('main.index')->with(['a'=>$a,'c'=>$c]);
    }

    public static function getLastestArticles(){

        $g = DB::table("articles")
        ->join('categories', 'articles.cat_id', '=', 'categories.id')
        ->orderBy('articles.article_id', 'desc')->take(4)->get();
        return $g;
    }

    public static function getLatestCodeSolutions(){

        $g = DB::table("code_solution")->orderBy('code_solution_id', 'desc')->take(6)->get();
        return $g;
    }

    public static function getCodeSolutionsByTagName($name){

        $g = DB::table('tags')
            ->join('code_solution_tag', 'tags.id', '=', 'code_solution_tag.tag_id')
            ->join('code_solution', 'code_solution_tag.code_solution_id', '=', 'code_solution.code_solution_id')
            ->where('tags.name','=',$name)
            ->get();
        return $g;

    }

    public static function getArticlesByCategoryID($id){
         $g = DB::table('articles')
            ->join('categories', 'articles.cat_id', '=', 'categories.id')
            ->where('articles.cat_id','=',$id)
            ->get();
        return $g;
    }

}
