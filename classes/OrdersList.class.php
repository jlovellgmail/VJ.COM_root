<?php

class OrdersList {

    protected $OrderList;

    public function __construct() {
        $this->OrderList = new ArrayObject();
    }

    public function initializeAll() {
        
    }

    public function initializeByUser($UsrID) {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';
        include_once($rootpath . '/classes/Order.class.php');
        include_once($rootpath . '/classes/Product.class.php');

        $query = "{call S_UserOrders (@UsrID=:UsrID)}";
        $param = array(":UsrID" => $UsrID);
        $dbo->doQueryParam($query, $param);
        $list = $dbo->loadObjectList();

        if (is_array($list)) {
            $i = 0;
            $len = count($list);
            foreach ($list as $row) {
                if ($i == 0) {
                    $Order = new Order();
                    $Order->initializeByForm($row);
                } else {
                    if (isset($Order) && $Order->getOrdID() != $row["OrdID"]) {
                        $this->OrderList->append($Order);
                        $Order = new Order();
                        $Order->initializeByForm($row);
                    }
                }

                $Product = new Product();
                $Product->initializeByFormOnly($row);
                $Product->setSCProdID($row["PID"]);
                $Product->setVar("_StyleName", $row["ProdName"]);
                $Order->addItemFromArr($Product, $row["Qty"]);
                if ($i == $len - 1) {
                    $this->OrderList->append($Order);
                }
                $i++;
            }
        }
    }

    public function initializeForAdmin() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';
		include_once($rootpath . '/classes/Order.class.php');
        $query = "{call S_AdminAllOrders}";
        $dbo->doQuery($query);
        $list = $dbo->loadObjectList();
        if (is_array($list)) {
            foreach ($list as $row) {
                $Order = new Order();
                $Order->setVar("OrdID", $row["OrdID"]);
                $Order->setVar("Date", $row["Date"]);
                $Order->setVar("Status", $row["Status"]);
                $Order->setVar("Email", $row["Email"]);
                $Order->setVar("Amt", $row["Amt"]);
                $Order->setVar("PaymMethod", $row["PaymMethod"]);
                $this->OrderList->append($Order);
            }
        }
    }

    public function initializeSearch($search, $type) {
        if ($type == "Name") {
            $rootpath = $_SERVER['DOCUMENT_ROOT'];
            include $rootpath . '/incs/conn.php';
            //include_once('\\\SNPV1\MJC\VirgilJamesNet\classes\Order.class.php');
			include_once($rootpath . '/classes/Order.class.php');
            $query = "{call F_AdminOrdersByName (@Name=:Name)}";
            $search = '%' . $search . '%';
            $param = array(":Name" => $search);
            $dbo->doQueryParam($query, $param);
            $list = $dbo->loadObjectList();
            if (is_array($list)) {
                foreach ($list as $row) {
                    $Order = new Order();
                    $Order->setVar("OrdID", $row["OrdID"]);
                    $Order->setVar("Date", $row["Date"]);
                    $Order->setVar("Status", $row["Status"]);
                    $Order->setVar("Email", $row["Email"]);
                    $Order->setVar("Amt", $row["Amt"]);
                    $Order->setVar("PaymMethod", $row["PaymMethod"]);
                    $this->OrderList->append($Order);
                }
            }
        } else if ($type == "Phone") {
            $rootpath = $_SERVER['DOCUMENT_ROOT'];
            include $rootpath . '/incs/conn.php';
            //include_once('\\\SNPV1\MJC\VirgilJamesNet\classes\Order.class.php');
			include_once($rootpath . '/classes/Order.class.php');
            $query = "{call F_AdminOrdersByPhone (@Phone=:Phone)}";
            $search = $search . '%';
            $param = array(":Phone" => $search);
            $dbo->doQueryParam($query, $param);
            $list = $dbo->loadObjectList();
            if (is_array($list)) {
                foreach ($list as $row) {
                    $Order = new Order();
                    $Order->setVar("OrdID", $row["OrdID"]);
                    $Order->setVar("Date", $row["Date"]);
                    $Order->setVar("Status", $row["Status"]);
                    $Order->setVar("Email", $row["Email"]);
                    $Order->setVar("Amt", $row["Amt"]);
                    $Order->setVar("PaymMethod", $row["PaymMethod"]);
                    $this->OrderList->append($Order);
                }
            }
        } else if ($type == "Email") {
            $rootpath = $_SERVER['DOCUMENT_ROOT'];
            include $rootpath . '/incs/conn.php';
            //include_once('\\\SNPV1\MJC\VirgilJamesNet\classes\Order.class.php');
			include_once($rootpath . '/classes/Order.class.php');
            $query = "{call F_AdminOrdersByEmail (@Email=:Email)}";
            $search = '%' . $search . '%';
            $param = array(":Email" => $search);
            $dbo->doQueryParam($query, $param);
            $list = $dbo->loadObjectList();
            if (is_array($list)) {
                foreach ($list as $row) {
                    $Order = new Order();
                    $Order->setVar("OrdID", $row["OrdID"]);
                    $Order->setVar("Date", $row["Date"]);
                    $Order->setVar("Status", $row["Status"]);
                    $Order->setVar("Email", $row["Email"]);
                    $Order->setVar("Amt", $row["Amt"]);
                    $Order->setVar("PaymMethod", $row["PaymMethod"]);
                    $this->OrderList->append($Order);
                }
            }
        } else if ($type == "OrderNo") {
            $rootpath = $_SERVER['DOCUMENT_ROOT'];
            include $rootpath . '/incs/conn.php';
            //include_once('\\\SNPV1\MJC\VirgilJamesNet\classes\Order.class.php');
			include_once($rootpath . '/classes/Order.class.php');
            $query = "{call F_AdminOrdersByOrderNo (@OrderNo=:OrderNo)}";
            $search = $search . '%';
            $param = array(":OrderNo" => $search);
            $dbo->doQueryParam($query, $param);
            $list = $dbo->loadObjectList();
            if (is_array($list)) {
                foreach ($list as $row) {
                    $Order = new Order();
                    $Order->setVar("OrdID", $row["OrdID"]);
                    $Order->setVar("Date", $row["Date"]);
                    $Order->setVar("Status", $row["Status"]);
                    $Order->setVar("Email", $row["Email"]);
                    $Order->setVar("Amt", $row["Amt"]);
                    $Order->setVar("PaymMethod", $row["PaymMethod"]);
                    $this->OrderList->append($Order);
                }
            }
        } else if ($type == "All") {
            $rootpath = $_SERVER['DOCUMENT_ROOT'];
            include $rootpath . '/incs/conn.php';
            //include_once('\\\SNPV1\MJC\VirgilJamesNet\classes\Order.class.php');
			echo $rootpath . '/classes/Order.class.php';
			include $rootpath . '/classes/Order.class.php';
            $query = "{call F_AdminOrdersByAll (@search=:search)}";
            $param = array(":search" => $search);
            $dbo->doQueryParam($query, $param);
            $list = $dbo->loadObjectList();
            if (is_array($list)) {
                foreach ($list as $row) {
                    $Order = new Order();
                    $Order->setVar("OrdID", $row["OrdID"]);
                    $Order->setVar("Date", $row["Date"]);
                    $Order->setVar("Status", $row["Status"]);
                    $Order->setVar("Email", $row["Email"]);
                    $Order->setVar("Amt", $row["Amt"]);
                    $Order->setVar("PaymMethod", $row["PaymMethod"]);
                    $this->OrderList->append($Order);
                }
            }
        }
    }

    function getList() {
        return $this->OrderList;
    }

}
