<?php
require_once 'include/productpage.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=8" />
	<meta name="description" content="<?=$metaDescription?>" />
	<meta name="keywords" content="<?=$metaKeywords?>" />
	<title><?=$title?> on <?=$_SERVER['SERVER_NAME']?></title>
  	<link id="ext_css" rel="stylesheet" type="text/css" href="css/zstore.css"/>
  	<link id="pp_css" rel="stylesheet" type="text/css" href="css/product.css"/>
</head>
<body>
<div class="mainShell">

	<!-- Main Store Link -->
	<?=$pp_mainStoreLink?>

	<!-- Breadcrumb Trail -->
	<?=$pp_breadCrumbTrail?>

	<!-- Product Title and Byline -->
	<div class="titleBar">
		<h1 class="h1Title"><?=$title?></h1>
	</div>

	<!-- Zoom Popup Link -->
	<div class="zoomPopupLink">
			<a href="javascript:zoomPopup(document.getElementById('mainImage').src.replace('_400.jpg','_600.jpg'));void 0;" rel="nofollow"><?=$viewLargerImage?></a>
	</div>

	<!-- Main Product Image and View Selectors -->
	<div class="ppLeft">
		<!-- Product Image -->
		<div class="productImageShell">
			<a href="<?=$link?>" rel="nofollow" <?=$analyticsLink?>><img src="<?=$imageSrc?>" class="productImage" alt="<?=$title?>" title="<?=$title?>" id="mainImage" /></a>
		</div>

		<!-- Product View Selectors -->
		<?=$pp_viewSelectors?>
	</div>

	<!-- Product Info (price, size, color, buy button, etc.) -->
	<div class="ppRight">
		<div class="productInfoShell clearfix">

			<!-- Price and Buy Button -->
			<div class="priceShell">
				<div class="buyButtonShell clearfix">
						<a class="buyNowButton" href="<?=$link?>" rel="nofollow">
							<div class="buyNowText"><?=$buyNow?></div>
						</a>
				</div>
				<div class="ppPrice"><strong>Price:</strong> <span class="ppUnitPrice">$<?=$price?></span></div>
			</div>

			<!-- Styles -->
			<?php if (!empty($style)) {?>
			<div class="styleShell">
				<strong><?=$styleLabel?>:</strong> <?=ucwords(str_replace("_"," ",$style))?> <span class="moreLink">(<a rel="nofollow" href="<?=$link?>" <?=$analyticsLink?>><?=$chooseMoreStyles?></a>)</span>
			</div>
			<?php } ?>

			<!-- Colors -->
			<?php if (!empty($color)) {?>
			<div class="colorShell">
				<strong><?=$colorLabel?>:</strong> <?=ucwords(str_replace("_"," ",$color))?> <span class="moreLink">(<a rel="nofollow" href="<?=$link?>" <?=$analyticsLink?>><?=$chooseMoreColors?></a>)</span>
			</div>
			<?php } ?>

			<!-- Sizes -->
			<?php if (!empty($sizes)) {?>
			<div class="sizeShell">
				<strong><?=$sizeLabel?>:</strong> <span class="moreLink">(<a rel="nofollow" href="<?=$link?>" <?=$analyticsLink?>><?=$chooseMoreSizes?></a>)</span>
			</div>
			<?php } ?>

			<!-- Creation Date and Product ID -->
			<div class="smallInfo">

				<!-- Creation Date -->
				<div class="dateShell">
					<?=ucwords($productType)?> <?=$created?> <?=$by?> <a rel="nofollow" href="<?=$galleryUrl?>" <?=$analyticsLink?> title="<? printf($artistStoreTitle,$artist);?>"><?=$artist?></a> <?=$pubDate?>
				</div>

				<!-- Product ID -->
				<div class="idShell"><?=$productIdLabel?>: <a href="<?=$link?>" <?=$analyticsLink?> rel="nofollow"><?=$productId?></a></div>

			</div>
		</div>

		
		<!-- Recommendations -->
		<?=$recommendations?>
		
		<div class="clearBoth"></div>
				
		
		<!-- Embed Code Text Field -->
		<?=$pp_embedCode?>
		

	</div>

	<div class="clearBoth"></div>

	<div class="descriptionShell"><?=$description?></div>

	<!-- Twitter Stream -->
	<?=$pp_twitterStream?>

	<div id="dialogMask"></div>
	<div id="zoomPopup">
		<div class="dialogHeader">
			<a href="javascript:showZoom();void 0;"><?=$closeLink?></a><?=$title?>
		</div>
		<div id="zoomImg" onclick="showZoom();void 0;"></div>
	</div>

	<script type="text/javascript">//<![CDATA[
	// Google analytics tracking
	var useAnalytics = <?php echo $useAnalytics?>;
	if (useAnalytics) {
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	}
	//]]></script>
	<script type="text/javascript">//<![CDATA[
	// Google analytics page tracking
	var useAnalytics = <?php echo $useAnalytics?>;
	if (useAnalytics) {
		var pageTracker = _gat._getTracker("<?php echo $analyticsId?>");
		pageTracker._setDomainName("none");
		pageTracker._setAllowLinker(true);
		pageTracker._trackPageview();
	}
	//]]></script>

	<script type="text/javascript">//<![CDATA[
	function zoomPopup (imgSrc) {
		if (imgSrc.indexOf('?')!=-1) {
			showZoom(imgSrc);
		} else {
			showZoom(imgSrc);
		}
	}
	function showZoom(imgSrc) {
		if (document.getElementById('zoomPopup').style.display != "block") {
			document.getElementById('zoomImg').style.backgroundImage = 'url(\''+imgSrc+'\')';
			document.getElementById('zoomPopup').style.display = "block";
			document.getElementById('dialogMask').style.display = "block";
		} else {
			document.getElementById('zoomPopup').style.display = "none";
			document.getElementById('dialogMask').style.display = "none";
		}
	}
	//]]></script>
</div>
</body>
</html>