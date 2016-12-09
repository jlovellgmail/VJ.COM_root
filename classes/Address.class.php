<?php

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/core/table.class.php';

class Address extends table {

    protected $AddrID;
    protected $UsrID;
    protected $FName;
    protected $LName;
    protected $Addr1;
    protected $Addr2;
    protected $City;
    protected $State;
    protected $Postal;
    protected $Country;
    protected $Phone;
    protected $Email;
    protected $Type;
    protected $isPrimary;
    protected $DateUpdated;
    protected $OrdID;
    protected $_saveAddrFlag;
    protected $table = "Address";
    protected $IDName = "AddrID";

    public function setPrimary() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';

        $query = "Update Address set isPrimary=0 where UsrID='" . $this->UsrID . "' and Type='" . $this->Type . "'";
        $dbo->doQuery($query);

        $this->isPrimary = 1;
        $this->store();
    }
    
    public function setSaveAddrFlag($saveFlag){
        $this->_saveAddrFlag=$saveFlag;
    }
    
    public function getSaveAddrFlag(){
        return $this->_saveAddrFlag;
    }

}
