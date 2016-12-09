<?php

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include_once $rootpath . '/core/User.class.php';

//$rootpath = $_SERVER['DOCUMENT_ROOT'];
//include '/core/User.class.php';
include_once($rootpath . '/incs/conn.php');

class Reg_User extends User {

    var $ReSetPassToken;
    var $ReSetPassDate;
    var $DateRegistered;
    var $EmailToken;
    var $EmailConf;
    var $DelFlag;
    var $UsrPriv;

    public function __construct() {
        
    }

    public function initialize($UID) {
        parent::initialize($UID);
    }

    public function getFName() {
        return $this->FName;
    }

    public function getLName() {
        return $this->LName;
    }

}

?>