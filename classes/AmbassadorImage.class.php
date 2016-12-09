<?php

/**
 * Ambassador Image  class
 * 
 */
class AmbassadorImage extends table {

    /**
     * @var int $ImgID -> Image ID
     */
    protected $ImgID;

    /**
     * @var int $AID -> Ambassador ID
     */
    protected $AID;

    /**
     * @var string $ImgUrl -> Image path
     */
    protected $ImgUrl;

    /**
     * @var bool $DelFlag
     */
    protected $DelFlag;
	protected $OrderNo;
    protected $table = "AmbassadorImage";
    protected $IDName = "ImgID";

    /**
     * 
     */
    public function __construct() {
        
    }

    public function getImageUrl() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include_once($rootpath . '/classes/Image.class.php');

        $Img = new Image($this->ImgUrl);

        return $Img->getImageUrl();
    }
}

?>