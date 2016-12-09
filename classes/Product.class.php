<?php

/**
 * Product class.
 * 
 */
$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/core/table.class.php';

class Product extends table {

    /**
     * @var int $CID -> Product ID
     */
    protected $PID;

    /**
     * @var int $LID -> Line ID
     */
    protected $LID;

    /**
     * @var int $CID -> Collection ID
     */
    protected $CID;

    /**
     * @var int $SID -> Style ID
     */
    protected $SID;

    /**
     * @var float $Price -> Product Price
     */
    protected $Price;

    /**
     * @var string $ShortDescription -> Product Short Description
     */
    protected $ShortDescription;

    /**
     * @var string $Description -> Product Description
     */
    protected $Description;

    /**
     * @var float $Width -> Product Width in inches
     */
    protected $Width;

    /**
     * @var float $Height -> Product Height in inches
     */
    protected $Height;

    /**
     * @var float $Depth -> Product Depth in inches
     */
    protected $Depth;

    /**
     * @var float $Weight -> Product Weight in libres
     */
    protected $Weight;

    /**
     * @var float $WidthCM -> Product Width in centimeters
     */
    protected $WidthCM;

    /**
     * @var float $HeightCM -> Product Height in centimeters
     */
    protected $HeightCM;

    /**
     * @var float $DepthCM -> Product Depth in centimeters
     */
    protected $DepthCM;

    /**
     * @var float $WeightKG -> Product Weight in kg
     */
    protected $WeightKG;

    /**
     * @var datetime $DateCreated
     */
    protected $DateCreated;

    /**
     * @var string $ImgUrl -> Main image path
     */
    protected $ImgUrl;

    /**
     * @var string $ThumbnailUrl -> Thumbnail image path
     */
    protected $ThumbnailUrl;

    /**
     * @var bool $DelFlag
     */
    protected $DelFlag;

    /**
     *
     * @var string $Gender -> Gender of product. Values are Men, Women, Both 
     */
    protected $Gender;

    /**
     *
     * @var string $Type -> Type of product. Values are Bag, accessory
     */
    protected $Type;

    /**
     * 
     * @var string PrimaryMaterial - > Primary material for the product
     */
    protected $PrimaryMaterial;

    /**
     *
     * @var bit Featured -> If the product is on featured list or not 
     */
    protected $Featured;

    /**
     *
     * @var int TID -> Type Id for the product  
     */
    protected $TID;

    /**
     *
     * @var string ProductName -> The display name for the product 
     */
    protected $ProductName;
    
    /**
     *
     * @var string OrderNo -> The order that products will display in front view
     */
    protected $OrderNo;

    /**
     *
     * @var string  AccessorySize -> text field for the size of the product
     */
    protected $AccessorySize;
    protected $Hidden;
    protected $_SCProdID;
    protected $_PTemplates;
    protected $_LineName;
    protected $_StyleName;
    protected $_CollectionName;
    protected $_ProductGallery;
    protected $_TypeName;
    protected $_Tags;
    protected $table = "Products";
    protected $IDName = "PID";

    /**
     * 
     */
    public function __construct() {
        
    }

    public function initializeByFormOnly($properties) {
        if (is_array($properties)) {
            foreach ($properties as $var => $value) {
                if (property_exists($this, $var)) {
                    $this->$var = $value;
                }
            }
        }
    }

