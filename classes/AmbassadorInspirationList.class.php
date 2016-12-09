<?php

class AmbassadorInspirationList {

    protected $AmbassadorInspirationList;

    public function __construct($AID) {
        if (!isset($this->AmbassadorInspirationList)) {
            $this->AmbassadorInspirationList = new ArrayObject();
        }
		
		  $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';
        include_once($rootpath . '/classes/AmbassadorInspiration.class.php');

        $query = "{call F_GetAmbassadorInspirations (@AID=:AID)}";
		  $param = array(":AID" => $AID);
        $dbo->doQueryParam($query, $param);
        $list = $dbo->loadObjectList();
		
        if (is_array($list)) {
            foreach ($list as $row) {
                $AmbassadorInspiration = new AmbassadorInspiration();
                $AmbassadorInspiration->initialize($row);
                $AmbassadorInspiration->setVar("IID", $row['IID']);
                $this->AmbassadorInspirationList->append($AmbassadorInspiration);
            }
        }
    }
	
	public function getAmbassadorInspirations()
	{
		return $this->AmbassadorInspirationList;
	}
}

?>