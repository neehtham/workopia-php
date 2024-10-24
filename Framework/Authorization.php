<?php

namespace Framework;

use Framework\Session;

class Authorization
{
    /**
     * check if current user owns the resorce 
     * @param int $resorse_id
     * @return bool
     */
    public static function isOwner($resorse_id)
    {
        $session_user = Session::get('user');
        if ($session_user !== null && isset($session_user['id'])) {
            $session_users_id = (int) $session_user['id'];
            return $session_users_id === $resorse_id;
        }
        return false;
    }
}
