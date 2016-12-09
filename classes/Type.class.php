<?php

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/core/table.class.php';

class Type extends table {

    protected $TID;
    protected $SID;
    protected $TypeName;
    protected $DelFlag;
    protected $table = "Types";
    protected $IDName = "TID";

    public function __construct() {
        
    }
}

?>