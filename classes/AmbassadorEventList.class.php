<?php

class AmbassadorEventList {

    protected $AmbassadorEventList;

    public function __construct($AID) {
        if (!isset($this->AmbassadorEventList)) {
            $this->AmbassadorEventList = new ArrayObject();
        }

        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';
        include_once($rootpath . '/classes/AmbassadorEvent.class.php');

        $query = "{call F_GetAmbassadorEvents (@AID=:AID)}";
        $param = array(":AID" => $AID);
        $dbo->doQueryParam($query, $param);
        $list = $dbo->loadObjectList();

        if (is_array($list)) {
            foreach ($list as $row) {
                $AmbassadorEvent = new AmbassadorEvent();
                $AmbassadorEvent->initialize($row);
                $AmbassadorEvent->setVar("EID", $row['EID']);
                $this->AmbassadorEventList->append($AmbassadorEvent);
            }
        }
    }

    public function getAmbassadorEvents() {
        return $this->AmbassadorEventList;
    }

}

?>