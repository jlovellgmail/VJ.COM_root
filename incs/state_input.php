<?php

ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . "/incs/conn.php";
include $rootpath . "/core/States.class.php";


if (isset($_GET["State"]) && $_GET["State"] != "") {
        $State = $_GET["State"];
    }
if (isset($_GET["Country"]) && $_GET["Country"] != "") {
    $Country = $_GET["Country"];
}

if ($Country == "US" || $Country == "CA") {
    $StateObj = new States();

    $StStr = "<select name='State' id='State'>";
    $StStr .=$StateObj->getStatesDropDownByCountry($State, $Country);
    $StStr .= "</select>";
    echo $StStr;
} else {
    echo "<input id='State' type='text' name='State' value='" . $State . " ' />";
}

?>