<?php

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/core/table.class.php';

class Ambassador extends table {

    protected $AID;
    protected $LocID;
    protected $UsrID;
    protected $ProfileIntro;
    protected $ProfileImg;
    protected $ProfilePrevImg;
    protected $ProfileHeroImg;
    protected $DelFlag;
    protected $PermLinkKey;
    protected $AlignHeroImg;
    protected $Hidden;
    protected $_User;
    protected $_Location;
    protected $_FName;
    protected $_LName;
    protected $_Email;
    protected $_DateRegistered;
    protected $_Role;
    protected $_AmbassadorSlideshow;
    protected $_AmbassadorQuestionList;
    protected $_AmbassadorPostList;
    protected $_AmbassadorEventList;
    protected $_AmbassadorNewsList;
    protected $_AmbassadorFavoriteList;
    protected $_AmbassadorInspirationList;
    protected $table = "Ambassadors";
    protected $IDName = "AID";

    public function initialize($properties) {
        parent::initialize($properties);

        if (is_numeric($properties)) {
            if (!is_array($properties)) {
                $this->AID = $properties;
            }
            if (!isset($this->AID)) {
                $this->AID = $this->id;
            }
        }

        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';
        include_once $rootpath . '/classes/Reg_User.class.php';
        include_once $rootpath . '/classes/AmbassadorLocation.class.php';

        $this->_Location = new AmbassadorLocation();
        $this->_Location->initialize($this->LocID);

        $this->_User = new Reg_User();
        $this->_User->initialize($this->UsrID);

        $this->_FName = $this->_User->getVar('FName');
        $this->_LName = $this->_User->getVar('LName');
        $this->_Email = $this->_User->getVar('Email');
        $this->_Role = $this->_User->getVar('UsrPriv');
        $this->_DateRegistered = $this->_User->getVar('DateRegistered');
    }

    public function setIDName($idNameStr) {
        $this->IDName = $idNameStr;
    }

    public function getFName() {
        return $this->_FName;
    }

    public function getLName() {
        return $this->_LName;
    }

    public function getEmail() {
        return $this->_Email;
    }

    public function getRole() {
        return $this->_Role;
    }

    public function getDateRegistered() {
        return $this->_DateRegistered;
    }

    public function getRoleTxt() {
        $RoleTxt = "";
        //if ($this->_Role == 90) {
        //    $RoleTxt = "Lead Ambassador";
        //} else if ($this->_Role == 80) {
            $RoleTxt = "Ambassador";
        //}
        return $RoleTxt;
    }

    public function getLocationTxt() {
        return $this->_Location->getVar('Location');
    }

    public function getProfileImgUrl() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include_once($rootpath . '/classes/Image.class.php');

        $Img = new Image($this->ProfileImg);

