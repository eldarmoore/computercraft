<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Categorie;
use App\Menu;

class MainController extends Controller
{
    static public $data = ['title' => 'Computercraft'];

    public function __construct()
    {
        self::$data['menu'] = Menu::all()->toArray();
        self::$data['categories'] = Categorie::all()->toArray();
    }
}