    public function initialize($properties) {
        parent::initialize($properties);

        if (!is_array($properties)) {
            $this->PID = $properties;
        }
        if (!isset($this->PID)) {
            $this->PID = $this->id;
        }

        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';
        include_once($rootpath . '/classes/ProductGallery.class.php');
        include_once($rootpath . '/classes/PTemplates.class.php');
        include_once($rootpath . '/classes/AmbassadorTag.class.php');

        $this->_ProductGallery = new ProductGallery($this->PID);

        if (!isset($this->_Tags)) {
            $this->_Tags = new ArrayObject();
        }

        if (!isset($this->_PTemplates)) {
            $this->_PTemplates = new ArrayObject();
        }

        $query = "{call F_GetPTemplates (@PID=:PID)}";
        $param = array(":PID" => $this->PID);
        $dbo->doQueryParam($query, $param);
        $list = $dbo->loadObjectList();

        if (is_array($list)) {
            foreach ($list as $row) {
                $template = new PTemplates();
                $template->initialize($row);
                $this->_PTemplates->append($template);
            }
        }

        $query = "{call F_GetProductTags (@PID=:PID)}";
        $param = array(":PID" => $this->PID);
        $dbo->doQueryParam($query, $param);
        $list = $dbo->loadObjectList();

        if (is_array($list)) {
            foreach ($list as $row) {
                $tag = new AmbassadorTag();
                $tag->initialize($row);
                $this->_Tags->append($tag);
            }
        }

        $query = "{call F_GetProductLnameSnameCname (@LID=:LID, @SID=:SID, @CID=:CID)}";
        $param = array(":LID" => $this->LID, ":SID" => $this->SID, ":CID" => $this->CID);
        $dbo->doQueryParam($query, $param);
        $list = $dbo->loadObjectList();

        if (is_array($list)) {
            $this->_StyleName = $list[0]["StyleName"];
            $this->_LineName = $list[0]["LineName"];
            $this->_CollectionName = $list[0]["CollectionName"];
        }

        $query = "{call F_GetTypeName (@TID=:TID)}";
        $param = array(":TID" => $this->TID);
        $dbo->doQueryParam($query, $param);
        $list = $dbo->loadObjectList();

        if (is_array($list)) {
            $this->_TypeName = $list[0]["TypeName"];
        }
    }

    public function getLineName() {
        return $this->_LineName;
    }

    public function getStyleName() {
        return $this->_StyleName;
    }

    public function getCollectionName() {
        return $this->_CollectionName;
    }

    public function getTemplates() {
        return $this->_PTemplates;
    }

    public function getProductGallery() {
        return $this->_ProductGallery->getGallery();
    }

    public function getGender() {
        return $this->Gender;
    }

    public function getType() {
        return $this->Type;
    }

    public function getTags() {
        return $this->_Tags;
    }

    public function getSize() {
        $tmpStr = "";
        if ($this->Height > 0 || $this->Width > 0) {
            $tmpStr = number_format((float) $this->Height, 1, '.', '') . " in&nbsp&nbsp/&nbsp&nbsp" . number_format((float) $this->Width, 1, '.', '') . " in&nbsp&nbsp";
        }
        if (isset($this->Depth) && $this->Depth > 0) {
            $tmpStr.="/&nbsp&nbsp" . number_format((float) $this->Depth, 1, '.', '') . " in";
        }
        return $tmpStr;
        //return $this->Height . "in x " . $this->Width . "in x " . $this->Depth . "in";
    }

    public function getSizeCM() {
        $tmpStr = "";
        if ($this->HeightCM > 0 || $this->WidthCM > 0) {
            $tmpStr = number_format((float) $this->HeightCM, 0, '.', '') . " cm&nbsp&nbsp/&nbsp&nbsp" . number_format((float) $this->WidthCM, 0, '.', '') . " cm&nbsp&nbsp";
        }
        if ($this->DepthCM > 0) {
            $tmpStr.="/&nbsp&nbsp" . number_format((float) $this->DepthCM, 0, '.', '') . " cm";
        }
        return $tmpStr;
        //return $this->HeightCM . "cm x " . $this->WidthCM . "cm x " . $this->DepthCM . "cm";
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

    public function getTypeName() {
        return $this->_TypeName;
    }

    public function getProductName() {
        return $this->getStyleName();
    }

    public function getName() {
        if ($this->ProductName != "") {
            return $this->ProductName;
        } else {
            if ($this->Type == "Bag") {
                return $this->getCollectionName() . " " . $this->getStyleName();
            } else if ($this->Type == "Accessory") {
                return $this->getTypeName() . " " . $this->getStyleName();
            }
        }
    }

    public function getPID() {
        return $this->PID;
    }

    public function getId() {
        return $this->_SCProdID;
    }

    public function setSCProdID($scProdID) {
        $this->_SCProdID = $scProdID;
    }

    public function getWeight() {

        $tmpStr = "";
        if ($this->Weight > 0 && $this->WeightKG > 0) {
            $tmpStr = number_format((float) $this->Weight, 1, '.', '') . " lbs&nbsp;&nbsp;&#124;&nbsp;&nbsp;" . number_format((float) $this->WeightKG, 2, '.', '') . " kg";
        } else if ($this->WeightKG > 0) {
            $tmpStr = number_format((float) $this->WeightKG, 2, '.', '') . " kg";
        } else if ($this->Weight > 0) {
            $tmpStr = number_format((float) $this->Weight, 1, '.', '');
        }
        return $tmpStr;
    }

}

?>