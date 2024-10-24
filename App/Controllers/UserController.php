<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;
use Framework\Session;

class UserController
{
    protected $db;
    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * load login view
     *
     * @return void
     */
    public function login()
    {
        loadView('users/login');
    }

    /**
     * load create view
     *
     * @return void
     */
    public function create()
    {
        loadView('users/create');
    }

    /**
     * store user info
     * @return void
     */
    public function store()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $password = $_POST['password'];
        $passwordConfirmation = $_POST['password_confirmation'];

        $errors = [];
        // validation
        if (!Validation::email($email)) {
            $errors['email'] = 'Please enter a valid email';
        }
        if (!Validation::string($name, 2, 50)) {
            $errors['name'] = 'Name must be between 2 and 50 characters';
        }
        if (!Validation::string($password, 8, 50)) {
            $errors['password'] = 'Password must be between 8 and 50 characters';
        }
        if (!Validation::match($password, $passwordConfirmation)) {
            $errors['password_confirmation'] = 'passwords must match';
        }
        // check if users exist 
        $prams = [
            'email' => $email,
        ];
        $user  = $this->db->query('SELECT * FROM user WHERE email = :email;', $prams)->fetch();
        if ($user) {
            $errors['email'] = 'this user already exists';
        }
        if (!empty($errors)) {
            loadView('/users/create', [
                'errors' => $errors,
                'user' => ['name' => $name, 'city' => $city, 'country' => $country, 'email' => $email]
            ]);
            exit;
        }
        $prams = [
            'name' => $name,
            'email' => $email,
            'city' => $city,
            'country' => $country,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];
        $this->db->query('INSERT INTO user (name, email, city, country, password) VALUES (:name, :email, :city, :country, :password)', $prams);
        $userId = $this->db->conn->lastInsertId();
        //set user session 
        Session::set('user', [
            'id' => $userId,
            'name' => $name,
            'email' => $email,
            'city' => $city,
            'country' => $country,
        ]);
        redirect('/');
    }
    /**
     * Log out and delete session
     *
     * @return void
     */
    public function logout()
    {
        Session::clearAll();
        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 86400, $params['path'], $params['domain']);

        redirect('/');
    }
    /**
     * verify and log in a user
     * @return void
     */
    public function authenticate()
    {
        $password = $_POST['password'] ?? '';
        $email = $_POST['email'] ?? '';
        $errors = [];

        //validate email and name
        if (!Validation::email($email)) {
            $errors['email'] = 'Please enter a valid email';
        }
        if (!Validation::string($password, 6, 50)) {
            $errors['$password'] = 'Password must be atleast 8 letters';
        }
        //Check for the email
        $params = [
            'email' => $email
        ];
        $user = $this->db->query('SELECT * FROM user WHERE email = :email;', $params)->fetch();
        if (!$user) {
            $errors['email'] = 'incorrect credensials';
        }
        if (!password_verify($password, $user['password'])) {
            $errors['password'] = 'incorrect credensials';
        }
        //Check if there are errors
        if (!empty($errors)) {
            loadView('/users/login', [
                'errors' => $errors,
            ]);
            exit();
        }
        // set user session
        Session::set('user', [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'city' => $user['city'],
            'country' => $user['country'],
        ]);
        redirect('/');
    }
}
