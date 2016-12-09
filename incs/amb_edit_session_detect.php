<?php

$Access = false;
$logedIn = FALSE;


if (!isset($_SESSION)) {
    session_start();
}
$allowEdit=FALSE;

if (isset($_GET["editorID"]) && $_GET["editorID"] != "") {
    $rootpath = $_SERVER['DOCUMENT_ROOT'];
    include_once($rootpath . '/incs/conn.php');
    $sql = "SELECT UsrPriv FROM Users WHERE UsrID = :usrid";
    $param = array(":usrid" => $_GET["editorID"]);
    $dbconn = database::getInstance();
    $dbconn->doQueryParam($sql, $param);
    $UsrInfo = $dbconn->loadObjectList();
    $UsrPriv = $UsrInfo["0"]["UsrPriv"];

    if (isset($UsrPriv) &&  $UsrPriv == 100) {
        $logedIn = TRUE;
        $allowEdit=TRUE;
    } else {
        $_SESSION["er"] = "exp";
        header("Location: /login.php");
        exit;
    }
} else {
    if (!(isset($_SESSION["login"]) && $_SESSION["login"])) {
        $_SESSION["er"] = "exp";
        header("Location: /login.php");
        exit;
    } else {
        $UsrPriv = $_SESSION["UsrPriv"];
        $logedIn = TRUE;
    }
}
?>
