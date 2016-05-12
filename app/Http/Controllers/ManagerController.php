<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use JavaScript;
use Manager;
use Storage;
Use Image;
use Hash;

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
    public function index(Request $request) {
        $this->authorize($request);
        return view('home', ['user' => Auth::user()]);
    }

    public function view_profile(Request $request, $id = null) {
        Manager::get();
        if ($id && Auth::user()->id != $id)
            $this->authorize($request);

        //specify user
        if ($id) {
            $user = \App\User::findOrFail($id);
        } else {
            $user = Auth::user();
        }

        //load relations
        @$user->info;
        @$user->group->permissions;

        //dump javascript vars
        JavaScript::put([
            'user' => $user,
            'groups' => \App\Group::all()
        ]);

        return view('profile', ['user' => $user]);
    }

    public function save_info(Request $request, $id) {
        if (Auth::user()->id != $id)
            $this->authorize($request);

        $user = \App\User::findOrFail($id);
        $data = $request->all();
        $info = [
            'title' => $data['title'],
            'fullname' => $data['fullname'],
            'job' => $data['job'],
            'birthdate' => $data['birthdate'],
        ];
        $user->info()->update($info);
        return response()->json([]);
    }

    public function save_avatar(Request $request, $id) {
        if (Auth::user()->id != $id)
            $this->authorize('save_info', $request);

        $user = \App\User::findOrFail($id);
        $file = $request->file('0');
        $res = fopen($file->path(), 'r+');
        $filename = md5($user->id) . '/' . $file->getClientOriginalName();
        $filethumb = md5($user->id) . '/thumb_' . $file->getClientOriginalName();
        Storage::put($filename, $res);

        $img = Image::make(fopen(storage_path('app/' . $filename), 'r+'))
                ->resize(125, 125);
        $img->save(storage_path('app/' . $filethumb));

        $user->info()->update(['profile_pic' => $filename, 'profile_thumb' => $filethumb]);

        return response()->json([]);
    }

    public function reload_user(Request $request, $id) {
        $user = \App\User::findOrFail($id);

        //load relations
        @$user->info;
        @$user->group->permissions;
        return response()->json(['user' => $user]);
    }

    public function save_password(Request $request, $id) {
        if (Auth::user()->id != $id)
            $this->authorize('save_info', $request);
        $user = \App\User::findOrFail($id);
        if (Auth::user()->id == $user->id &&
                !password_verify($request->input('current_password'), $user->password)) {
            return response()->json(['success' => 0]);
        }
        $user->password = password_hash($request->input('password'), PASSWORD_BCRYPT);
        $user->save();
        return response()->json(['success' => 1]);
    }

    public function save_group(Request $request, $id) {
        if (Auth::user()->id != $id)
            $this->authorize('save_info', $request);

        $gid = intval(substr($request->input('group'), 7));
        $user = \App\User::findOrFail($id);
        $group = \App\Group::findOrFail($gid);
        $user->group()->associate($group)->save();
        return response()->json([]);
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

    //view user projects
    public function view_projects() {
        return view('home');
    }

    // edit user projects
    public function edit_project() {
        return view('home');
    }

}