        return $Img->getImageUrl();
    }

    public function getProfilePrevImgUrl() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include_once($rootpath . '/classes/Image.class.php');

        $Img = new Image($this->ProfilePrevImg);

        return $Img->getImageUrl();
    }

    public function getProfileHeroImgUrl() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include_once($rootpath . '/classes/Image.class.php');

        $Img = new Image($this->ProfileHeroImg);

        return $Img->getImageUrl();
    }

    public function getSlideshow() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include_once($rootpath . '/classes/AmbassadorSlideshow.class.php');

        $this->_AmbassadorSlideshow = new AmbassadorSlideshow($this->AID);
        return $this->_AmbassadorSlideshow->getSlideshow();
    }

    public function getQuestions() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include_once($rootpath . '/classes/AmbassadorQuestionList.class.php');

        $this->_AmbassadorQuestionList = new AmbassadortQuestionList($this->AID);
        return $this->_AmbassadorQuestionList->getAmbassadorQuestionss();
    }

    public function getPosts() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include_once($rootpath . '/classes/AmbassadorPostList.class.php');

        $this->_AmbassadorPostList = new AmbassadorPostList($this->AID);
        return $this->_AmbassadorPostList->getAmbassadorPosts();
    }

    public function getEvents() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include_once($rootpath . '/classes/AmbassadorEventList.class.php');

        $this->_AmbassadorEventList = new AmbassadorEventList($this->AID);
        return $this->_AmbassadorEventList->getAmbassadorEvents();
    }

    public function getNews() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include_once($rootpath . '/classes/AmbassadorNewsList.class.php');

        $this->_AmbassadorNewsList = new AmbassadorNewsList($this->AID);
        return $this->_AmbassadorNewsList->getAmbassadorNewsList();
    }

    public function getFavorites($type = "All") {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include_once($rootpath . '/classes/AmbassadorFavoriteList.class.php');

        $this->_AmbassadorFavoriteList = new AmbassadorFavoriteList($this->AID);
        return $this->_AmbassadorFavoriteList->getAmbassadorFavorites($type);
    }
    
    public function getInspirations() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include_once($rootpath . '/classes/AmbassadorInspirationList.class.php');

        $this->_AmbassadorInspirationList = new AmbassadorInspirationList($this->AID);
        return $this->_AmbassadorInspirationList->getAmbassadorInspirations();
    }

    public function getNewsAndEvents() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';

        $query = "{call F_GetEventsAndNews (@AID=:AID)}";
        $param = array(":AID" => $AID);
        $dbo->doQueryParam($query, $param);
        $list = $dbo->loadObjectList();

        return $list;
    }

    public function getNewsAndEventsWithLeadAmb() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';

        $query = "{call F_GetEventsAndNewsWithLeadAmb (@AID=:AID)}";
        $param = array(":AID" => $this->AID);
        $dbo->doQueryParam($query, $param);
        $list = $dbo->loadObjectList();

        return $list;
    }
    
    public function getAmbEventsWithGeneralEvents()
    {
    	  $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';

        $query = "{call F_GetAmbEventsAndGeneralEvents (@AID=:AID)}";
        $param = array(":AID" => $this->AID);
        $dbo->doQueryParam($query, $param);
        $list = $dbo->loadObjectList();

        return $list;
    }

    public function getPostsWithLeadAmb() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';

        $query = "{call F_GetAmbassadorPostsWithLeadAmb (@AID=:AID)}";
        $param = array(":AID" => $this->AID);
        $dbo->doQueryParam($query, $param);
        $list = $dbo->loadObjectList();

        return $list;
    }
    
    public function getAmbPublishedPosts() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';

        $query = "{call F_GetAmbPublishedPosts (@AID=:AID)}";
        $param = array(":AID" => $this->AID);
        $dbo->doQueryParam($query, $param);
        $list = $dbo->loadObjectList();

        return $list;
    }
    
    public function getPublishedPosts() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';

        $query = "{call F_GetAmbassadorPublishedPosts (@AID=:AID)}";
        $param = array(":AID" => $this->AID);
        $dbo->doQueryParam($query, $param);
        $list = $dbo->loadObjectList();

        return $list;
    }

    public function getCommonPosts() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';

        $query = "{call S_GetPublishCommonPost}";
        $dbo->doQuery($query);
        $list = $dbo->loadObjectList();

        return $list;
    }

    public function getCommonNewsAndEvents() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';

        $query = "{call F_GetCommonEventsAndNews}";
        $dbo->doQuery($query);
        $list = $dbo->loadObjectList();

        return $list;
    }

    public function getCommonEvents() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';

        //$query = "{call F_GetAmbassadorCommonEvents}";
        $query = "{call S_GetCommonEvents}";
        $dbo->doQuery($query);
        $list = $dbo->loadObjectList();

        return $list;
    }

    public function getCommonNews() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';

        $query = "{call F_GetAmbassadorCommonNews}";
        $dbo->doQuery($query);
        $list = $dbo->loadObjectList();

        return $list;
    }

    public function getPostRelations() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';

        $query = "select * from AmbassadorPostRelation where DelFlag=0 and AID=" . $this->AID;
        $dbo->doQuery($query);
        $list = $dbo->loadObjectList();

        return $list;
    }

    public function getEventsRelations() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';

        $query = "select * from AmbassadorEventsRelation where DelFlag=0 and AID=" . $this->AID;
        $dbo->doQuery($query);
        $list = $dbo->loadObjectList();

        return $list;
    }

    public function getNewsRelations() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';

        $query = "select * from AmbassadorNewsRelation where DelFlag=0 and AID=" . $this->AID;
        $dbo->doQuery($query);
        $list = $dbo->loadObjectList();

        return $list;
    }

}

?>