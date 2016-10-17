<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends MainController
{

    public function index() {
        self::$data['title'] = self::$data['title'] . ' | Home page';
        return view('content.home', self::$data);
    }

    public function about() {
        self::$data['title'] = self::$data['title'] . ' | About us';
        return view('content.about', self::$data);
    }
}
