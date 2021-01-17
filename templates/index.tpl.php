<?php

include 'header.tpl.php';

if (isset($_SESSION['uname'])) {
} else {
    //si tengo la coockie de remember iniciar session
    if (isset($_COOKIE['rememberUser']) && isset($_COOKIE['rememberPassword'])) {
        $_SESSION['uname'] = $_COOKIE['rememberUser'];
        header('Location:' . BASE . 'dashboard');
    }
}
?>

<main>
    <div class="container">
        <h2>¡Bienvenido a website!</h2>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eligendi quia exercitationem inventore sapiente saepe voluptate odit fugit quos reiciendis ad! Veniam, impedit provident accusantium natus officiis exercitationem alias voluptas molestias.
            Mollitia, iusto. Itaque deleniti ad repellendus praesentium ipsam illo, numquam excepturi ab mollitia culpa eius molestiae et laborum sed eligendi ullam saepe, tenetur sunt aliquid alias sint veniam iure! Suscipit.
            Repudiandae maiores consequuntur sint itaque odio vitae illum fuga non culpa ut, numquam beatae modi reiciendis aut tempora delectus dolorem accusamus error obcaecati dolore commodi possimus voluptate eum! Corporis, aliquam.
            At, omnis illum culpa numquam laudantium excepturi ad architecto eum dolorem vel itaque nemo voluptas possimus soluta minus aspernatur consequatur repellat sit fugit laboriosam. Tempora debitis ab exercitationem eligendi eveniet.
            Ullam, distinctio omnis! Consequuntur nostrum nobis harum velit dolor! Maiores illo consequuntur quasi quis voluptas autem dignissimos quo in totam doloribus, eveniet accusantium sequi aperiam soluta magni temporibus ullam! Eligendi.</p>
    </div>
</main>

<?php
include 'footer.tpl.php';
?>