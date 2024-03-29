<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Content;
use DB;

class PagesController extends MainController
{

    public function index() {
        self::$data['title'] = self::$data['title'] . ' | Home page';
        self::$data['new_products'] = Product::orderBy('id', 'desc')->take(6)->get();
        self::$data['sliders'] = DB::table('sliders')->where('status', '=', 1)->get();

        if (isset($_GET['search'])){
            $user_search = filter_var($_GET['search'],  FILTER_SANITIZE_STRING);
            self::$data['search_result'] = DB::table('products')->where('title', 'like', "%$user_search%")->get();
        }

        return view('content.home', self::$data);
    }

    public function boot($url){
        Content::getContent($url, self::$data);
        return view('content.boot', self::$data);
    }

}
