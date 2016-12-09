<?php

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/core/table.class.php';

class Color extends table {

    protected $CID;
    protected $ColorName;
    protected $DelFlag;
    protected $table = "Colors";
    protected $IDName = "CID";

    public function __construct() {
        
    }
}

?>