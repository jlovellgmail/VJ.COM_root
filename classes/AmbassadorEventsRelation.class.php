<?php

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/core/table.class.php';

class AmbassadorEventsRelation extends table {

    protected $ID;
    protected $EID;
    protected $AID;
    protected $DelFlag;
    protected $table = "AmbassadorEventsRelation";
    protected $IDName = "ID";

}

?>