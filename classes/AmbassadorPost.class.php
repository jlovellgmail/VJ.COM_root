<?php

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/core/table.class.php';

class AmbassadorPost extends table {

    protected $PID;
    protected $Title;
    protected $SubTitle;
    protected $PostContent;
    protected $AID;
    protected $ImgUrl;
    protected $HeroImgUrl;
    protected $PostDate;
    protected $DelFlag;
    protected $Publish;
    protected $Type;
    protected $table = "AmbassadorPost";
    protected $IDName = "PID";

    public function getImgUrl() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include_once($rootpath . '/classes/Image.class.php');

        $Img = new Image($this->ImgUrl);

        return $Img->getImageUrl();
    }

    public function getHeroImgUrl() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include_once($rootpath . '/classes/Image.class.php');

        $Img = new Image($this->HeroImgUrl);

        return $Img->getImageUrl();
    }

}

?>