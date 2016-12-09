<?php

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/core/table.class.php';

class Size extends table {

    protected $SID;
    protected $Size;
    protected $DelFlag;
    protected $table = "Size";
    protected $IDName = "SID";

    public function __construct() {
        
    }
}

?>