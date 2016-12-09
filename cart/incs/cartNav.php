<?php 
switch ($page){
    case "checkout":
        $navItems=1;
        break;
    case "cartShipping":
        $navItems=2;
        break;
    case "cartBilling":
        $navItems=3;
        break;
    case "cartSummary":
        $navItems=4;
        break;
    case "cartReceipit":
        $navItems=5;
        break;
    default :
        $navItems=0;
      
}
?>

<!--
<div class="closeCartButton"><a href="javascript:cartClose();"> <i class="icon-cancel-1"></i></a></div>
-->

<div class="row">
    <div class="sm-twelve marBottom30 ">
        <nav class="stepByNav">
            <ul>
                <li <?php echo ($page=="checkout" ? "class='active' ": ""); ?> >
                	<a<?php if ($navItems>0){?> href="/cart/"<?php }?>>
                    	<span class="step">Step</span> <span class="numeral">1</span> 
                        <br />
                    	<span class="stepLabel">Shopping Cart Summary</span>
                    </a>
                </li>
                <li <?php echo ($page=="cartShipping" ? "class='active' ": ""); ?> >
                    <a<?php if ($navItems>1){?> href="shipping.php"<?php }?>>
                        <span class="step">Step</span> <span class="numeral">2</span> 
                        <br />
                        <span class="stepLabel">Shipping Information</span>
                    </a>
                </li>
                <li <?php echo ($page=="cartBilling" ? "class='active' ": ""); ?> >
                	<a<?php if ($navItems>2){?> href="billing.php"<?php }?>>
                        <span class="step">Step</span> <span class="numeral">3</span> 
                        <br />
                        <span class="stepLabel">Payment Information</span>
                    </a>
                </li>
                <li <?php echo ($page=="cartSummary" ? " class='flatRightBefore active' ": " class='flatRightBefore'"); ?> >
                	<a>
                	    <span class="step">Step</span> <span class="numeral">4</span> 
                	    <br />
                        <span class="stepLabel">Order Summary</span>
                    </a>
                </li>
                <li <?php echo ($page=="cartReceipt" ? " class='flatRight active' ": " class='flatRight' "); ?> >
                	<a>
                        <span class="step">Step</span> <span class="numeral">5</span> 
                        <br />
                        <span class="stepLabel">Order Receipt</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>