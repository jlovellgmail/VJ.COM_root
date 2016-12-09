<?php

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/incs/conn.php';
include $rootpath . "/core/OrderBase.class.php";

class Order extends OrderBase {

    /**
     * @var Address => Shipping Address 
     */
    protected $ShippingAddr;

    /**
     *
     * @var Address => Billing Addr 
     */
    protected $BillingAddr;

    /**
     *
     * @var int  => Database generated Order ID. 
     */
    protected $OrdID;

    /**
     *
     * @var string => Email used for Order 
     */
    protected $Email;

    /**
     *
     * @var DateTime => Date order was generated 
     */
    protected $Date;

    /**
     *
     * @var string => Shipping Notes related to order. 
     */
    protected $ShipNotes;

    /**
     *
     * @var string - Possible values 'paypal','cc' 
     */
    protected $PaymMethod;

    /**
     * @var int $UsrID 
     */
    protected $UsrID;

    /**
     *
     * @var string - PHP Session ID 
     */
    protected $SessionID;

    /**
     * @var string $Email 
     */

    /**
     *
     * @var string => Transaction ID return by credit card or paypal processor 
     */
    protected $TransID;

    /**
     *
     * @var CreditCard 
     */
    protected $CreditCard;

    /**
     *
     * @var double => Total Amount for the order 
     */
    protected $Amt;

    /**
     *
     * @var Int => Shopping Cart ID that generated this order. 
     */
    protected $SCID;

    /**
     *
     * @var money - Tax amount, if not tax amount is set to 0 
     */
    protected $TaxAmt;

    /**
     *
     * @var int - Tax Invoice No, if no tax invoice is empyt 
     */
    protected $TaxInvoice;
    
    /**
     *
     * @var char(3)  - Status of the order
     * Possible values :
     *      PRC = Processing
     *      SHP = Shipped
     *      PND = Pending
     *      CNC = Cancelled   
     */
    protected $Status;
    
    protected $TrackingNo;
    
    protected $PaypalEmail;
    public function __construct() {
        
    }

    public function initialize($ordID) {
        if (isset($ordID) && $ordID != "") {
            $rootpath = $_SERVER['DOCUMENT_ROOT'];
            include $rootpath . "/classes/Address.class.php";
            include $rootpath . "/classes/CreditCard.class.php";
            include $rootpath . "/classes/Product.class.php";
            $dbconn = database::getInstance();
            $sql = "{CALL S_OrderByOrdID(@OrdID=:ordID)}";
            $param = array(":ordID" => $ordID);
            $dbconn->doQueryParam($sql, $param);
            $res = $dbconn->loadObjectList();
            $noItms = $dbconn->getRows();
            if ($noItms > 0) {
                $this->OrdID = $res[0]["OrdID"];
                $this->Email = $res[0]["Email"];
                $this->Date = $res[0]["Date"];
                $this->TaxAmt = $res[0]["TaxAmt"];
                $this->TaxInvoice = $res[0]["TaxInvoice"];
                $this->TrackingNo = $res[0]["TrackingNo"];
                if (isset($res[0]["ShipNotes"]) && $res[0]["ShipNotes"] != "") {
                    $this->ShipNotes = $res[0]["ShipNotes"];
                }
                $ShipAddr = new Address();
                $ShipAddr->initialize($res[0]["ShipAddr"]);
                $this->ShippingAddr = $ShipAddr;
                $this->PaymMethod = $res[0]["PaymMethod"];
                $this->TransID = $res[0]["TransID"];
                $this->Amt = $res[0]["Amt"];
                $this->Status = $res[0]["Status"];
                if (isset($res[0]["PaymMethod"]) && $res[0]["PaymMethod"] == "cc") {
                    $BillAddr = new Address();
                    $BillAddr->initialize($res[0]["BillAddr"]);
                    $this->BillingAddr = $BillAddr;
                    $CreditCard = new CreditCard();
                    $CreditCard->setVar("CCNumber", $res[0]["CCNum"]);
                    $CreditCard->setVar("CCType", $res[0]["CCType"]);
                    $DateArr = explode("/", $res[0]["CCExpdate"]);
                    $CreditCard->setVar("CCXMonth", $DateArr[0]);
                    $CreditCard->setVar("CCXYear", $DateArr[1]);
                    $this->CreditCard = $CreditCard;
                }else if (isset($res[0]["PaymMethod"]) && $res[0]["PaymMethod"] == "paypal"){
                    $this->PaypalEmail=$res[0]["PaypalEmail"];
                }
                foreach ($res as $row) {
                    if (isset($row["PID"])) {
                        $Product = new Product();
                        $Product->initialize($row["PID"]);
                        //Do that because for shopping cart we use database id
                        $Product->setSCProdID($row["PID"]);

                        $Product->setVar("Price", $row["Price"]);
                        parent::addItem($Product, $row["Qty"]);
                    }
                }
            }
        }
    }

