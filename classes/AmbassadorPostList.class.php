<?php

class AmbassadorPostList {

    protected $AmbassadorPostList;

    public function __construct($AID) {
        if (!isset($this->AmbassadorPostList)) {
            $this->AmbassadorPostList = new ArrayObject();
        }

        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';
        include_once($rootpath . '/classes/AmbassadorPost.class.php');

        $query = "{call F_GetAmbassadorPosts (@AID=:AID)}";
        $param = array(":AID" => $AID);
        $dbo->doQueryParam($query, $param);
        $list = $dbo->loadObjectList();

        if (is_array($list)) {
            foreach ($list as $row) {
                $AmbassadorPost = new AmbassadorPost();
                $AmbassadorPost->initialize($row);
                $AmbassadorPost->setVar("PID", $row['PID']);
                $this->AmbassadorPostList->append($AmbassadorPost);
            }
        }
    }

    public function getAmbassadorPosts() {
        return $this->AmbassadorPostList;
    }

}

?>