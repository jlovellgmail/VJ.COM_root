<?php

/**
 * Product Gallery class
 * 
 */
class ProductImage extends table {

    /**
     * @var int $ImgID -> Image ID
     */
    protected $ImgID;

    /**
     * @var int $PID -> Product ID
     */
    protected $PID;

    /**
     * @var string $ImgUrl -> Image path
     */
    protected $ImgUrl;

    /**
     * @var string $ThumbnailUrl -> Thumbnail Image path
     */
    protected $ThumbnailUrl;

    /**
     * @var int $OrderNo
     */
    protected $OrderNo;

    /**
     * @var bool $DelFlag
     */
    protected $DelFlag;
    protected $table = "ProductImage";
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

    public function getThumbnailUrl() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include_once($rootpath . '/classes/Image.class.php');

        $Img = new Image($this->ThumbnailUrl);

        return $Img->getImageUrl();
    }

}

?>