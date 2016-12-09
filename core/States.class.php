<?php

class States {

    protected $list;
    protected $USList;
    protected $CanadaList;

    function __construct() {
        $dbconn = database::getInstance();
        $sql = "{CALL S_AllStates }";
        $dbconn->doQuery($sql);
        $this->list = $dbconn->loadObjectList();
    }

    public function getStates() {
        return $this->list;
    }

    public function getStatesDropDown($sel) {
        $retStr = "<option value='xx' >Please select state / province</option>\n";
        //$retStr.="<option value='xx' >--------------------------</option>\n";
        //$retStr.="<option value='' >Other / Not listed. </option>\n";
        $retStr.="<option value='xx' >--------------------------</option>\n";
        foreach ($this->list as $row) {
            $retStr = $retStr . "<option value='" . $row["abbreviation"] . "'";
            if ($row["abbreviation"] == $sel) {
                $retStr = $retStr . " selected ";
            }
            $retStr = $retStr . " >" . $row["name"] . "</option>\n";
        }
        return $retStr;
    }
    
    public function getStatesDropDownByCountry($sel,$country){
        if ($country=="US"){
            $country="USA";
        }else if ($country=="CA"){
            $country="Canada";
        }
        $retStr = "<option value='' >Please select state / province</option>\n";
        //$retStr.="<option value='' >--------------------------</option>\n";
        //$retStr.="<option value='xx' >Other / Not listed. </option>\n";
        $retStr.="<option value='' >--------------------------</option>\n";
        foreach ($this->list as $row) {
            if (rtrim(ltrim($row["country"]))==$country){
                $retStr = $retStr . "<option value='" . $row["abbreviation"] . "'";
                if ($row["abbreviation"] == $sel) {
                    $retStr = $retStr . " selected ";
                }
                $retStr = $retStr . " >" . $row["name"] . "</option>\n";
            }
        }
        return $retStr;
    }

}
