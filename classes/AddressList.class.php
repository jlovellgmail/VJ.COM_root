<?php

class AddressList {

    protected $ShipAddressList;
    protected $BillAddressList;

    public function __construct($UsrID) {
        $this->ShipAddressList = new ArrayObject();
        $this->BillAddressList = new ArrayObject();

        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';
        include_once($rootpath . '/classes/Address.class.php');

        $query = "{call F_GetShipAddressByUsrID (@UsrID=:UsrID)}";
        $param = array(":UsrID" => $UsrID);
        $dbo->doQueryParam($query, $param);
        $list = $dbo->loadObjectList();

        if (is_array($list)) {
            foreach ($list as $row) {
                $Address = new Address();
                $Address->initialize($row);
                $Address->setVar("AddrID", $row["AddrID"]);
                $this->ShipAddressList->append($Address);
            }
        }

        $query = "{call F_GetBillAddressByUsrID (@UsrID=:UsrID)}";
        $param = array(":UsrID" => $UsrID);
        $dbo->doQueryParam($query, $param);
        $list = $dbo->loadObjectList();

        if (is_array($list)) {
            foreach ($list as $row) {
                $Address = new Address();
                $Address->initialize($row);
                $Address->setVar("AddrID", $row["AddrID"]);
                $this->BillAddressList->append($Address);
            }
        }
    }

    public function getShipAddressList() {
        return $this->ShipAddressList;
    }

    public function getBillAddressList() {
        return $this->BillAddressList;
    }

}

?>