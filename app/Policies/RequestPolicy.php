<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Request;
use App\User;
use Auth;

class RequestPolicy {

    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    public function before(User $user) {
        if ($user->superAdmin) {
            return true;
        }
    }

    public function index(User $user) {
        return true;
    }

    public function view_profile(User $user, Request $request) {
        if (in_array('view_profile', $user->group->permissions->pluck('name')->all()))
            return true;
        else
            return false;
    }

    public function save_info(User $user, Request $request) {
        if (in_array('save_info', $user->group->permissions->pluck('name')->all()))
            return true;
        else
            return false;
    }

    public function view_groups(User $user) {
        return true;
    }

}
