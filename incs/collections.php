<?php
$query = "{call F_GetLines}";
$dbo->doQuery($query);
$lines = $dbo->loadObjectList();
if ($dbo->getRows() > 0) {
    foreach ($lines as $line) {
        $LID = $line["LID"];
        $Name = $line["Name"];
        $Tagline = $line["Tagline"];
        $CssClass = $line["CssClass"];
        $sql = "{CALL F_GetLineCollections (@LID=:LID)}";
        $param = array(":LID" => $LID);
        $dbo->doQueryParam($sql, $param);
        $res = $dbo->loadObjectList();
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
                    <?php foreach ($res as $row) { ?>
                        <a class="collectionButton" href="<?php echo $row['Url']; ?>" onClick="return false;"><?php echo $row["Name"]; ?></a>
                    <?php } ?>	
                </div>
            </div>
        </div>
        <?php
    }
}
?>