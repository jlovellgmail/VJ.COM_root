<?php

/**
 * Collection class
 * 
 */
$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/core/table.class.php';

class Collection extends table {

    /**
     * @var int $CID -> Collection ID
     */
    protected $CID;

    /**
     * @var char $LID -> Line ID
     */
    protected $LID;

    /**
     * @var int $Name -> Collection Name
     */
    protected $Name;

    /**
     * @var int $Url -> Collection Landing page
     */
    protected $Url;

    /**
     * @var datetime $DateAdded
     */
    protected $DateAdded;

    /**
     * @var bool $DelFlag
     */
    protected $DelFlag;
    protected $table = "Collections";
    protected $IDName = "CID";
    protected $_Line;
    protected $_CTemplates;
    protected $_Products;
    protected $_ProductsFromTags;
    protected $_Buttons = array("Men", "Women", "Accessory");

    /**
     * 
     */
    public function __construct() {
        
    }

    public function getLine() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include_once($rootpath . '/classes/Line.class.php');

        $this->_Line = new Line();
        $this->_Line->initialize($this->LID);

        return $this->_Line;
    }

    public function getLineName() {
        if (!isset($this->_Line)) {
            $this->getLine();
        }

        return $this->_Line->getVar("Name");
    }

    public function getTemplates() {
        if (!isset($this->_CTemplates)) {
            $this->_CTemplates = new ArrayObject();
        }
        if (!isset($this->CID)) {
            $this->CID = $this->id;
        }

        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';
        include_once($rootpath . '/classes/CTemplates.class.php');

        $query = "{call F_GetCTemplates (@CID=:CID)}";
        $param = array(":CID" => $this->CID);
        $dbo->doQueryParam($query, $param);
        $list = $dbo->loadObjectList();

        if (isset($list) && $list != "") {
            foreach ($list as $row) {
                $template = new CTemplates();
                $template->initialize($row);
                $this->_CTemplates->append($template);
            }
        }
        return $this->_CTemplates;
    }

    public function getProductsFromTags() {
        if (!isset($this->_ProductsFromTags)) {
            $this->_ProductsFromTags = new ArrayObject();
        }
        if (!isset($this->CID)) {
            $this->CID = $this->id;
        }

        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';
        include_once($rootpath . '/classes/Product.class.php');

        $query = "{call F_GetProductsByTag (@CID=:CID)}";
        $param = array(":CID" => $this->CID);
        $dbo->doQueryParam($query, $param);
        $list = $dbo->loadObjectList();

        if (is_array($list)) {
            foreach ($list as $row) {
                $product = new Product();
                $product->initialize($row);
                $product->setVar("PID", $row['PID']);
                $this->_ProductsFromTags->append($product);
            }
        }

        return $this->_ProductsFromTags;
    }

    public function getProducts() {
        if (!isset($this->_Products)) {
            $this->_Products = new ArrayObject();
        }
        if (!isset($this->CID)) {
            $this->CID = $this->id;
        }

        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';
        include_once($rootpath . '/classes/Product.class.php');

        $query = "{call F_GetCollectionProducts (@CID=:CID)}";
        $param = array(":CID" => $this->CID);
        $dbo->doQueryParam($query, $param);
        $list = $dbo->loadObjectList();

        if (is_array($list)) {
            foreach ($list as $row) {
                $product = new Product();
                $product->initialize($row);
                $product->setVar("PID", $row['PID']);
                $this->_Products->append($product);
            }
        }

        return $this->_Products;
    }

    public function getMenProducts() {
        if (!isset($this->_Products)) {
            $this->getProducts();
        }

        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include_once($rootpath . '/classes/Product.class.php');

        $tempArr = new ArrayObject();
        foreach ($this->_Products as $product) {
            if ($product->getGender() == "Men" || $product->getGender() == "Both") {
                $tempArr->append($product);
            }
        }

        return $tempArr;
    }

    public function getWomenProducts() {
        if (!isset($this->_Products)) {
            $this->getProducts();
        }

        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include_once($rootpath . '/classes/Product.class.php');

        $tempArr = new ArrayObject();
        foreach ($this->_Products as $product) {
            if (rtrim(ltrim($product->getVar("Gender"))) == "Women" || $product->getVar("Gender") == "Both") {
                $tempArr->append($product);
            }
        }

        return $tempArr;
    }

    public function getUnisexProducts() {
        if (!isset($this->_Products)) {
            $this->getProducts();
        }

        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include_once($rootpath . '/classes/Product.class.php');

        $tempArr = new ArrayObject();
        foreach ($this->_Products as $product) {
            if ($product->getVar("Gender") == "Both") {
                $tempArr->append($product);
            }
        }

        return $tempArr;
    }

    public function getAccessoryProducts() {
        if (!isset($this->_Products)) {
            $this->getProducts();
        }

        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include_once($rootpath . '/classes/Product.class.php');

        $tempArr = new ArrayObject();
        foreach ($this->_Products as $product) {
            if ($product->getVar("Type") == "Accessory") {
                $tempArr->append($product);
            }
        }

        return $tempArr;
    }

    public function getButtons() {
        if (!isset($this->_Products)) {
            $this->getProducts();
        }
        $tempArr = array();

        foreach ($this->_Products as $product) {
            foreach ($this->_Buttons as $button) {
                if ($product->getVar("Type") == $button || $product->getVar("Gender") == $button) {
                    if (array_search($button, $tempArr) === False) {
                        $tempArr[] = $button;
                    }
                } else if ($product->getVar("Gender") == "Both") {
                    if (array_search("Men", $tempArr) === False) {
                        $tempArr[] = "Men";
                    }
                    if (array_search("Women", $tempArr) === False) {
                        $tempArr[] = "Women";
                    }
                }
            }
        }

        return $tempArr;
    }

    public function initializeByName($CollName) {
        if ($CollName == "k-johnson") {
            $CollName = "Kenneth Johnson";
        }
        if ($CollName == "santa-fe") {
            $CollName = "Santa Fe";
        }
        if ($CollName == "buenos-aires") {
            $CollName = "Buenos Aires";
        }
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';
        $query = "{call S_GetCollIdByName (@name=:CollName)}";
        $param = array(":CollName" => $CollName);
        $dbo->doQueryParam($query, $param);
        $namesList = $dbo->loadObjectList();
        if ($dbo->getRows() > 1) {
            print_r("More than one Collection with same name");
            // exit();
        }
        if ($dbo->getRows() == 0) {
            print_r("There is no collection with this name");
            // exit();
        }
        $this->CID = $namesList[0]["CID"];
        parent::initialize($namesList[0]["CID"]);
    }

}

?>