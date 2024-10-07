<?php

namespace App\Controllers;


class ErrorController
{
    /**
     * 404 not found error
     *
     * @return void
     */
    public static function notfound($massage = 'file not found')
    {
        http_response_code(404);
        loadview('error', [
            'status' => 404,
            'massage' => $massage,
        ]);
    }
    /**
     * 403 unauthorized error
     *
     * @return void
     */
    public static function unauthorized($massage = 'Your not authorized to access this page')
    {
        http_response_code(403);
        loadview('error', [
            'massage' => $massage,
            'status' => 403
        ]);
    }
};
