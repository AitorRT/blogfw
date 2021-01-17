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

        <form action="<?= BASE ?>dashboard/selectPosts" method="POST">
            Show posts: <input type="submit" name="show" value="Show my posts">
        </form>
        <?php
        if (isset($_POST["show"])) {
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
                                <th>Delete</th>
                                <th>Modify</th>
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
                                echo "<td>" . $value . "</td>";
                                if($key == "modify-date"){
                                    echo"<td>";
                                        echo $tags[$z][0]['tag'];
                                    echo"</td>";
                                }
                            }
                            $z++;
                            echo "<td><form action='" . BASE . "dashboard/deletePost' method='POST'><input type='submit' value='x'> <input type='hidden' name='idP' value='$idP'></form></td>";
                            echo "<td><form method='POST'><input type='submit' name='modify' value='m'><input type='hidden' name='idP' value='$idP'></form></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo"Your user don't have posts";
                    }

                    ?>
                    
                    </table>
                <?php
            }
        }
        if (isset($_POST['modify'])) {
                ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Cont</th>
                            <th>Ready</th>
                        </tr>
                    </thead>
                    <tr>
                        <form action="<?= BASE ?>dashboard/modifyPost" method="POST">
                            <?php
                            foreach ($data as $valor) {
                                echo "<tr>";
                                foreach ($valor as $key => $value) {
                                    if ($key == "id") {
                                        $idP = $value;
                                    }
                                    if ($_POST['idP'] == $idP) {
                                        echo "<input type='hidden' name='changedidP' value=$idP>";
                                        if ($key == "cont") {
                                            echo "<td><input type='text' name='changedCont' value=$value></td>";
                                            echo "<td><input type='submit' value='Ready'></td>";
                                        }else if($key == "title"){
                                            echo "<td><input type='text' name='changedTitle' value=$value></td>";
                                        }
                                    }
                                }
                                echo "</tr>";
                            }
                        }
                            ?>

                        </form>
                    </tr>
                </table>
            <?php
        echo "<br><br><form method='POST'>Add new post: <input type='submit' name='insertP' value='Add'></form>";
        if (isset($_POST['insertP'])) {
            ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Cont</th>

                            <th>Tag</th>
                        </tr>
                    </thead>
                    <tr>
                        <form action="<?= BASE ?>dashboard/insertPost" method="POST">
                            <td><input required type="text" name="title"></td>
                            <td><input required type="text" name="cont"></td>
                            <td>
                            <select name="tagname" id="tagname">
                                <option value="generic">Generic</option>
                                <option value="videogames">Videogames</option>
                                <option value="animals">Animals</option>
                                <option value="plants">Plants</option>
                                <option value="sports">Sports</option>
                            </select>    
                            </td>
                            <td><input type="submit" value="ready"></td>
                        </form>
                    </tr>
                </table>
            <?php
        }
            ?>
    </div>
</main>
<!-- end main -->
