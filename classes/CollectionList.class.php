<?php
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

class CollectionList {

    protected $CollectionList;

    public function __construct($LID = 0) {
		$this->CollectionList = new  ArrayObject();
    }
	
	public static function allCollections()
	{
		$collections = new CollectionList();
		
		$rootpath = $_SERVER['DOCUMENT_ROOT'];
		include $rootpath . '/incs/conn.php';
		include_once($rootpath . '/classes/Collection.class.php');

		$query = "{call F_GetCollections}";
		$dbo->doQuery($query);
		$list = $dbo->loadObjectList();
		
		foreach($list as $row)
		{
			$collection = new Collection();
			$collection->initialize($row);
			$collection->setVar("CID", $row["CID"]);
			$collections->CollectionList->append($collection);
		}
			
		return $collections;
	}
	
	public static function collectionsByLineID($LID)
	{
		$collections = new CollectionList();
		
		$rootpath = $_SERVER['DOCUMENT_ROOT'];
		include $rootpath . '/incs/conn.php';
		include_once($rootpath . '/classes/Collection.class.php');

		$sql = "{CALL F_GetLineCollections (@LID=:LID)}";
        $param = array(":LID" => $LID);
        $dbo->doQueryParam($sql, $param);
		$list = $dbo->loadObjectList();
		if (is_array($list))
		{
			foreach($list as $row)
			{
				$collection = new Collection();
				$collection->initialize($row);
				$collection->setVar("CID", $row["CID"]);
				$collections->CollectionList->append($collection);
			}
		}
		
		return $collections;
	}
	
	public function getCollections()
	{
		return $this->CollectionList;
	}
}

?>