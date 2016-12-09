<?php

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/core/table.class.php';

class AmbassadorPostRelation extends table {

    protected $ID;
    protected $PID;
    protected $AID;
    protected $DelFlag;
    protected $table = "AmbassadorPostRelation";
    protected $IDName = "ID";

}

?>