<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;

class UserPolicy {

    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    public function index(User $user) {
        return true;
    }

    public function view_users(User $user) {
        return true;
    }

    public function view_groups(User $user) {
        return true;
    }

}
