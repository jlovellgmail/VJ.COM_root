<?php

class AmbassadorSlideshow {

    protected $AmbassadorImageList;
    protected $AID;

    public function __construct($AID) {
        $this->AmbassadorImageList = new ArrayObject();
        $this->AID = $AID;

        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';
        include_once($rootpath . '/classes/AmbassadorImage.class.php');

        $query = "{call F_GetAmbassadorSlideshow (@AID=:AID)}";
        $param = array(":AID" => $this->AID);
        $dbo->doQueryParam($query, $param);
        $list = $dbo->loadObjectList();

        if (is_array($list)) {
            foreach ($list as $row) {
                $AmbassadorImage = new AmbassadorImage();
                $AmbassadorImage->initialize($row);
                $this->AmbassadorImageList->append($AmbassadorImage);
            }
        }
    }

    public function getSlideshow() {
        return $this->AmbassadorImageList;
    }

}

?>