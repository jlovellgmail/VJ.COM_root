<?php

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/core/table.class.php';

class AmbassadorNewsRelation extends table {

    protected $ID;
    protected $NID;
    protected $AID;
    protected $DelFlag;
    protected $table = "AmbassadorNewsRelation";
    protected $IDName = "ID";

}

?>