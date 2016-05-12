<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use JavaScript;
use Manager;
use Storage;
Use Image;

class FilesController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function view(Request $request, $path) {
        return response(Storage::get($path))
                        ->header('Content-Type', 'application/octet-stream')
                        ->header('Content-Disposition', 'inline');
    }

    public function save_info(Request $request, $id = null) {
        if ($id && Auth::user()->id != $id)
            $this->authorize($request);

        //specify user
        if ($id) {
            $user = \App\User::findOrFail($id);
        } else {
            $user = Auth::user();
        }

        //print_r($user);
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

}
