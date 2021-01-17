<?php

namespace App\Controllers;

use App\Request;
use App\Controller;
use App\Session;

final class LogoutController extends Controller
{

    public function __construct(Request $request, Session $session)
    {
        parent::__construct($request, $session);
    }

    public function index()
    {
        $db = $this->getDB();
        $dataview = ['title' => 'Todo'];
        $this->render($dataview);
    }

    public function out()
    {
        //Eliminar session
        session_destroy();
        //ELiminar cookies
        if (isset($_COOKIE['uname']) && isset($_COOKIE['passw'])) {
            setcookie("uname", null, time() - 3600, '/');
            setcookie("passw", null, time() - 3600, '/');
            setcookie("rememberUser", null, time() - 3600, '/');
            setcookie("rememberPassword", null, time() - 3600, '/');
        }
        header('Location:' . BASE . 'login');
    }
}
