<?php

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/core/table.class.php';

class Line extends table {

    protected $LID;
    protected $Name;
    protected $DateCreated;
    protected $Tagline;
    protected $ImgUrl;
    protected $CssClass;
    protected $table = "Lines";
    protected $IDName = "LID";
    protected $_Collections;

    public function __construct() {
        $_Collections = new ArrayObject();
    }

    public function getLineCollections() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include_once($rootpath . '/classes/CollectionList.class.php');

        $collections = CollectionList::collectionsByLineID($this->LID);
        $this->_Collections = $collections->getCollections();

        return $this->_Collections;
    }

    public function initialize($properties) {
        parent::initialize($properties);

        if (!is_array($properties)) {
            $this->LID = $properties;
        }
    }

    public function getCollectionNames() {
        if (!isset($this->_Collections) || !is_array($this->_Collections)) {
            $this->getLineCollections();
        }
        $Tcount = 0;
        $collectionNames = "";
        foreach ($this->_Collections as $collection) {
            if ($Tcount == 0) {
                $collectionNames = $collection->getVar("Name");
            } else {
                $collectionNames .= ", " . $collection->getVar("Name");
            }
            $Tcount++;
        }

        return $collectionNames;
    }

}

?>