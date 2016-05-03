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

    public function view_profile(Request $request, $id = null) {
        if ($id) {
            $user = \App\User::findOrFail($id);
        } else {
            $user = Auth::user();
        }

        return view('profile', ['user' => $user]);
    }

    public function save_info(Request $request, $id) {
        
    }

    public function save_avatar(Request $request, $id) {
        
    }

    public function save_security(Request $request, $id) {
        
    }

    public function add_project() {
        
    }

    public function delete_project() {
        
    }

    public function add_att() {
        
    }

    public function delete_att() {
        
    }

    //view system users
    public function view_users() {

        $this->authorize();

        return view('home');
    }

    //view security groups
    public function view_groups() {
        return view('home');
    }

    //edit security groups
    public function save_group() {
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
