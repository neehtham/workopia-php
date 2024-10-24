<?php

namespace Framework\Middleware;

use Framework\Session;

class Authorize
{
    /**
     * Find whether user is loged in
     *
     * @return boolean
     */
    public function isAuthenticated()
    {
        return Session::has('user');
    }
    /**
     * Undocumented function
     *
     * @param [type] $role
     * @return void
     */
    public function handle($role)
    {
        if ($role === 'guest' && $this->isAuthenticated()) {
            redirect('/');
        } elseif ($role === 'auth' && !$this->isAuthenticated()) {
            redirect('/auth/login');
        }
    }
}
