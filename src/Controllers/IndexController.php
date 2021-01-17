<?php

namespace App\Controllers;

use App\Request;
use App\Controller;
use App\Session;

final class IndexController extends Controller
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
        $dataview = ['title' => 'Todo', 'username' => $username];
        $this->render($dataview);
    }
}
