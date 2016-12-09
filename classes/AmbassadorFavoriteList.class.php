<?php

class AmbassadorFavoriteList {

    protected $AmbassadorFavoriteList;

    public function __construct($AID) {
        if (!isset($this->AmbassadorFavoriteList)) {
            $this->AmbassadorFavoriteList = new ArrayObject();
        }
		
		$rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';
        include_once($rootpath . '/classes/AmbassadorFavorite.class.php');

        $query = "{call F_GetAmbassadorFavorites (@AID=:AID)}";
		$param = array(":AID" => $AID);
        $dbo->doQueryParam($query, $param);
        $list = $dbo->loadObjectList();
		
        if (is_array($list)) {
            foreach ($list as $row) {
                $AmbassadorFavorite = new AmbassadorFavorite();
                $AmbassadorFavorite->initialize($row);
                $AmbassadorFavorite->setVar("FID", $row['FID']);
                $this->AmbassadorFavoriteList->append($AmbassadorFavorite);
            }
        }
    }
	
	public function getAmbassadorFavorites($type = "All")
	{
		$FavList = new ArrayObject();
		if ($type == "All")
		{
			$FavList = $this->AmbassadorFavoriteList;
		}
		else if ($type == "P")
		{
			foreach($this->AmbassadorFavoriteList as $row)
			{
				if ($row->getVar("Type") == "P")
				{
					$FavList->append($row);
				}
			}
		}
		else if ($type == "C")
		{
			foreach($this->AmbassadorFavoriteList as $row)
			{
				if ($row->getVar("Type") == "C")
				{
					$FavList->append($row);
				}
			}
		}
		
		return $FavList;
	}
}

?>