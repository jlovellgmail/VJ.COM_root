<?php

session_start();
if (isset($_SESSION["cartReferrer"]))
{
	$tmpRef = $_SESSION["cartReferrer"];
	echo $tmpRef; 
	unset($_SESSION["cartReferrer"]);
}

