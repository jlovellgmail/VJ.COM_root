<?php
$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/core/table.class.php';

class AmbassadorQuestion extends table {
	protected $QID;
	protected $Question;
	protected $Answer;
	protected $AID;
	protected $OrderNo;
	protected $DateCreated;
	protected $DelFlag;
	
	protected $table = "AmbassadorQuestion";
    protected $IDName = "QID";
	
	
}

?>