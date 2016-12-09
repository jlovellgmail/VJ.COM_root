<div class="bgWrapper productBgWrapper">
	<div class="contentWrapper shopItemsWrapper copyPanel">
		<a class="shopItem lg-four" href="/product.php">
			<img src="/img/product/canvas_black_backpack.png" alt="" />
			<span class="shopItemPrice">$2,500.00</span>
			<span class="shopItemTitle">Mens/Womens/Acc 1</span>
			<span class="shopItemSubtitle">Canvas Collection</span>
		</a><a class="shopItem lg-four" href="/product.php">
			<img src="/img/product/canvas_black_satchel.png" alt="" />
			<span class="shopItemPrice">$2,500.00</span>
			<span class="shopItemTitle">Mens/Womens/Acc 2</span>
			<span class="shopItemSubtitle">Canvas Collection</span>
		</a><a class="shopItem lg-four" href="/product.php">
			<img src="/img/product/canvas_black_weekender.png" alt="" />
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
		console.log('Mens images loaded.');
	});
</script>