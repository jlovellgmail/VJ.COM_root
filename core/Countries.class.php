<?php


class Countries {
    protected $list;
    
    function __construct(){
        $dbconn = database::getInstance();
        $sql = "{CALL S_AllCountries }";
        $dbconn->doQuery($sql);
        $this->list=$dbconn->loadObjectList();
    }
    
    public function getCountries(){
        return $this->list;
    }
    
    public function getCountriesDropDown($sel){
        $retStr="<option value='xx' >Please select country</option>\n";
        //$retStr.="<option value='US' >United States</option>\n";
        //$retStr.="<option value='CA' >Canada</option>\n";
         foreach ($this->list as $row ){
             $retStr = $retStr."<option value='".$row["id"]."'";
             if ($row["id"] == $sel){
                 $retStr = $retStr." selected ";
             } 
             $retStr = $retStr.">".$row["name"]."</option>\n";
         }
         return $retStr; 
        
    }
    
    
    function getCountryName($id){ 
        foreach ($this->list as $country) {
            
            if ($country["id"]==$id){
                return $country["name"];
                break;
            }
        }
    }
}
