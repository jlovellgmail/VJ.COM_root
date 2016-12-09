<?php

class AmbassadortList {

    protected $AmbassadortList;

    public function __construct() {
        if (!isset($this->AmbassadortList)) {
            $this->AmbassadortList = new ArrayObject();
        }

        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';
        include_once($rootpath . '/classes/Ambassador.class.php');

        $query = "{call F_GetAmbassadors}";
        $dbo->doQuery($query);
        $list = $dbo->loadObjectList();

        if (is_array($list)) {
            foreach ($list as $row) {
                $Ambassador = new Ambassador();
                $Ambassador->initialize($row);
                $Ambassador->setVar("AID", $row['AID']);
                $this->AmbassadortList->append($Ambassador);
            }
        }
    }

    public function getAmbassadors() {
        return $this->AmbassadortList;
    }

}

?>