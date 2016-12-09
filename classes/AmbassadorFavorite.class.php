<?php

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/core/table.class.php';

class AmbassadorFavorite extends table {

    protected $FID;
    protected $PID;
    protected $AID;
    protected $Comments;
    protected $DateCreated;
    protected $DelFlag;
	protected $ItemName;
	protected $Link;
	protected $Description;
	protected $ImgUrl;
	protected $Type;
    protected $table = "AmbassadorFavorite";
    protected $IDName = "FID";

	public function getImgUrl() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include_once($rootpath . '/classes/Image.class.php');

        $Img = new Image($this->ImgUrl);

        return $Img->getImageUrl();
    }
}

?>