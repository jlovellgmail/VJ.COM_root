<?php

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/core/table.class.php';

class GalleryRelatedProduct extends table {

	 protected $GRPID;
    protected $PID;
    protected $LGID;
    
    protected $table = "GalleryRelatedProducts";
    protected $IDName = "GRPID";
    
    public function initialize($properties) {
        parent::initialize($properties);

        if (!is_array($properties)) {
            $this->GRPID = $properties;
        }
    }
}
?>