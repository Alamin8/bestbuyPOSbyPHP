<?php
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

if (false !== strpos($url, '.php')) {
    require("./declined.php");
    die();
}
?>
