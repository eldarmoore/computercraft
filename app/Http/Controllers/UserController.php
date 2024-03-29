<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\SigninRequest;
use App\Http\Requests\SignupRequest;
use App\User;
use Session;

class UserController extends MainController
{
    function __construct()
    {
        parent::__construct();
        $this->middleware('userLoged', ['except'=> ['getLogout', 'getProfile', 'index']]);
    }

    public function index()
    {
        self::$data['users'] = User::all()->toArray();
        return view('cms.users', self::$data);
    }

    public function getSignin(){
        // echo bcrypt('123456'); die();
        self::$data['title'] = self::$data['title'] . ' | signin page';
        return view('forms.signin', self::$data);
    }

    public function getSignup(){
        self::$data['title'] = self::$data['title'] . ' | signup page';
        return view('forms.signup', self::$data);
    }

    public function postSignup(SignupRequest $request){
        User::saveUser($request);
        return redirect('user/signin');
    }

    public function postSignin(SigninRequest $request){

        $des = isset($request['des']) ? $request['des'] : '';

        if( ! User::validateUser($request['email'], $request['password']) ){

            self::$data['title'] = self::$data['title'] . ' | signin page';
            return view('forms.signin', self::$data)->withErrors('Wrong email/password combination');

        } else {

            return redirect($des);

        }
    }

    public function show($id){
        self::$data['user_id'] = $id;
        return view('cms.delete_user', self::$data);
    }

    public function getLogout(){

        Session::forget('user_id');
        Session::forget('user_name');

        if( Session::has('is_admin') ){

            Session::forget('is_admin');

        }

        return redirect('user/signin');
    }

    public function getProfile($user_id){
        $user_id = User::find($user_id);
        if($user_id){
            self::$data['user'] = $user_id;
            return view('content.profile', self::$data);
        } else {
            return redirect('');
        }

    }

    public function destroy($id)
    {
        User::destroy($id);
        Session::flash('sm', 'User has been deleted');
        return redirect('cms/users');
    }
}
