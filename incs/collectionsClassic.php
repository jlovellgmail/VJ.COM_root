<?php
$LID=10;
$line = new Line();
$line->initialize($LID);
$Name = $line->getVar("Name");
$Tagline = $line->getVar("Tagline");

$sql = "{CALL F_GetLineCollections (@LID=:LID)}";
$param = array(":LID" => $LID);
$dbo->doQueryParam($sql, $param);
$res = $dbo->loadObjectList();
?>

<div class="bgWrapper collectionBgWrapper classicCollectionBgWrapper">
    <div class="contentWrapper collectionContentWrapper">
        <div class="lineTitleWrapper">
            <span class="productLineTitle"><?php echo $Name; ?></span><div class="lineTitleSpace">&nbsp;</div><span class="lineLine">Line</span><br />
            <span class="lineTagline">
                <?php echo $Tagline; ?>
            </span>
        </div>
        <div class="lineButtonsWrapper">
            <?php foreach ($res as $row) { ?>
            <a class="collectionButton" href="<?php echo $row['Url']; ?>" onClick="return false;"><?php echo $row["Name"]; ?></a>
            <?php } ?>	
        </div>
    </div>
</div>