<?php

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/core/table.class.php';

class Post extends table {

    protected $PID;
    protected $Title;
    protected $SubTitle;
    protected $AID;
    protected $ImgUrl;
    protected $HeroImgUrl;
    protected $PostDate;
    protected $DelFlag;
    protected $Publish;
    protected $Type;
    protected $OrderNo;
    protected $CreationDate;
    protected $_BlocksArr;
    protected $table = "Posts";
    protected $IDName = "PID";
    
    public function initialize($properties) {
        parent::initialize($properties);

        if (!is_array($properties)) {
            $this->PID = $properties;
        }
    }
    
    public function getImgUrl() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include_once($rootpath . '/classes/Image.class.php');

        $Img = new Image($this->ImgUrl);

        return $Img->getImageUrl();
    }

    public function getHeroImgUrl() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include_once($rootpath . '/classes/Image.class.php');

        $Img = new Image($this->HeroImgUrl);

        return $Img->getImageUrl();
    }
    
    public function initializeBlocks()
    {
    	  $this->_BlocksArr = new ArrayObject();
    	  $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';
        include_once($rootpath . '/classes/PostBlock.class.php');

        $query = "{call F_GetPostBlocksByPID (@PID=:PID)}";
		  $param = array(":PID" => $this->PID);
        $dbo->doQueryParam($query, $param);
        $list = $dbo->loadObjectList();
		
        if (is_array($list)) {
            foreach ($list as $row) {
                $PostBlock = new PostBlock();
                $PostBlock->initialize($row);
                $PostBlock->setVar("PBID", $row['PBID']);
                $this->_BlocksArr->append($PostBlock);
            }
        }
    }

    public function getBlocks()
    {
    		return $this->_BlocksArr;
    }
    
    public function getBlockCount()
    {
    		return count($this->_BlocksArr);
    }
}

?>