    public function initializeByForm($properties) {
        if (is_array($properties)) {
            foreach ($properties as $var => $value) {
                if (property_exists($this, $var)) {
                    $this->$var = $value;
                }
            }
        }
    }

    /**
     * Function to get a column value.
     */
    public function getVar($varName) {
        return $this->$varName;
    }

    /**
     * Function to set a column value.
     */
    public function setVar($varName, $value) {
        $this->$varName = $value;
    }

    public function getCreditCard() {
        return $this->CreditCard;
    }

    /**
     * Return Order ID
     */
    public function getOrdID() {
        return $this->OrdID;
    }

    public function getDate() {
        if (!isset($this->Date) && $this->Date == "") {
            if (isset($this->OrdID)) {
                $sql = "Select Date from Orders where OrdID=" . $this->OrdID;
                $dbo = database::getInstance();
                $dbo->doQuery($sql);
                $res = $dbo->loadObjectList();
                $this->Date = $res[0]["Date"];
            }
        }
        $tmpdata = strtotime($this->Date);
        return date("F", $tmpdata) . " " . date("d", $tmpdata) . ", " . date("Y", $tmpdata);
    }
    
      public function getDateShort() {
        if (!isset($this->Date) && $this->Date == "") {
            if (isset($this->OrdID)) {
                $sql = "Select Date from Orders where OrdID=" . $this->OrdID;
                $dbo = database::getInstance();
                $dbo->doQuery($sql);
                $res = $dbo->loadObjectList();
                $this->Date = $res[0]["Date"];
            }
        }
        $tmpdata = strtotime($this->Date);
        return date("M", $tmpdata) . " " . date("d", $tmpdata) . ", " . date("Y", $tmpdata);
    }
    public function store() {

        $Amt = $this->Amt;
        $transID = $_SESSION["TransID"];
        if (isset($this->UsrID) && $this->UsrID != "") {
            $usrID = $this->UsrID;
        } else {
            $usrID = 0;
        }
        $sessionId = $this->SessionID;
        $email = $this->Email;
        if ($this->PaymMethod == "paypal") {
            if (isset($_SESSION["paypal_email"])){
                $pemail=$_SESSION["paypal_email"];
            } else {
                $pemail="";
            }
            $sql = "Insert Into Orders (Email,UsrID,SessionID,Amt,TransID,PaymMethod,ShipNotes,TaxAmt,TaxInvoice,PaypalEmail) values";
            $sql .=" ('$email',$usrID,'$sessionId',$Amt,'$transID','paypal','$this->ShipNotes',$this->TaxAmt,'$this->TaxInvoice','$pemail')";
            $sql .= ";SELECT SCOPE_IDENTITY() AS LastInsertID";
        } else if ($this->PaymMethod == "cc") {
            $CCNo = $this->CreditCard->getVar("CCNumber");
            $CCNum = "**********" . substr($CCNo, -4);
            $CCType = $this->CreditCard->getVar("CCType");
            $CCDate = $this->CreditCard->getVar("CCXMonth") . "/" . $this->CreditCard->getVar("CCXYear");
            $AuthCode = $_SESSION["AuthCode"];

            $sql = "Insert Into Orders (Email,UsrID,SessionID,Amt,TransID,PaymMethod,ShipNotes,CCNum,CCType,CCExpdate,CCAuthCode,TaxAmt,TaxInvoice) values";
            $sql .=" ('$email',$usrID,'$sessionId',$Amt,'$transID','cc','$this->ShipNotes','$CCNum','$CCType','$CCDate','$AuthCode',$this->TaxAmt,'$this->TaxInvoice')";
            $sql .= ";SELECT SCOPE_IDENTITY() AS LastInsertID";
        }

        $dbo = database::getInstance();
        $dbo->doQuery($sql);
        $this->OrdID = $dbo->getInsertID();

        $SAddr = $this->ShippingAddr;
        $SAddrID = $SAddr->getVar("AddrID");
        //if (!isset($SAddrID) || $SAddrID == "") {
        $SAddr->setVar("OrdID", $this->OrdID);
        $SAddr->store();
        $SAddrID = $SAddr->getVar("AddrID");
        //}
        // if user wants address saved $SAddr->setVar("UsrID", $usrID);

        if ($this->PaymMethod == "cc") {
            $BAddr = $this->BillingAddr;
            $BAddrID = $BAddr->getVar("AddrID");
            //if (!isset($BAddrID) || $BAddrID == "") {
            $BAddr->setVar("OrdID", $this->OrdID);
            $BAddr->store();
            $BAddrID = $BAddr->getVar("AddrID");
            //}
            // if user wants address saved $SAddr->setVar("UsrID", $usrID);
            $sqlUpd = "Update Orders set ShipAddr=" . $SAddrID . ",BillAddr=" . $BAddrID . " where OrdID=" . $this->OrdID;
        } else {
            $sqlUpd = "Update Orders set ShipAddr=" . $SAddrID . " where OrdID=" . $this->OrdID;
        }
        $dboUpd = database::getInstance();
        $dboUpd->doQuery($sqlUpd);
        $ProductsArr = $this->items;
        foreach ($ProductsArr as $Product) {
            $ProdID = $Product["item"]->getPID();
            $ProdQTy = $Product["qty"];
            $Price = $Product["item"]->getVar("Price");
            $sqlIns = "Insert Into OrderProducts (OrdID,PID,Qty,Price) values ($this->OrdID,$ProdID,$ProdQTy,$Price)";
            $dbo->doQuery($sqlIns);
        }

        $sqlDel = "Delete from ShopcartProducts where SCID=" . $this->SCID;
        $dbo->doQuery($sqlDel);
        $sqlDel = "Delete from Shopcart where SCID=" . $this->SCID;
        $dbo->doQuery($sqlDel);


        unset($_SESSION["TransID"]);
        unset($_SESSION["TOKEN"]);
        unset($_SESSION["AuthCode"]);
        unset($_SESSION["currencyCodeType"]);
        unset($_SESSION["PaymentType"]);
        unset($_SESSION["payer_id"]);
        unset($_SESSION["Cart"]);
    }

