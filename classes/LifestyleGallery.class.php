<?php

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/core/table.class.php';

class LifestyleGallery extends table {

    protected $LGID;
    protected $Title;
    protected $Description;
    protected $ImgUrl;
    protected $DelFlag;
    protected $OrderNo;
    protected $_RelatedProductList;
    protected $table = "LifestyleGallery";
    protected $IDName = "LGID";
    
    public function initialize($properties) {
        parent::initialize($properties);

        if (!is_array($properties)) {
            $this->LGID = $properties;
        }
    }
    
    public function getImgUrl() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include_once($rootpath . '/classes/Image.class.php');

        $Img = new Image($this->ImgUrl);

        return $Img->getImageUrl();
    }
    
    public function getRelatedProducts()
    {
    		if (!isset($this->ProductList)) {
            	$this->_RelatedProductList = new ArrayObject();
        	} else {
            	$this->_RelatedProductList->exchangeArray(array());
        	}
        	
    		$rootpath = $_SERVER['DOCUMENT_ROOT'];
			include $rootpath . '/incs/conn.php';
			include_once($rootpath . '/classes/Product.class.php');

			$query = "{call F_GetGalleryRelatedProducts (@LGID=:LGID)}";
			$param = array(":LGID" => $this->LGID);
			$dbo->doQueryParam($query, $param);
			$list = $dbo->loadObjectList();
			
			if (is_array($list)) {
            foreach ($list as $row) {
                $product = new Product();
                $product->initialize($row['PID']);
                $product->setVar("PID", $row['PID']);
                $this->_RelatedProductList->append($product);
            }
        }
        
			return $this->_RelatedProductList;
    }
    
    public function getLiveRelatedProducts()
    {
    		if (!isset($this->ProductList)) {
            	$this->_RelatedProductList = new ArrayObject();
        	} else {
            	$this->_RelatedProductList->exchangeArray(array());
        	}
        	
    		$rootpath = $_SERVER['DOCUMENT_ROOT'];
			include $rootpath . '/incs/conn.php';
			include_once($rootpath . '/classes/Product.class.php');

			$query = "{call F_GetGalleryRelatedProducts (@LGID=:LGID)}";
			$param = array(":LGID" => $this->LGID);
			$dbo->doQueryParam($query, $param);
			$list = $dbo->loadObjectList();
			
			if (is_array($list)) {
            foreach ($list as $row) {
                $product = new Product();
                $product->initialize($row['PID']);
                $product->setVar("PID", $row['PID']);
                if ($product->getVar("DelFlag") == '0' && $product->getVar("Hidden") == '0')
                {
                	$this->_RelatedProductList->append($product);
                }
            }
        }
        
			return $this->_RelatedProductList;
    }
}
?>