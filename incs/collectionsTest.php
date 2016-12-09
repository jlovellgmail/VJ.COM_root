<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
include "/Classes/LineList.class.php";
//include "/testClasses/CollectionColl.class.php";
//include "/testClasses/Line.class.php";

$Lines = new LineList();
$lines = $Lines->getLines();

$testLineArr;
    foreach ($lines as $line) {
		$testLineArr = $line;
        $LID = $line->getVar("LID");
        $Name = $line->getVar("Name");
        $Tagline = $line->getVar("Tagline");
        $CssClass = $line->getVar("CssClass");
		
		$res = $line->getLineCollections();
		
        ?>
        <div class = "bgWrapper collectionBgWrapper <?php echo $CssClass; ?>">
            <div class = "contentWrapper collectionContentWrapper">
                <div class = "lineTitleWrapper">
                    <span class = "productLineTitle"><?php echo $Name; ?> </span>
                    <div class="lineTitleSpace">&nbsp;</div><span class="lineLine">Line</span><br />
                    <span class="lineTagline">
                        <?php echo $Tagline; ?>
                    </span>
                </div>
                <div class="lineButtonsWrapper">
                    <?php foreach ($res as $collection) { ?>
                        <a class="collectionButton" href="<?php echo $collection->getVar('Url'); ?>" onClick="return false;"><?php echo $collection->getVar("Name"); ?></a>
						<?php //print_r($collection->getProducts()); 
							  //print_r($collection->getMenProducts());
							  //print_r($collection->getWomenProducts());
							  //print_r($collection->getUnisexProducts());
							  //print_r($collection->getAccessoryProducts());
							  print_r($collection->getButtons());?>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
    }
//$oneLine = new Line();
//$oneLine->initialize($testLineArr);
//$linecollection = $oneLine->getLineCollections();

//print_r($linecollection);

?>