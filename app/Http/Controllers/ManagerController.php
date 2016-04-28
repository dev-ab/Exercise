<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use JavaScript;

class ManagerController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    //view home page for users
    public function index() {
        $this->authorize(Auth::user());
        JavaScript::put([
            'user' => Auth::user()
        ]);

        return view('home', ['user' => Auth::user()]);
    }

    public function profile() {
        return view('profile');
    }

    //view system users
    public function view_users() {

        $this->authorize();

        return view('home');
    }

    //edit users info
    public function edit_user() {
        return view('home');
    }

    //view security groups
    public function view_groups() {
        return view('home');
    }

    //edit security groups
    public function edit_group() {
        return view('home');
    }

    //view user projects
    public function view_projects() {
        return view('home');
    }

    // edit user projects
    public function edit_project() {
        return view('home');
    }

}
