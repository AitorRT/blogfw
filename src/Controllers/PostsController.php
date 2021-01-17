<?php

namespace App\Controllers;

use App\Request;
use App\Controller;
use App\Session;

final class PostsController extends Controller
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
        $dataview = ['title' => 'Posts', 'username' => $username];
        $this->render($dataview);
    }

    public function selectAllPosts()
    {
        $db = $this->getDB();
        $user = $this->session->get('uname');
        $username = $user['username'];
        $data = $db->selectAll('post',$fields=null);
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
        $this->render(['title' => 'Posts', 'username' => $username, 'data' => $data, 'tags' => $tags], 'posts');
    }
    public function insertComment(){
        $comment = filter_input(INPUT_POST, 'newComment', FILTER_SANITIZE_STRING);
        $user = $this->session->get('uname');
        $username = $user['username'];
        $userId = filter_input(INPUT_POST, 'userId', FILTER_SANITIZE_STRING);
        $post = filter_input(INPUT_POST, 'idP', FILTER_SANITIZE_STRING);
        $data = ['comment' => $comment, 'user' =>$userId,'post' => $post];
        $result = $this->getDB()->insert('comments',$data);
        $this->render(['title' => 'Posts','username' => $username, 'data' => $result], 'posts');    
    }
    public function selectComments()
    {
        $user = $this->session->get('uname');
        $username = $user['username'];
        $post = filter_input(INPUT_POST, 'idP', FILTER_SANITIZE_STRING);
        $conditions = ['post', $post];
        $data = $this->getDB()->selectWhere('comments',$fields=null, $conditions);
        $this->render(['title' => 'Posts', 'username' => $username, 'data' => $data], 'posts');
    }
}