<?php
/**
 * Base class of an item(product).
 * 
 */
class Item extends table {

    protected $ItmID;
    protected $ItmName;
    protected $ItmDescr;
    protected $ItmPrice;
    protected $table = "Items";
    protected $IDName = "ItmID";

	/**
     * 
     */
    public function __construct() {
        
    }

    /**
     * Function to return the item id
     */
    public function getId() {
        return $this->ItmID;
    }

    /**
     * Function to return the item name
     */
    public function getName() {
        return $this->ItmName;
    }

    /**
     * Function to return the item price
     */
    public function getPrice() {
        return $this->ItmPrice;
    }

}

?>