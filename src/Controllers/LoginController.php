<?php

namespace App\Controllers;

use App\Request;
use App\Controller;
use App\Session;

final class LoginController extends Controller
{

    public function __construct(Request $request, Session $session)
    {
        parent::__construct($request, $session);
    }

    public function index()
    {
        $db = $this->getDB();
        $user = $this->session->get('uname');
        $dataview = ['title' => 'Login', 'username' => 'user'];
        $this->render($dataview);
    }

    public function log()
    {
        $remember = filter_input(INPUT_POST, 'remember', FILTER_SANITIZE_STRING);
        $uname = filter_input(INPUT_POST, 'uname', FILTER_SANITIZE_STRING);
        $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);

        //Call function
        $auth = $this->auth($uname, $pass);

        //if user is auth
        if ($auth) {

            $_SESSION['user'] = $auth;
            //go to home
            header('Location:' . BASE . 'dashboard');
            //if the user press checkbox remember me, set session remember.
            if ($remember) {
                //remember user
                setcookie('rememberUser', $uname, time() + 3600);
                setcookie('rememberPassword', $pass, time() + 3600);
                //go to home
                header('Location:' . BASE . 'dashboard');
            }

        } else {
            //else go to login
            header('Location:' . BASE . 'login');
        }
    }

    // funció d'autenticació
    // comprova si existeix usuari i password
    // i crea variables de sessió, això podria estar fora
    private function auth($uname, $pass): bool
    {
        try {
            $stmt = $this->getDB()->prepare('SELECT * FROM user WHERE username=:username LIMIT 1');
            $stmt->execute([':username' => $uname]);
            $count = $stmt->rowCount();
            $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($count == 1) {
                $uname = $row[0];
                $res = password_verify($pass, $uname['passwd']);
                if ($res) {
                    $this->session->set('uname', $uname);
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            return false;
        }
    }
}
