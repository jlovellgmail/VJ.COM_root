<!doctype html>
<?php
$page = "collections";
include_once('/incs/conn.php');
include '/classes/Line.class.php';
?>

<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Virgil James Collections | Bags, Luxury Handbags & Authentic Handbags</title>
    <meta name="keywords" content="Handbags, bags, bag, Luxury bags, Authentic bags, Designer handbags, Leather bags, Canvas bags, Leather bags for men, Leather bags for women, Canvas bags for men, Canvas bags for women"/>
    <meta name="description" content="Discover our latest luxury bag collections in leather and canvas for men and women."/>

    <?php include '/incs/head-links.php'; ?>
    <link rel="stylesheet" href="/css/collections.css">
    
</head>
<body>
<div class="sdWrapper">
<div class="sdContent">

<?php include '/incs/nav.php'; ?>

    <!-- <div class="bgWrapperLeaf h100vh-landing"> -->
    <div class="bgWrapperLeaf" style='height: calc(100vh - 56px);'>
        <div class="landingLeafWrapper collectionsLeafWrapper">
            <!-- <div class='collectionShim' style='position: fixed; left: calc(50% - 1px); width: 1px; top: 0; height: 85px; background: linear-gradient(to bottom, rgba(150,150,150,1) 0px,rgba(150,150,150,1) 56px,rgba(255,255,255,1) 85px);'></div>
            <div class='collectionShim' style='position: absolute; left: calc(50% - 1px); width: 1px; bottom: 0; height: 85px; background: linear-gradient(to top, rgba(150,150,150,1) 0px,rgba(150,150,150,1) 56px,rgba(255,255,255,1) 85px);'></div> -->
            <div class="collectionWrapperLeft xs-twelve">
                <div class="collectionPanel classicPanel">
                    <div class="tableWrapper h100p" style='padding-top: 30px;'>
                        <div class="cellWrapper">
                            <div class='collection-title-span-wrapper rel block'><span class="heroText caps size4 fw-600 spaceLetters">Cityline </span><span class="heroText caps size4 fw-300 spaceLetters">Collections</span></div>
                                <div class='rel block marBottom15'><a class='rel borderBtn borderBtnGrey caps' style='min-width: 175px; padding: 0 20px;' href="http://www.virgiljames.net/collection/index.php?line=city&col=reykjavik">Reykjavik</a></div>
                                <div class='rel block marBottom15'><a class='rel borderBtn borderBtnGrey caps' style='min-width: 175px; padding: 0 20px;' href="http://www.virgiljames.net/collection/index.php?line=city&col=santa-fe">Santa Fe</a></div>
                                <div class='rel block marBottom15'><a class='rel borderBtn borderBtnGrey caps' style='min-width: 175px; padding: 0 20px;' href="http://www.virgiljames.net/collection/index.php?line=city&col=buenos-aires">Buenos Aires</a></div>
                        </div>
                    </div>
                    <!-- <div class="collectionButtonsWrapper">
                        <div class="tableWrapper h100p">
                            <div class="cellWrapper">
                                <a href="http://www.virgiljames.net/collection/index.php?line=city&col=reykjavik" class="borderBtn caps">Explore</a>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div><!-- <div class="collectionWrapperRight lg-six">
                <div class="collectionPanel cityPanel">
                    <div class="tableWrapper h100p">
                        <div class="cellWrapper">
                            <span class="heroText caps size4 fw-600 spaceLetters">Moderne </span><span class="heroText caps size4 fw-300 spaceLetters">Collections</span><br /><br />
                            <div class='rel block marBottom15'><a class='rel borderBtn borderBtnGrey caps' style='min-width: 175px; padding: 0 20px;' href="http://www.virgiljames.net/collection/index.php?line=classic&col=canvas">Classic Canvas</a></div>
                            <div class='rel block marBottom15'><a class='rel borderBtn borderBtnGrey caps' style='min-width: 175px; padding: 0 20px;' href="http://www.virgiljames.net/collection/index.php?line=classic&col=cashmere">Cashmere Felt</a></div>
                            <div class='rel block marBottom15'><a class='rel borderBtn borderBtnGrey caps' style='min-width: 175px; padding: 0 20px;' href="http://www.virgiljames.net/collection/index.php?line=classic&col=signature">Signature</a></div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>

    </div>
    <?php include '/incs/footer.php'; ?>

    <!-- Common .js Includes -->
    <?php include '/incs/footer-links.php'; ?>
</div>
</body>
</html>