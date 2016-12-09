<?php
/**
 * Class to upload, edit and save images on server.
 * 
 */
$rootp = $_SERVER['DOCUMENT_ROOT'];
include 'upload.class.php';
include_once($rootp . '/incs/conn.php');
//include $rootp . '/classes/LibraryItem.class.php';

class imageUpload extends upload {

    var $Path = "\uploadedImages";
	var $TempImgPath = "\uploadedImages\Temp";
    //var $TeamMembersPath = "\uploadedImages\TeamMembers";

	/**
     * Constructor
     * 
     * @param $file -> image to upload
     */
    function imageUpload($file, $lang = 'en_GB') {
        $rootp = $_SERVER['DOCUMENT_ROOT'];
		$this->Path = $rootp . $this->Path;
        $this->TempImgPath = $rootp . $this->TempImgPath;
        //$this->JobPath = $rootp . $this->JobPath;

        parent::Upload($file);
        $this->file_overwrite = true;
		//$this->image_convert = 'jpeg';
    }

	/**
     * Function to return the log
     * 
     * @return log
     */
    function getLog() {
        return $this->log;
    }

    /**
     * Function to return the image path
     * 
     * @return path
     */
    public function getPath() {
        return $this->ItemPath;
    }

    /**
     * Function to save the original size of the image
     * 
     * @param $type -> type of image to upload. 
     */
    function saveOriginal() {
        $this->file_overwrite = false;

        $tmpPath = $this->save($type);
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
	
	function saveTemplate() {
        $this->file_overwrite = false;
		$this->Path = "..\uploadedImages\Products";

        $tmpPath = $this->save($type);
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
	
	function saveProduct() {
        $this->file_overwrite = false;
		$this->Path = "..\uploadedImages\Products";

        $tmpPath = $this->save($type);
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
	
	function saveProductThumb() {
        $this->file_overwrite = false;
		
		$this->image_resize = true;
        $this->image_ratio_y = true;
        $this->image_x = 480;
		$this->Path = "..\uploadedImages\Products";

        $tmpPath = $this->save($type);
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }

	function saveProductGal() {
        $this->file_overwrite = false;
		$this->image_convert = 'jpeg';
		$this->Path = "..\uploadedImages\Products";

        $tmpPath = $this->save($type);
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
	
	function saveProductGalThumb() {
        $this->file_overwrite = false;
		$this->image_convert = 'jpeg';
		
		$this->image_resize = true;
        $this->image_ratio_y = true;
        $this->image_x = 480;
		$this->Path = "..\uploadedImages\Products";

        $tmpPath = $this->save($type);
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
	
	function saveTempImg() {
        $this->file_src_name_body = "Temp" . Rand();
        $this->file_src_name = $this->file_src_name_body . "." . $this->file_src_name_ext;

        $id = "0";
		$this->Path = $this->TempImgPath;
        $tmpPath = $this->save();
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
    
    function saveAdminTempImg() {
        $this->file_src_name_body = "Temp" . Rand();
        $this->file_src_name = $this->file_src_name_body . "." . $this->file_src_name_ext;

        $id = "0";
		$this->Path = "..\uploadedImages\Temp";
        $tmpPath = $this->save();
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
    
    function resizeAdminImage($x, $y) {
        $this->file_src_name_body = "Temp" . Rand();
        $this->file_src_name = $this->file_src_name_body . "." . $this->file_src_name_ext;

        $this->image_resize = true;
        $this->image_y = $y;
        $this->image_x = $x;

        $id = "0";
        $this->Path = "..\uploadedImages\Temp";
        $tmpPath = $this->save();
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
	
	function resizeImage($x, $y) {
        $this->file_src_name_body = "Temp" . Rand();
        $this->file_src_name = $this->file_src_name_body . "." . $this->file_src_name_ext;

        $this->image_resize = true;
        $this->image_y = $y;
        $this->image_x = $x;

        $id = "0";
        $this->Path = $this->TempImgPath;
        $tmpPath = $this->save();
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
	
	function resizeEventsImage($x, $y) {
        $this->file_src_name_body = "Temp" . Rand();
        $this->file_src_name = $this->file_src_name_body . "." . $this->file_src_name_ext;

        $this->image_resize = true;
        $this->image_y = $y * 3;
        $this->image_x = $x * 3;

        $id = "0";
        $this->Path = $this->TempImgPath;
        $tmpPath = $this->save();
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
	
	function resizeProfilePrevImage($x, $y) {
        $this->file_src_name_body = "Temp" . Rand();
        $this->file_src_name = $this->file_src_name_body . "." . $this->file_src_name_ext;

        $this->image_resize = true;
        $this->image_y = $y * 2.16;
        $this->image_x = $x * 2.16;

        $id = "0";
        $this->Path = $this->TempImgPath;
        $tmpPath = $this->save();
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
	
	function resizeHeroImage($x, $y) {
        $this->file_src_name_body = "Temp" . Rand();
        $this->file_src_name = $this->file_src_name_body . "." . $this->file_src_name_ext;

        $this->image_resize = true;
        $this->image_y = $y * 5;
        $this->image_x = $x * 5;

        $id = "0";
        $this->Path = $this->TempImgPath;
        $tmpPath = $this->save();
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
    
    function resizeBlockImage($x, $y) {
        $this->file_src_name_body = "Temp" . Rand();
        $this->file_src_name = $this->file_src_name_body . "." . $this->file_src_name_ext;

        $this->image_resize = true;
        $this->image_y = $y * 5;
        $this->image_x = $x * 5;

        $id = "0";
        $this->Path = $this->TempImgPath;
        $tmpPath = $this->save();
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
    
    function resizeInspirationImage($x, $y) {
        $this->file_src_name_body = "Temp" . Rand();
        $this->file_src_name = $this->file_src_name_body . "." . $this->file_src_name_ext;

        $this->image_resize = true;
        $this->image_y = $y * 4;
        $this->image_x = $x * 4;

        $id = "0";
        $this->Path = $this->TempImgPath;
        $tmpPath = $this->save();
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
    
    function resizePostPreview($x, $y) {
        $this->file_src_name_body = "Temp" . Rand();
        $this->file_src_name = $this->file_src_name_body . "." . $this->file_src_name_ext;

        $this->image_resize = true;
        $this->image_y = $y * 1.2;
        $this->image_x = $x * 1.2;

        $id = "0";
        $this->Path = $this->TempImgPath;
        $tmpPath = $this->save();
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
    
    function resizeGalleryItem($x, $y) {
        $this->file_src_name_body = "Temp" . Rand();
        $this->file_src_name = $this->file_src_name_body . "." . $this->file_src_name_ext;

        $this->image_resize = true;
        $this->image_y = $y * 4;
        $this->image_x = $x * 4;

        $id = "0";
        $this->Path = $this->TempImgPath;
        $tmpPath = $this->save();
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
	
	function cropPostHero($id, $x, $y, $x1, $y1, $isAdmin, $FName) {
		$rootp = $_SERVER['DOCUMENT_ROOT'];
		$this->file_src_name_body = $id . "_POH" . time();
        $this->file_src_name = $this->file_src_name_body . "." . $this->file_src_name_ext;
		
		$x = $x * 5;
		$x1 = $x1 * 5;
		$y = $y * 5;
		$y1 = $y1 * 5;
		
        $x2 = $x - ($x1 + 1440);
        $y2 = $y - ($y1 + 475);
        $this->image_crop = $y1 . ' ' . $x2 . ' ' . $y2 . ' ' . $x1;
        
        if ($isAdmin)
        {
        		$this->Path = $rootp . "\uploadedImages\Posts";
        }
        else
        {
        		$this->Path = $rootp . "\uploadedImages\Users\\" . $FName . "_" . $id . "\Posts";
        }

        $tmpPath = $this->save();
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
    
    function cropPostPreview($id, $x, $y, $x1, $y1, $isAdmin, $FName) {
		$rootp = $_SERVER['DOCUMENT_ROOT'];
		$this->file_src_name_body = $id . "_PRV" . time();
        $this->file_src_name = $this->file_src_name_body . "." . $this->file_src_name_ext;
		
		$x = $x * 1.2;
		$x1 = $x1 * 1.2;
		$y = $y * 1.2;
		$y1 = $y1 * 1.2;
		
        $x2 = $x - ($x1 + 240);
        $y2 = $y - ($y1 + 240);
        $this->image_crop = $y1 . ' ' . $x2 . ' ' . $y2 . ' ' . $x1;
        
        if ($isAdmin)
        {
        		$this->Path = $rootp . "\uploadedImages\Posts";
        }
        else
        {
        		$this->Path = $rootp . "\uploadedImages\Users\\" . $FName . "_" . $id . "\Posts";
        }

        $tmpPath = $this->save();
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
    
    function cropGalleryItem($x, $y, $x1, $y1) {
		$rootp = $_SERVER['DOCUMENT_ROOT'];
		$this->file_src_name_body = "GAL_" . time();
        $this->file_src_name = $this->file_src_name_body . "." . $this->file_src_name_ext;
		
		$x = $x * 4;
		$x1 = $x1 * 4;
		$y = $y * 4;
		$y1 = $y1 * 4;
		
        $x2 = $x - ($x1 + 800);
        $y2 = $y - ($y1 + 800);
        $this->image_crop = $y1 . ' ' . $x2 . ' ' . $y2 . ' ' . $x1;
        
        $this->Path = $rootp . "\uploadedImages\Gallery";

        $tmpPath = $this->save();
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
    
    function cropBlockImage($id, $x, $y, $x1, $y1, $isAdmin, $FName) {
		$rootp = $_SERVER['DOCUMENT_ROOT'];
		$this->file_src_name_body = $id . "_BLK" . time();
        $this->file_src_name = $this->file_src_name_body . "." . $this->file_src_name_ext;
		
		$x = $x * 5;
		$x1 = $x1 * 5;
		$y = $y * 5;
		$y1 = $y1 * 5;
		
        $x2 = $x - ($x1 + 1440);
        $y2 = $y - ($y1 + 900);
        $this->image_crop = $y1 . ' ' . $x2 . ' ' . $y2 . ' ' . $x1;
        
        if ($isAdmin)
        {
        		$this->Path = $rootp . "\uploadedImages\Posts";
        }
        else
        {
        		$this->Path = $rootp . "\uploadedImages\Users\\" . $FName . "_" . $id . "\Posts";
        }

        $tmpPath = $this->save();
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
    
    function cropBlockSlideshowImage($id, $x, $y, $x1, $y1, $isAdmin, $FName) {
		$rootp = $_SERVER['DOCUMENT_ROOT'];
		$this->file_src_name_body = $id . "_SS" . time();
        $this->file_src_name = $this->file_src_name_body . "." . $this->file_src_name_ext;
		
		$x = $x * 5;
		$x1 = $x1 * 5;
		$y = $y * 5;
		$y1 = $y1 * 5;
		
        $x2 = $x - ($x1 + 1440);
        $y2 = $y - ($y1 + 900);
        $this->image_crop = $y1 . ' ' . $x2 . ' ' . $y2 . ' ' . $x1;
        
        if ($isAdmin)
        {
        		$this->Path = $rootp . "\uploadedImages\Posts\Slideshow";
        }
        else
        {
        		$this->Path = $rootp . "\uploadedImages\Users\\" . $FName . "_" . $id . "\Posts\Slideshow";
        }

        $tmpPath = $this->save();
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
	
   function cropInspSquareImage($id, $x, $y, $x1, $y1, $isAdmin, $FName) {
		$rootp = $_SERVER['DOCUMENT_ROOT'];
		$this->file_src_name_body = $id . "_INSP" . time();
        $this->file_src_name = $this->file_src_name_body . "." . $this->file_src_name_ext;
		
		$x = $x * 4;
		$x1 = $x1 * 4;
		$y = $y * 4;
		$y1 = $y1 * 4;
		
        $x2 = $x - ($x1 + 800);
        $y2 = $y - ($y1 + 800);
        $this->image_crop = $y1 . ' ' . $x2 . ' ' . $y2 . ' ' . $x1;
        
        if ($isAdmin)
        {
        		$this->Path = $rootp . "\uploadedImages\Inspiration";
        }
        else
        {
        		$this->Path = $rootp . "\uploadedImages\Users\\" . $FName . "_" . $id . "\Inspiration";
        }

        $tmpPath = $this->save();
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
    
    function cropInpsWideImage($id, $x, $y, $x1, $y1, $isAdmin, $FName) {
		$rootp = $_SERVER['DOCUMENT_ROOT'];
		$this->file_src_name_body = $id . "_INSP" . time();
        $this->file_src_name = $this->file_src_name_body . "." . $this->file_src_name_ext;
		
		$x = $x * 4;
		$x1 = $x1 * 4;
		$y = $y * 4;
		$y1 = $y1 * 4;
		
        $x2 = $x - ($x1 + 1600);
        $y2 = $y - ($y1 + 800);
        $this->image_crop = $y1 . ' ' . $x2 . ' ' . $y2 . ' ' . $x1;
        
        if ($isAdmin)
        {
        		$this->Path = $rootp . "\uploadedImages\Inspiration";
        }
        else
        {
        		$this->Path = $rootp . "\uploadedImages\Users\\" . $FName . "_" . $id . "\Inspiration";
        }

        $tmpPath = $this->save();
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
    
    function cropInspTallImage($id, $x, $y, $x1, $y1, $isAdmin, $FName) {
		$rootp = $_SERVER['DOCUMENT_ROOT'];
		$this->file_src_name_body = $id . "_INSP" . time();
        $this->file_src_name = $this->file_src_name_body . "." . $this->file_src_name_ext;
		
		$x = $x * 4;
		$x1 = $x1 * 4;
		$y = $y * 4;
		$y1 = $y1 * 4;
		
        $x2 = $x - ($x1 + 800);
        $y2 = $y - ($y1 + 1600);
        $this->image_crop = $y1 . ' ' . $x2 . ' ' . $y2 . ' ' . $x1;
        
        if ($isAdmin)
        {
        		$this->Path = $rootp . "\uploadedImages\Inspiration";
        }
        else
        {
        		$this->Path = $rootp . "\uploadedImages\Users\\" . $FName . "_" . $id . "\Inspiration";
        }

        $tmpPath = $this->save();
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
     
	function cropProfile($id, $x, $y, $x1, $y1, $FName) {
		$rootp = $_SERVER['DOCUMENT_ROOT'];
		$this->file_src_name_body = $id . "_P" . time();
        $this->file_src_name = $this->file_src_name_body . "." . $this->file_src_name_ext;
		
        $x2 = $x - ($x1 + 315);
        $y2 = $y - ($y1 + 350);
        $this->image_crop = $y1 . ' ' . $x2 . ' ' . $y2 . ' ' . $x1;

        $this->Path = $rootp . "\uploadedImages\Users\\" . $FName . "_" . $id . "\Profile";
        
        $tmpPath = $this->save();
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
	
	function cropProfilePrev($id, $x, $y, $x1, $y1, $FName) {
		$rootp = $_SERVER['DOCUMENT_ROOT'];
		$this->file_src_name_body = $id . "_PP" . time();
        $this->file_src_name = $this->file_src_name_body . "." . $this->file_src_name_ext;
		
		$x = $x * 2.16;
		$x1 = $x1 * 2.16;
		$y = $y * 2.16;
		$y1 = $y1 * 2.16;
		
        $x2 = $x - ($x1 + 648);
        $y2 = $y - ($y1 + 648);
        $this->image_crop = $y1 . ' ' . $x2 . ' ' . $y2 . ' ' . $x1;
        
        $this->Path = $rootp . "\uploadedImages\Users\\" . $FName . "_" . $id . "\Profile";

        $tmpPath = $this->save();
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
	
	function cropSquare($id, $x, $y, $x1, $y1, $isAdmin, $FName) {
		$rootp = $_SERVER['DOCUMENT_ROOT'];
		$this->file_src_name_body = $id . "_" . Rand();
        $this->file_src_name = $this->file_src_name_body . "." . $this->file_src_name_ext;
		
        $x2 = $x - ($x1 + 300);
        $y2 = $y - ($y1 + 300);
        $this->image_crop = $y1 . ' ' . $x2 . ' ' . $y2 . ' ' . $x1;
        
        if ($isAdmin)
        {
        		$this->Path = $rootp . "\uploadedImages\Posts";
        }
        else
        {
        		$this->Path = $rootp . "\uploadedImages\Users\\" . $FName . "_" . $id . "\Posts";
        }

        $tmpPath = $this->save();
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
    
    function cropSquareFavorite($id, $x, $y, $x1, $y1, $FName) {
    	$rootp = $_SERVER['DOCUMENT_ROOT'];
		$this->file_src_name_body = $id . "_" . Rand();
        $this->file_src_name = $this->file_src_name_body . "." . $this->file_src_name_ext;
		
        $x2 = $x - ($x1 + 300);
        $y2 = $y - ($y1 + 300);
        $this->image_crop = $y1 . ' ' . $x2 . ' ' . $y2 . ' ' . $x1;
        
        $this->Path = $rootp . "\uploadedImages\Users\\" . $FName . "_" . $id . "\Favorites";

        $tmpPath = $this->save();
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
    
    function cropAdminSquare($id, $x, $y, $x1, $y1) {
		$this->file_src_name_body = $id . "_" . Rand();
        $this->file_src_name = $this->file_src_name_body . "." . $this->file_src_name_ext;
		
        $x2 = $x - ($x1 + 300);
        $y2 = $y - ($y1 + 300);
        $this->image_crop = $y1 . ' ' . $x2 . ' ' . $y2 . ' ' . $x1;

        $this->Path = "..\uploadedImages";
        $tmpPath = $this->save();
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
	
	function cropNewsEvents($id, $x, $y, $x1, $y1) {
		$this->file_src_name_body = $id . "_" . Rand();
        $this->file_src_name = $this->file_src_name_body . "." . $this->file_src_name_ext;
		
        $x2 = $x - ($x1 + 256);
        $y2 = $y - ($y1 + 146);
        $this->image_crop = $y1 . ' ' . $x2 . ' ' . $y2 . ' ' . $x1;

        $tmpPath = $this->save();
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
	
	function cropNewsEvents2($id, $x, $y, $x1, $y1, $isAdmin, $FName) {
		$rootp = $_SERVER['DOCUMENT_ROOT'];
		$this->file_src_name_body = $id . "_" . Rand();
        $this->file_src_name = $this->file_src_name_body . "." . $this->file_src_name_ext;
		
		$x = $x * 3;
		$x1 = $x1 * 3;
		$y = $y * 3;
		$y1 = $y1 * 3;
		
        $x2 = $x - ($x1 + 768);
        $y2 = $y - ($y1 + 438);
        $this->image_crop = $y1 . ' ' . $x2 . ' ' . $y2 . ' ' . $x1;
        
        if ($isAdmin)
        {
        		$this->Path = $rootp . "\uploadedImages\Events";
        }
        else
        {
        		$this->Path = $rootp . "\uploadedImages\Users\\" . $FName . "_" . $id . "\Events";
        }
        
        $tmpPath = $this->save();
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
	
	function saveProfileHero($id, $FName) {
		  $rootp = $_SERVER['DOCUMENT_ROOT'];
        $this->file_src_name_body = $id . "_PH" . time();
        $this->file_src_name = $this->file_src_name_body . "." . $this->file_src_name_ext;

        $this->image_resize = true;
        $this->image_ratio_x = true;
        $this->image_y = 1440;
        
        $this->Path = $rootp . "\uploadedImages\Users\\" . $FName . "_" . $id . "\Profile";

        $tmpPath = $this->save();
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
	
	function savePostHero($id) {
        $this->file_src_name_body = $id . "_PH" . time();
        $this->file_src_name = $this->file_src_name_body . "." . $this->file_src_name_ext;

        $this->image_resize = true;
        $this->image_ratio_x = true;
        $this->image_y = 1440;

        $tmpPath = $this->save();
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
	
	function saveProfileSlideshow($id, $FName) {
		  $rootp = $_SERVER['DOCUMENT_ROOT'];
        $this->file_src_name_body = $id . "_PH" . Rand();
        $this->file_src_name = $this->file_src_name_body . "." . $this->file_src_name_ext;
        
        $this->Path = $rootp . "\uploadedImages\Users\\" . $FName . "_" . $id . "\Profile";

        $tmpPath = $this->save();
        $index = strpos($tmpPath, "\uploadedImages");
        $path = substr($tmpPath, $index);
        return $path;
    }
	
    /**
     * Function to save the images created
     * 
     * @param $type -> type of image to upload.
     */
    private function save() {
        $dest = $this->Path;

        $result = $this->Process($dest);

        if ($this->processed) {
            return $this->file_dst_pathname;
        } else {
            return false;
        }

        $this->Clean();
    }

	 /**
     * Function to return the source image width
     */
    function getWidth() {
        return $this->image_src_x;
    }

	 /**
     * Function to return the source image height
     */
    function getHeight() {
        return $this->image_src_y;
    }

}

?>