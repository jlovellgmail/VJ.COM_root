<?php

/**
 * Description of CreditCard
 *
 * 
 */
class CreditCard {

    //put your code here
    protected $CCName;
    protected $CCNumber;
    protected $CCType;
    protected $CCXMonth;
    protected $CCXYear;
    protected $CCCode;

    function __construct() {
        
    }

    function initialize($properties) {
        if (is_array($properties)) {
            foreach ($properties as $var => $value) {
                if (property_exists($this, $var)) {
                    $this->$var = $value;
                }
            }
        }
    }
    
    public function getVar($varName) {
        return $this->$varName;
    }
    
    /**
     * Function to set a column value.
     */
    public function setVar($varName, $value) {
        $this->$varName = $value;
    }

}
