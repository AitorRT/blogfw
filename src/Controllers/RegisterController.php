<?php

namespace App\Controllers;

use App\Request;
use App\Controller;
use App\Session;

final class RegisterController extends Controller
{

    public function __construct(Request $request, Session $session)
    {
        parent::__construct($request, $session);
    }

    public function index()
    {
        $db = $this->getDB();
        $user = $this->session->get('uname');
        
        if($user){
            $username = $user['username'];
        }else{
            $username = "user";
        }
        $dataview = ['title' => 'Register', 'username' => $username];
        $this->render($dataview);
    }

    public function reg()
    {
        //if parameters are setted
        if (
            isset($_POST['uname']) && !empty($_POST['uname'])
            && isset($_POST['pass']) && !empty($_POST['pass'])
            && isset($_POST['email']) && !empty($_POST['email'])
        ) {
            //Parameters
            $uname = filter_input(INPUT_POST, 'uname',FILTER_SANITIZE_STRING);
            $pass1 = filter_input(INPUT_POST, 'pass',FILTER_SANITIZE_STRING);
            $pass = password_hash($pass1, PASSWORD_BCRYPT, ["cost" => 4]);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $data = ['username' => $uname,'email' => $email, 'passwd' => $pass, 'rol' => 2];

            //call function insert and go to login
            $dbuser = $this->getDB()->insert('user', $data);

            if ($dbuser) {
                header('Location:' . BASE . 'login');
            } else {
                header('Location:' . BASE . 'register');
            }
        } else {
            //else show error and go to register
            header('Location:' . BASE . 'register');
        }
    }
}