<!doctype html>
<?php 
$page = "home"; 
$seo_variable = "home";
?>
<html class="no-js" lang="en">
<head>
    <?php include '/incs/head-links.php'; ?>
	<link rel="stylesheet" href="/css/index.css" />
	<link rel="stylesheet" href="../css/preorder.css" />
</head>
<body class="body">
    


	<?php include 'nav.php'; ?>
	<div class="page collectionPage">
		<div class="widthWrapper">

		<?php
			include "set_document_root.php";
		?>
		<?php
			echo "yes";
			echo "<br>";
			$doc_root  = ($_SERVER["DOCUMENT_ROOT"]);
			echo "\$doc_root:  " . $doc_root;
			echo "<br>";
			echo "__DIR__:  " . __DIR__;
			echo "<br>";
			echo ($_SERVER['DOCUMENT_URI']);
			echo "<br>";

			//define( 'SCRIPT_ROOT', 'http://localhost/yourApplication' );
			define( 'SCRIPT_ROOT', '/preorder/site2' );
			echo "<a href='/" . SCRIPT_ROOT . "/reykjavik_drawstring.php'>here</a>";
			echo "<br>";

		?>
		<?php 
		   $path = $_SERVER['DOCUMENT_ROOT'];
		   $path .= "/preorder/site2";
		   include_once($path);
		?>

			<!-- <base href="http://virgiljames.net/preorder/site2/"> -->

			<div class="breadcrumb">
				<a class="first" href="#">Home</a>
				<a href="preorder/site2/collections.php">Collections</a>
				<a href="preorder/site2/collection_reykjavik.php">Reykjavik Collection</a>
				<div class="hline"></div>
			</div>



			<div class="topRow">
				<div class="headline">
					<div class="part1">Reykjavik</div><div class="part2">Collection</div>
				</div>
				<div class="text">
					Reykjavik is about beauty and raw strength. Its volcanic origin belies a region still in formation. This city exhibits a resolve to honor the past and embrace the future. Our selection of materials and original bronze designs are inspired by the unique independence of this remarkable city.
				</div>
			</div>


			<div class="productsGrid">
				<div class="row first">

					
					<!--
					<a class="item" href="preorder/site2/reykjavik_drawstring.php">
					-->
					<a class="item" href="reykjavik_drawstring.php">


						<img src="../images/thumbnail_reykjavik_drawstring.jpg" />
						<div class="caption">
							<div class="title">Drawstring</div>
							<div class="price">$1,695</div>
						</div>
					</a>
					<div class="item">
						<img src="../images/thumbnail_reykjavik_clutch.jpg" />
						<div class="caption">
							<div class="title">Clutch</div>
							<div class="price">$995</div>
						</div>
					</div>
					<div class="item">
						<img src="../images/thumbnail_reykjavik_overnight.jpg" />
						<div class="caption">
							<div class="title">Overnight</div>
							<div class="price">$2,295</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="item">
						<img src="../images/thumbnail_reykjavik_satchel.jpg" />
						<div class="caption">
							<div class="title">Satchel</div>
							<div class="price">$2,295</div>
						</div>
					</div>
					<div class="item">
						<img src="../images/thumbnail_reykjavik_weekender.jpg" />
						<div class="caption">
							<div class="title">Weekender</div>
							<div class="price">$3,095</div>
						</div>
					</div>
					<div class="item">
						<img src="../images/thumbnail_reykjavik_backpack.jpg" />
						<div class="caption">
							<div class="title">Backpack</div>
							<div class="price">$2,395</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="item">
						<img src="../images/thumbnail_reykjavik_weekender.jpg" />
						<div class="caption">
							<div class="title">Weekender</div>
							<div class="price">$3,095</div>
						</div>
					</div>
					<div class="item">
						<img src="../images/thumbnail_reykjavik_backpack.jpg" />
						<div class="caption">
							<div class="title">Backpack</div>
							<div class="price">$2,395</div>
						</div>
					</div>
					<div class="item">
					</div>
				</div>
			</div>



		</div>
	</div>
    <?php include '/incs/footer.php'; ?>




</body>
</html>

