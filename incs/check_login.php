<?php

$logedIn = FALSE;

if (!isset($_SESSION)) {
    session_start();
}


if ((isset($_SESSION["login"]) && $_SESSION["login"])) {
    $logedIn = TRUE;
}
?>
