<?php

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/core/table.class.php';

class PostBlock extends table {

	 protected $PBID;
    protected $PID;
    protected $BlockContent;
    protected $Title;
    protected $Caption;
    protected $Credit;
    protected $MediaType;
    protected $ImgUrl;
    protected $VideoUrl;
    protected $OrderNo;
    protected $DateCreated;
    protected $DelFlag;
    protected $_SlideshowArr;
    protected $table = "PostBlocks";
    protected $IDName = "PBID";

    public function initialize($properties) {
        parent::initialize($properties);

        if (!is_array($properties)) {
            $this->PBID = $properties;
        }
    }
    
    public function getImgUrl() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include_once($rootpath . '/classes/Image.class.php');

        $Img = new Image($this->ImgUrl);

        return $Img->getImageUrl();
    }
    
    public function initializeSlideshow()
    {
    	  $this->_SlideshowArr = new ArrayObject();
    	  $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';
        include_once($rootpath . '/classes/PostSlideshow.class.php');

        $query = "{call F_GetBlockSlideshowByPBID (@PBID=:PBID)}";
		  $param = array(":PBID" => $this->PBID);
        $dbo->doQueryParam($query, $param);
        $list = $dbo->loadObjectList();
		
        if (is_array($list)) {
            foreach ($list as $row) {
                $PostSlideshow = new PostSlideshow();
                $PostSlideshow->initialize($row);
                $PostSlideshow->setVar("PSID", $row['PSID']);
                $this->_SlideshowArr->append($PostSlideshow);
            }
        }
    }

    public function getSlideshow()
    {
    		return $this->_SlideshowArr;
    }
    
    public function getSlideshowCount()
    {
    		return count($this->_SlideshowArr);
    }
}

?>