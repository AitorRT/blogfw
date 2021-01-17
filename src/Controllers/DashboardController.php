<?php

namespace App\Controllers;

use App\Request;
use App\Controller;
use App\Session;

final class DashboardController extends Controller
{

    public function __construct(Request $request, Session $session)
    {
        parent::__construct($request, $session);
    }
    public function index()
    {
        $db = $this->getDB();
        $user = $this->session->get('uname');
        $username = $user['username'];
        $dataview = ['title' => 'Dashboard', 'username' => $username];
        $this->render($dataview);
    }
    public function insertPost()
    {
        $db = $this->getDB();
        $user = $this->session->get('uname');
        $username = $user['username'];
        //post parameters
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $cont = filter_input(INPUT_POST, 'cont', FILTER_SANITIZE_STRING);
        //user parameters
        $user = $this->session->get('uname');
        $userid = $user['id'];
        //all parameters
        $data = ['title' => $title, 'cont' => $cont, 'user' => $userid];
        $result = $this->getDB()->insert('post', $data);
        
        //tags parameters
        $postId = $db->lastInsertId();
        $tagname = filter_input(INPUT_POST, 'tagname', FILTER_SANITIZE_STRING);
        if ($tagname == "generic") {
            $tags_id = 1;
        } else if ($tagname == "videogames") {
            $tags_id = 2;
        } else if ($tagname == "animals") {
            $tags_id = 3;
        } else if ($tagname == "plants") {
            $tags_id = 4;
        } else if ($tagname == "sports") {
            $tags_id = 5;
        }
        $data = ['post_id' => $postId, 'tags_id' => $tags_id];

        $result1 = $this->getDB()->insert('post_has_tags', $data);
        $this->render(['title' => 'Dashboard', 'username' => $username], 'dashboard');
    }
    public function selectPosts()
    {
        $db = $this->getDB();
        $user = $this->session->get('uname');
        $username = $user['username'];
        $condition = ['user', $user['id']];
        $data = $db->selectWhere('post', $fields = null, $condition);
        $tags = [];
        for ($i=0; $i < count($data); $i++) { 
            $table1 = 'post_has_tags';
            $table2 =  'tags';
            $fields = ['tag'];
            $join1 = "tags_id";
            $join2 = "id";
            $condition = ['post_has_tags.post_id',$data[$i]['id']];
            array_push($tags,$db->selectWhereWithJoin($table1, $table2, $fields, $join1, $join2, $condition));
        }
        $this->render(['title' => 'Dashboard', 'username' => $username, 'data' => $data,'tags' => $tags], 'dashboard');
    }
    public function deletePost()
    {
        $db = $this->getDB();
        $idP = filter_input(INPUT_POST, 'idP', FILTER_SANITIZE_STRING);
        $user = $this->session->get('uname');
        $username = $user['username'];
        $db->removeTags('post_has_tags', $idP);
        $db->removeComments('comments', $idP);
        $data = $db->remove('post', $idP);
        $this->render(['title' => 'Dashboard', 'username' => $username, 'data' => $data], 'dashboard');
    }
    public function modifyPost()
    {
        $ntitle = filter_input(INPUT_POST, 'changedTitle', FILTER_SANITIZE_STRING);
        $ncont = filter_input(INPUT_POST, 'changedCont', FILTER_SANITIZE_STRING);
        $nidPost = filter_input(INPUT_POST, 'changedidP', FILTER_SANITIZE_STRING);
        $user = $this->session->get('uname');
        $username = $user['username'];
        $data = ['title' => $ntitle, 'cont' => $ncont];
        $conditions = ['id', $nidPost];
        $result = $this->getDB()->update('post', $data, $conditions);
        $this->render(['title' => 'Dashboard', 'username' => $username, 'data' => $result], 'dashboard');
    }
}
