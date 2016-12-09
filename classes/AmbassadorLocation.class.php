<?php
$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/core/table.class.php';

class AmbassadorLocation extends table {
	protected $LocID;
	protected $Location;
	protected $DelFlag;
	protected $DateCreated;
	
	protected $table = "AmbassadorLocations";
    protected $IDName = "LocID";
}
?>