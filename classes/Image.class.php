<?php

class Image {

    protected $imgType;
    protected $imgName;
    protected $exist;
    protected $ext;
    protected $Url;

    const location = '/uploadedImages/';

    protected $path;

    public function __construct($url) {
        $this->Url = $url;
    }

    public function getImageUrl() {
        $rootpath = $_SERVER['DOCUMENT_ROOT'];
        $url=$this->Url;
        $path = $rootpath . $url;
		//print_r($path);
        $imgUrl = "";
        if (file_exists($path)) {
            $nameArr = explode(".", $url);
            if (isset($nameArr[sizeof($nameArr) - 1])) {
                $this->ext = $nameArr[sizeof($nameArr) - 1];
                //$this->imgType = $type;
                //$this->imgID = $id;
                $nameArr = explode("." . $this->ext, $url);
                $nameArr = explode("\\", $nameArr[0]);
                $this->imgName = $nameArr[sizeof($nameArr) - 1];
            }
            $this->exist = "true";
            $imgUrl = str_replace("\\", "/", $this->Url);
        } else {
            $this->exist = "false";
        }

        return $imgUrl;
    }

    /* public function initialize($id, $type, $url) {
      $rootpath = $_SERVER['DOCUMENT_ROOT'];
      $this->path = $rootpath . $url;
      $this->Url = $url;
      clearstatcache();
      if (file_exists($this->path)) {
      $nameArr = explode(".", $url);
      if (isset($nameArr[sizeof($nameArr)-1])) {
      $this->ext = $nameArr[sizeof($nameArr)-1];
      $this->imgType = $type;
      $this->imgID = $id;
      $nameArr = explode("." . $this->ext, $url);
      $nameArr = explode("\\", $nameArr[0]);
      $this->imgName = $nameArr[sizeof($nameArr) - 1];
      }
      $this->exist = "true";
      } else {
      $this->exist = "false";
      }
      } */

    public function existImg() {
        return $this->exist;
    }

}
