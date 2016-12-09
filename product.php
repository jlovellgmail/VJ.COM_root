<!doctype html>
<?php
$seo_variable = "product";
$page = "home";
include_once('/incs/conn.php');
//include '/classes/Product.class.php';
$PID = $_GET["pid"];
$Product = new Product();
$Product->initialize($PID);
$showProduct = TRUE;
if ($Product->getVar("Hidden") || $Product->getVar("DelFlag")) {
    $showProduct = FALSE;
}
$ObjPID = $Product->getPID();
$ObjName = $Product->getProductName();
$Type = ltrim(rtrim($Product->getType()));
if (!isset($ObjPID) || $ObjPID == "" || $ObjName == "") {
    $showProduct = FALSE;
}
if (isset($_GET["from"]) && $_GET["from"] == "admin") {
    $showProduct = TRUE;
}

$TImgUrl = $Product->getVar("ThumbnailUrl");
$TImgUrl = str_replace('\\', '/', $TImgUrl);
if (!isset($_SESSION)) {
    session_start();
}

?>
<html class="no-js" lang="en" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title><?php echo $_GET["style"]; ?> | Virgil James</title>
		<meta name="description" content="<?php echo $Product->getVar("ShortDescription"); ?>"/>

        <?php include '/incs/head-links.php'; ?>
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="website" />       
        <meta property="og:title" content="<?php echo $_GET["style"]; ?> | Virgil James Product" />       
        <meta property="og:image" content="http://www.virgiljames.net<?php echo $TImgUrl; ?>">
        <meta property="og:site_name" content="Virgil James"/>
        <meta property="og:description" content="<?php echo $Product->getVar("ShortDescription"); ?>"/>
        <meta property="og:url" content="http://www.virgiljames.net/product.php?style=<?php echo $_GET["style"]; ?>&pid=<?php echo $PID; ?>"/>

        <link rel="stylesheet" href="/css/shop.css" />
        <link rel="stylesheet" href="/css/product.css" />
        <script src="/js/product.js" type="text/javascript"></script>

        <link rel="stylesheet" href="/js/owl/dev/dist/assets/owl.carousel.css" />
        <link rel="stylesheet" href="/css/owl/owl.theme.vj.product.css" />
        <link rel="stylesheet" href="/css/lightBox.css" />
        <script src="/js/owl/dev/dist/owl.carousel.js"></script>

    </head>
    <body>
        <?php

        if ($showProduct) {
            $pgallery = $Product->getProductGallery();
            if (isset($pgallery) && $pgallery->count() > 0) {
                include '/incs/productHighResGallery.php';
            }
        }

        ?>
        <div class="sdWrapper">
            <div class="sdContent">
                <?php include '/incs/nav.php';?>
                <?php include '/incs/product.php'; ?>
                <?php
                if ($showProduct) {
                    include '/incs/related-products.php';
                }
                ?>
            </div>
            <?php include '/incs/footer.php'; ?>
            <!-- Common .js Includes -->
            <?php include '/incs/footer-links.php'; ?>
        </div>
		<?php include('json-ld.php'); ?>
		<script type="application/ld+json"><?php echo json_encode($payload); ?></script>
    </body>
</html>