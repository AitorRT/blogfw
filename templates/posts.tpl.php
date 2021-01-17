<?php
//if session uname is not set, go to home
if (!isset($_SESSION['uname'])) {
    header('Location:' . BASE . 'index');
}
//include header
include 'header.tpl.php';

?>
<!-- main -->
<main>
    <div class="container">
        <!--Select Post-->
        <h1><?php echo $title; ?></h1>
        <hr>
        <br>

        <form action="<?= BASE ?>posts/selectAllPosts" method="POST">
            Show all posts: <input type="submit" name="showall" value="Show all posts">
        </form>
        <?php
        if (isset($_POST["showall"])) {
            if (isset($data)) {
                if (count($data) > 0) {
        ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Title</th>
                                <th>Cont</th>
                                <th>User</th>
                                <th>Create Date</th>
                                <th>Modify Date</th>
                                <th>Tags</th>
                                <th>Comment</th>
                                <th>View all comments</th>
                            </tr>

                        </thead>
                        <?php

                        $z = 0;
                        foreach ($data as $valor) {
                            echo "<tr>";
                            foreach ($valor as $key => $value) {
                                
                                if ($key == "id") {
                                    $idP = $value;
                                    $value = "";
                                }
                                if ($key == "user") {
                                    $userId = $value;
                                }
                                echo "<td>" . $value . "</td>";
                                if($key == "modify-date"){
                                    echo"<td>";
                                        echo $tags[$z][0]['tag'];
                                    echo"</td>";
                                }
                            }
                            $z++;
     
                            
                            echo "<td><form method='POST'><input type='submit' name='comment' value='comment'></td>";
                            echo "<input type='hidden' name='userId' value='$userId'><input type='hidden' name='idP' value='$idP'></form>";
                            
                            echo "<td>"

                        ?>
                            <form action="<?= BASE ?>posts/selectComments" method="POST"><input type='submit' name='viewComments' value='view comments'>
                        <?php
                            echo "<input type='hidden' name='idP' value='$idP'></form>";
                            echo "</td>";
                           
                            echo "</tr>";
                        }
                    } else {
                        echo "There are not posts available yet";
                    }

                        ?>
                    </table>
                <?php
            }
        }
        if (isset($_POST['comment'])) {
            $userId = $_POST['userId'];
            $idP = $_POST['idP'];

                ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Comment</th>
                            <th>Ready</th>
                        </tr>
                    </thead>

                    <form action="<?= BASE ?>posts/insertComment" method="POST">
                        <?php
                        echo "<input type='hidden' name='userId' value='$userId'><input type='hidden' name='idP' value='$idP'>"
                        ?>
                        <td><input type='text' name='newComment'></td>
                        <td><input type='submit' value='Ready'></td>
                    </form>
                </table>
                <?php
            }
            if (isset($_POST['viewComments'])) {
                if (isset($data)) {
                    if (count($data) > 0) {
                ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Comment</th>
                                    <th>UserId</th>
                                    <th></th>
                                </tr>
                            </thead>

                        <?php
                        foreach ($data as $valor) {
                            echo "<tr>";
                            foreach ($valor as $key => $value) {
                                if ($key == "id") {
                                    $idP = $value;
                                    $value = "";
                                }
                                if ($key == "post") {
                                    $post = $value;
                                    $value = "";
                                }
                                echo "<td>" . $value . "</td>";
                            }
                            echo "</tr>";
                        }
                    } else {
                        echo "That post don't have comments";
                    }
                        ?>

                        </table>
                <?php
                }
            }
                ?>
    </div>
</main>
<!-- end main -->