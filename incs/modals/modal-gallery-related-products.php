<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
$rootpath = $_SERVER['DOCUMENT_ROOT'];
include_once($rootpath . '/incs/conn.php');
include $rootpath . '/classes/ProductList.class.php';
include $rootpath . '/classes/LifestyleGallery.class.php';

$LGID = $_GET['LGID'];
$LifestyleGallery = new LifestyleGallery();
$LifestyleGallery->initialize($LGID);
$ProductList = new ProductList();

$list = $LifestyleGallery->getRelatedProducts();
$products = $ProductList->getAllProductsAdmin();
?>

<div class='modal-wrapper-lifestyle-gallery'>
    <!-- <h2 class="modalTitle caps fw-700 size6">WHAT WE CALL DIS</h6> -->
    <div class='row textLeft generalForm'>
        <form class='img-grid-prod-select-form'>
            <h2 class='marBottom15'>Select Related Products</h2>
            <?php
            foreach ($products as $product) {
                $PID = $product->getVar("PID");
                $Name = $product->getName();
                $hidden = '';
                if ($product->getVar('Hidden') == '1') {
                    $hidden = ' (Hidden)';
                }
                $checked = '';
                foreach ($list as $relatedProduct) {
                    if ($PID == $relatedProduct->getVar('PID')) {
                        $checked = 'checked';
                    }
                }
                ?><!--
                --><label for='' class='xs-twelve'><input <?php echo $checked; ?> type="checkbox" id='chk_<?php echo $PID; ?>' name="" value="" /><?php echo $Name . $hidden; ?></label><!-- 
                --><?php }
            ?>
            <button type="button" onclick="updateRelatedProducts('<?php echo $LGID; ?>')" class="admin-add-button marTop15">Update</button>
        </form>
    </div>
</div>