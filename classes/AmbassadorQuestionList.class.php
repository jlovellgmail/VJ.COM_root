<?php

class AmbassadortQuestionList {

    protected $AmbassadortQuestionList;

    public function __construct($AID) {
        if (!isset($this->AmbassadortQuestionList)) {
            $this->AmbassadortQuestionList = new ArrayObject();
        }
		
		$rootpath = $_SERVER['DOCUMENT_ROOT'];
        include $rootpath . '/incs/conn.php';
        include_once($rootpath . '/classes/AmbassadorQuestion.class.php');

        $query = "{call F_GetAmbassadorQuestions (@AID=:AID)}";
		$param = array(":AID" => $AID);
        $dbo->doQueryParam($query, $param);
        $list = $dbo->loadObjectList();
		
        if (is_array($list)) {
            foreach ($list as $row) {
                $AmbassadorQuestion = new AmbassadorQuestion();
                $AmbassadorQuestion->initialize($row);
                $AmbassadorQuestion->setVar("QID", $row['QID']);
                $this->AmbassadortQuestionList->append($AmbassadorQuestion);
            }
        }
    }
	
	public function getAmbassadorQuestionss()
	{
		return $this->AmbassadortQuestionList;
	}
}

?>