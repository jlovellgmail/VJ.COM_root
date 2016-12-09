<?php
session_start();
if (isset($_GET["sk"]) && $_GET["sk"] == "84756^!290") {
    
    if (isset($_GET["editorID"]) && $_GET["editorID"] != "") {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include_once($rootpath . '/incs/conn.php');
        $sql = "SELECT FName, LName,Email,UsrPriv,UsrID FROM Users WHERE UsrID = :usrid";
        $param = array(":usrid" => $_GET["editorID"]);
        $dbconn = database::getInstance();
        $dbconn->doQueryParam($sql, $param);
        $UsrInfo = $dbconn->loadObjectList();
        $UsrPriv = $UsrInfo["0"]["UsrPriv"];
        //print_r($UsrInfo[0]["UsrID"]);
        //exit();
        if (isset($UsrPriv) && $UsrPriv >= 90) {
			$sql = "SELECT U.FName, U.LName, U.Email, U.UsrPriv, U.UsrID FROM Users U, Ambassadors A WHERE AID = :AID and U.UsrID = A.UsrID";
	        $param = array(":AID" => $_GET["AID"]);
	        $dbconn = database::getInstance();
	        $dbconn->doQueryParam($sql, $param);
	        $UsrInfo = $dbconn->loadObjectList();
			//print_r($UsrInfo[0]["Email"]);
       		//exit();
          //  $_SESSION["login"] = true;
           // $_SESSION["Name"] = $UsrInfo[0]["FName"] . " " . $UsrInfo[0]["LName"];
            //$_SESSION["UsrID"] = $UsrInfo[0]["UsrID"];
            //$_SESSION["UsrPriv"] = $UsrInfo["0"]["UsrPriv"];
            //$_SESSION["UsrEmail"] = $UsrInfo[0]["Email"];
            $_SESSION["AmbEditID"]=$_GET["AID"];
            $_SESSION["AmbEditName"] = $UsrInfo[0]["FName"] . " " . $UsrInfo[0]["LName"];
            header("Location: /info.php");
        } else {
            $_SESSION["er"] = "exp";
            header("Location: /login.php");
            exit;
        }
    }
} else {
    $_SESSION["er"] = "exp";
    header("Location: /login.php");
    exit;
}
