<?php

session_start();
$_SESSION["cartReferrer"]=$_SERVER["HTTP_REFERER"];
//echo $_SERVER["HTTP_REFERER"];