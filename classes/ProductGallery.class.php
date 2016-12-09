<?php

class ProductGallery {

    protected $ProductImageList;
    protected $PID;

    public function __construct($PID) {
        $this->ProductImageList = new ArrayObject();
        $this->PID = $PID;

        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';
        include_once($rootpath . '/classes/ProductImage.class.php');

        $query = "{call F_GetProductGallery (@PID=:PID)}";
        $param = array(":PID" => $this->PID);
        $dbo->doQueryParam($query, $param);
        $list = $dbo->loadObjectList();

        if (is_array($list)) {
            foreach ($list as $row) {
                $ProductImage = new ProductImage();
                $ProductImage->initialize($row);
                $this->ProductImageList->append($ProductImage);
            }
        }
    }

    public function getGallery() {
        return $this->ProductImageList;
    }

}

?>