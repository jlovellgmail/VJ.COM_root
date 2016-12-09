<?php

class Lifestyle {

    protected $PostList;
    protected $EventsList;

    public function __construct() {
        if (!isset($this->PostList)) {
            $this->PostList = new ArrayObject();
        }
        if (!isset($this->EventsList)){
            $this->EventsList = new ArrayObject();
        }

        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';
        include_once($rootpath . '/classes/Post.class.php');

        $query = "{call F_GetLifestylePosts}";
        $dbo->doQuery($query);
        $list = $dbo->loadObjectList();

        if (is_array($list)) {
            foreach ($list as $row) {
                $Post = new Post();
                $Post->initialize($row);
                $Post->setVar("PID", $row['PID']);
                $this->PostList->append($Post);
            }
        }

        include_once($rootpath . '/classes/AmbassadorEvent.class.php');

        $query = "{call S_GetLifestyleEvents}";
        $dbo->doQuery($query);
        $list = $dbo->loadObjectList();

        if (is_array($list)) {
            foreach ($list as $row) {
                $AmbassadorEvent = new AmbassadorEvent();
                $AmbassadorEvent->initialize($row);
                $AmbassadorEvent->setVar("EID", $row['EID']);
                $this->EventsList->append($AmbassadorEvent);
            }
        }
    }

    public function getLifestylePosts()
    {
        return $this->PostList;
    }

    public function getLifestyleEvents()
    {
        return $this->EventsList;
    }
}

?>