<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

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
        return view('home');
    }

    //view system users
    public function view_users() {
        
        $this->authorize($user);
        
        return view('home');
    }

    //edit users info
    public function edit_users() {
        return view('home');
    }

    //view security groups
    public function view_groups() {
        return view('home');
    }

    //edit security groups
    public function edit_groups() {
        return view('home');
    }

    //view user projects
    public function view_projects() {
        return view('home');
    }

    // edit user projects
    public function edit_projects() {
        return view('home');
    }

}
