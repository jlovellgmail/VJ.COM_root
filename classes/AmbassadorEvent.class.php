<?php

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/core/table.class.php';

class AmbassadorEvent extends table {

    protected $EID;
    protected $Name;
    protected $Subtitle;
    protected $AID;
    protected $EventDate;
    protected $Location;
    protected $Description;
    protected $ImgUrl;
    protected $PostDate;
    protected $DelFlag;
    protected $Date;
    protected $Time;
    protected $table = "AmbassadorEvent";
    protected $IDName = "EID";

    public function getImgUrl() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include_once($rootpath . '/classes/Image.class.php');

        $Img = new Image($this->ImgUrl);

        return $Img->getImageUrl();
    }

}

?>