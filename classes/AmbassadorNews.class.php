<?php

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/core/table.class.php';

class AmbassadorNews extends table {

    protected $NID;
    protected $Name;
    protected $Subtitle;
    protected $AID;
    protected $Description;
    protected $ImgUrl;
    protected $DateCreated;
    protected $DelFlag;
    protected $table = "AmbassadorNews";
    protected $IDName = "NID";

    public function getImgUrl() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include_once($rootpath . '/classes/Image.class.php');

        $Img = new Image($this->ImgUrl);

        return $Img->getImageUrl();
    }

}

?>