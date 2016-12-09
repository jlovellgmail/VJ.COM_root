<?php

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/core/table.class.php';

/**
 * Style class
 * 
 */
class Style extends table {

    /**
     * @var int $SID -> Style ID
     */
    protected $SID;

    /**
     * @var string $Name -> Style Name
     */
    protected $Name;

    /**
     * @var datetime $DateCreated
     */
    protected $DateCreated;

    /**
     * @var bool $DelFlag
     */
    protected $DelFlag;
    protected $table = "Styles";
    protected $IDName = "SID";

    /**
     * 
     */
    public function __construct() {
        
    }

}

?>