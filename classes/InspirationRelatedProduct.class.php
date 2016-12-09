<?php

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/core/table.class.php';

class InspirationRelatedProduct extends table {

	 protected $IRPID;
    protected $PID;
    protected $IID;
    
    protected $table = "InspirationRelatedProducts";
    protected $IDName = "IRPID";
    
    public function initialize($properties) {
        parent::initialize($properties);

        if (!is_array($properties)) {
            $this->IRPID = $properties;
        }
    }
}
?>