<?php

class AmbassadorNewsList {

    protected $AmbassadorNewsList;

    public function __construct($AID) {
        if (!isset($this->AmbassadorNewsList)) {
            $this->AmbassadorNewsList = new ArrayObject();
        }
		
		$rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';
        include_once($rootpath . '/classes/AmbassadorNews.class.php');

        $query = "{call F_GetAmbassadorNews (@AID=:AID)}";
		$param = array(":AID" => $AID);
        $dbo->doQueryParam($query, $param);
        $list = $dbo->loadObjectList();
		
        if (is_array($list)) {
            foreach ($list as $row) {
                $AmbassadorNews = new AmbassadorNews();
                $AmbassadorNews->initialize($row);
                $AmbassadorNews->setVar("NID", $row['NID']);
                $this->AmbassadorNewsList->append($AmbassadorNews);
            }
        }
    }
	
	public function getAmbassadorNewsList()
	{
		return $this->AmbassadorNewsList;
	}
}

?>