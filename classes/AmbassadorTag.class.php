<?php

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/core/table.class.php';

class AmbassadorTag extends table {

    protected $TID;
    protected $PID;
    protected $CID;
    protected $table = "AmbassadorTags";
    protected $IDName = "TID";


}

?>