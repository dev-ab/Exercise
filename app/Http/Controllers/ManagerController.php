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

    //view system users
    public function view_users(Request $request) {

        $this->authorize('view_users', $request);

        $users = \App\User::with('info')->where('id', '!=', Auth::user()->id)->get();

        return view('users', ['users' => $users]);
    }

    public function view_profile(Request $request, $id = null) {
        if ($id && Auth::user()->id != $id)
            $this->authorize('view_users', $request);

        //specify user
        if ($id) {
            $user = \App\User::findOrFail($id);
        } else {
            $user = Auth::user();
        }

        $user->load('info', 'group.permissions', 'projects.attachments');

        //dump javascript vars
        JavaScript::put([
            'user' => $user,
            'groups' => \App\Group::all()
        ]);

        return view('profile', ['user' => $user]);
    }

    public function save_info(Request $request, $id) {
        if (Auth::user()->id != $id)
            $this->authorize('save_info', $request);

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
        $user->load('info', 'group.permissions', 'projects.attachments');
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

    public function save_project(Request $request, $id) {
        if (Auth::user()->id != $id)
            $this->authorize('save_info', $request);

        $user = \App\User::findOrFail($id);

        if ($request->input('id') != 'null') {
            $project = \App\Project::findOrFail($request->input('id'));
            $project->update($request->all());
        } else {
            $project = \App\Project::create($request->all());
        }

        $project->user()->associate($user)->save();

        foreach ($request->file('file') as $file) {
            $res = fopen($file->path(), 'r+');
            $size = $file->getSize();
            $filename = md5($user->id) . '/' . rand(1, 1000000) . $file->getClientOriginalName();
            Storage::put($filename, $res);
            $att = \App\Attachment::create(['url' => $filename, 'size' => $size]);
            $att->project()->associate($project)->save();
        }
    }

    public function delete_project(Request $request, $id) {
        if (Auth::user()->id != $id)
            $this->authorize('save_info', $request);

        $user = \App\User::findOrFail($id);
        $proj = $user->projects()->where('id', $request->input('id'))->get();
        $proj = $proj[0];
        $proj->attachments()->delete();
        $proj->delete();
    }

    public function delete_att(Request $request, $id) {
        if (Auth::user()->id != $id)
            $this->authorize('save_info', $request);

        $user = \App\User::findOrFail($id);
        $proj = $user->projects()->where('id', $request->input('id'))->get();
        $proj = $proj[0];
        $proj->attachments()->where('url', $request->input('url'))->delete();
    }

    public function delete_user(Request $request, $id) {
        if (Auth::user()->id != $id)
            $this->authorize('save_info', $request);

        $user = \App\User::findOrFail($id);
        foreach ($user->projects as $proj) {
            $proj->attachments()->delete();
        }
        $user->projects()->delete();
        $user->delete();
    }

    //view security groups
    public function view_groups(Request $request) {
        $this->authorize('view_groups', $request);
        JavaScript::put([
            'groups' => \App\Group::with('permissions')->get(),
            'permissions' => \App\Permission::all()
        ]);
        return view('groups');
    }

    public function update_group(Request $request, $id) {
        $this->authorize('save_groups', $request);
        $data = $request->all();

        if ($id == 'null') {
            $group = \App\Group::create($data);
        } else {
            $group = \App\Group::findOrFail($id);
            $group->update($data);
        }

        if (isset($data['permissions'])) {
            $group->permissions()->sync(array_keys($data['permissions']));
        } else {
            $group->permissions()->sync([]);
        }
    }

    public function delete_group(Request $request, $id) {
        $this->authorize('save_groups', $request);

        $group = \App\Group::findOrFail($id);
        $group->permissions()->sync([]);
        $group->delete();
    }

    public function reload_groups() {
        return response()->json(['groups' => \App\Group::with('permissions')->get()]);
    }

}
