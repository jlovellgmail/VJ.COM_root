<?php

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/core/table.class.php';

class PostSlideshow extends table {

	 protected $PSID;
    protected $PBID;
    protected $ImgUrl;
    protected $Caption;
    protected $Credit;
    protected $OrderNo;
    protected $DateCreated;
    protected $DelFlag;
    protected $table = "PostSlideshow";
    protected $IDName = "PSID";

    public function getImgUrl() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include_once($rootpath . '/classes/Image.class.php');

        $Img = new Image($this->ImgUrl);

        return $Img->getImageUrl();
    }
}

?>