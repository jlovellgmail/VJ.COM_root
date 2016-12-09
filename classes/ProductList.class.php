<?php

//ini_set('display_errors', 1);
//error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

class ProductList {

    protected $ProductList;

    public function __construct() {
        
    }

    public function getAllProducts() {
        if (!isset($this->ProductList)) {
            $this->ProductList = new ArrayObject();
        } else {
            $this->ProductList->exchangeArray(array());
        }

        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';
        include_once($rootpath . '/classes/Product.class.php');

        $query = "{call F_GetProducts}";
        $dbo->doQuery($query);
        $list = $dbo->loadObjectList();

        if (is_array($list)) {
            foreach ($list as $row) {
                $product = new Product();
                $product->initialize($row);
                $product->setVar("PID", $row['PID']);
                $this->ProductList->append($product);
            }
        }

        return $this->ProductList;
    }

    public function getAllProductsAdmin() {
        if (!isset($this->ProductList)) {
            $this->ProductList = new ArrayObject();
        } else {
            $this->ProductList->exchangeArray(array());
        }

        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';
        include_once($rootpath . '/classes/Product.class.php');

        $query = "{call S_GetAllProductsAdmin}";
        $dbo->doQuery($query);
        $list = $dbo->loadObjectList();

        if (is_array($list)) {
            foreach ($list as $row) {
                $product = new Product();
                $product->initialize($row);
                $product->setVar("PID", $row['PID']);
                $this->ProductList->append($product);
            }
        }

        return $this->ProductList;
    }

    public function getAllRelatedProducts($PID) {
        if (!isset($this->ProductList)) {
            $this->ProductList = new ArrayObject();
        } else {
            $this->ProductList->exchangeArray(array());
        }

        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';
        include_once($rootpath . '/classes/Product.class.php');

        $query = "{call S_RelatedProducts (@PID = :pid)}";
        $param = array(":pid" => $PID);
        $dbo->doQueryParam($query, $param);
        $list = $dbo->loadObjectList();

        if (is_array($list)) {
            foreach ($list as $row) {
                $product = new Product();
                $product->initialize($row['ProdRelID']);
                $product->setVar("PID", $row['ProdRelID']);
               // print_r($product->getVar("Hidden"));
                if ($product->getVar("Hidden")==0){
                    $this->ProductList->append($product);
                }
            }
        }

        return $this->ProductList;
    }

    public function getMensProducts() {
        if (!isset($this->ProductList)) {
            $this->ProductList = new ArrayObject();
        } else {
            $this->ProductList->exchangeArray(array());
        }

        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';
        include_once($rootpath . '/classes/Product.class.php');

        $query = "{call F_GetMensProducts}";
        $dbo->doQuery($query);
        $list = $dbo->loadObjectList();

        if (is_array($list)) {
            foreach ($list as $row) {
                $product = new Product();
                $product->initialize($row);
                $product->setVar("PID", $row['PID']);
                $this->ProductList->append($product);
            }
        }

        return $this->ProductList;
    }

    public function getWomensProducts() {
        if (!isset($this->ProductList)) {
            $this->ProductList = new ArrayObject();
        } else {
            $this->ProductList->exchangeArray(array());
        }

        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';
        include_once($rootpath . '/classes/Product.class.php');

        $query = "{call F_GetWomensProducts}";
        $dbo->doQuery($query);
        $list = $dbo->loadObjectList();

        if (is_array($list)) {
            foreach ($list as $row) {
                $product = new Product();
                $product->initialize($row);
                $product->setVar("PID", $row['PID']);
                $this->ProductList->append($product);
            }
        }

        return $this->ProductList;
    }

    public function getAccessoryProducts() {
        if (!isset($this->ProductList)) {
            $this->ProductList = new ArrayObject();
        } else {
            $this->ProductList->exchangeArray(array());
        }

        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';
        include_once($rootpath . '/classes/Product.class.php');

        $query = "{call F_GetAccessoryProducts}";
        $dbo->doQuery($query);
        $list = $dbo->loadObjectList();

        if (is_array($list)) {
            foreach ($list as $row) {
                $product = new Product();
                $product->initialize($row);
                $product->setVar("PID", $row['PID']);
                $this->ProductList->append($product);
            }
        }

        return $this->ProductList;
    }

    public function getFeaturedProducts() {
        if (!isset($this->ProductList)) {
            $this->ProductList = new ArrayObject();
        } else {
            $this->ProductList->exchangeArray(array());
        }

        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';
        include_once($rootpath . '/classes/Product.class.php');

        $query = "{call S_GetFeaturedProducts}";
        $dbo->doQuery($query);
        $list = $dbo->loadObjectList();

        if (is_array($list)) {
            foreach ($list as $row) {
                $product = new Product();
                $product->initialize($row);
                $product->setVar("PID", $row['PID']);
                $this->ProductList->append($product);
            }
        }

        return $this->ProductList;
    }

}

?>