    /**
     * Returns to total Price of the shopping cart
     * @return float toal of shopping cart
     */
    public function getTotalWithOutTax() {
        $total = 0;
        foreach ($this->items as $itemArr) {
            $item = $itemArr["item"];
            $qty = $itemArr["qty"];
            $total += $qty * $item->getVar("Price");
        }
        return number_format((float) $total, 2, '.', '');
    }

    /**
     * Returns to total Price of the shopping cart
     * @return float toal of shopping cart
     */
    public function getTotal() {
        $total = 0;
        foreach ($this->items as $itemArr) {
            $item = $itemArr["item"];
            $qty = $itemArr["qty"];
            $total += $qty * $item->getVar("Price");
        }
        if ($this->TaxAmt > 0) {
            $total+=$this->TaxAmt;
        }
        return number_format((float) $total, 2, '.', '');
    }

    /**
     * Adds a new item to the order:Savvas Implementation for the add method to overwrite the one in the base file, to allow multiple 
     * products with the same id.
     */
    public function addItemFromArr(Product $item, $qty) {

        // Need the item id:
        $id = $item->getId();

        // Throw an exception if there's no id:
        if (!$id)
            throw new Exception('The order requires items with unique ID values.');

        // Add or update:

        $this->items[$id] = array('item' => $item, 'qty' => $qty);
        //$this->items[$id] = $item;
        $this->ids[] = $id; // Store the id, too!
    }
    
    public function getOrderStatus(){
        $statusFlag = trim($this->Status);
        $statusStr = "";
        if (isset($statusFlag)){
            $statusStr = "";
            switch ($statusFlag){
                case "PRC":
                    $statusStr="Processing";
                    break;
                case "SHP":
                    $statusStr="Shipped";
                    break;
                case "PND":
                    $statusStr="Pending";
                    break;
                case "CNC":
                    $statusStr="Cancelled";
                default :
                    break;
            }
            return $statusStr;
        }
        
    }
}
