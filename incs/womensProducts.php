<div class="bgWrapper productBgWrapper">
	<div class="contentWrapper shopItemsWrapper copyPanel">
		<a class="shopItem lg-four" href="/product.php">
			<img src="/img/product/canvas_black_overnight.png" alt="" />
			<span class="shopItemPrice">$2,500.00</span>
			<span class="shopItemTitle">Mens/Womens/Acc 1</span>
			<span class="shopItemSubtitle">Canvas Collection</span>
		</a><a class="shopItem lg-four" href="/product.php">
			<img src="/img/product/canvas_black_tote.png" alt="" />
			<span class="shopItemPrice">$2,500.00</span>
			<span class="shopItemTitle">Mens/Womens/Acc 2</span>
			<span class="shopItemSubtitle">Canvas Collection</span>
		</a><a class="shopItem lg-four" href="/product.php">
			<img src="/img/product/felt_blue_overnight.png" alt="" />
			<span class="shopItemPrice">$2,500.00</span>
			<span class="shopItemTitle">Mens/Womens/Acc 3</span>
			<span class="shopItemSubtitle">Canvas Collection</span>
		</a>
	</div>
</div>

<script>
	$('.shopItemsWrapper').imagesLoaded( function() {
		// Fade in the Product images here
		$('.shopItemsWrapper').fadeTo(1000, 1);
		console.log('Womens images loaded.');
	});
</script>