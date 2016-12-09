<?php

class LifestylePostList {

    protected $LifestylePostList;

    public function __construct() {
        if (!isset($this->LifestylePostList)) {
            $this->LifestylePostList = new ArrayObject();
        }
		
		$rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';
        include_once($rootpath . '/classes/AmbassadorPost.class.php');

        $query = "{call F_GetLifestylePosts}";
        $dbo->doQuery($query);
        $list = $dbo->loadObjectList();
		
        if (is_array($list)) {
            foreach ($list as $row) {
                $AmbassadorPost = new AmbassadorPost();
                $AmbassadorPost->initialize($row);
                $AmbassadorPost->setVar("PID", $row['PID']);
                $this->LifestylePostList->append($AmbassadorPost);
            }
        }
    }
	
	public function getLifestylePosts()
	{
		return $this->LifestylePostList;
	}
}

?>