<?php

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/core/table.class.php';

/**
 * Collection Templates class
 * 
 */
class PTemplates extends table {

    /**
     * @var int $PTID -> Product Template ID
     */
    protected $PTID;

    /**
     * @var int $CTID -> Collection Template ID
     */
    protected $CTID;
    
    /**
     * @var int $PID -> Product ID
     */
    protected $PID;

    /**
     * @var string $Name -> Template Name
     */
    protected $Name;

    /**
     * @var string $Description -> Template Description
     */
    protected $Description;

    /**
     * @var string $ImgUrl -> Template ImageUrl
     */
    protected $ImgUrl;

    /**
     * @var datetime $DateCreated
     */
    protected $DateCreated;

    /**
     * @var bool $DelFlag
     */
    protected $DelFlag;
    
    /**
     * @var bool $OrderNo
     */
    protected $OrderNo;
    
    protected $table = "ProductTemplates";
    protected $IDName = "PTID";

    /**
     * 
     */
    public function __construct() {
        
    }
	
	public function getImageUrl()
	{
		$rootpath = $_SERVER['DOCUMENT_ROOT'];
        include_once($rootpath . '/classes/Image.class.php');
		
		$Img = new Image($this->ImgUrl);
		
		return $Img->getImageUrl();
	}

}

?>