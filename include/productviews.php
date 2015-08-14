<?php 

// This file contains the different views shown on the product page for each product type.

$pp_viewSelectors = "";
if ($productType=="calendar") {
	$coverView = $viewSelectorImgSrc."?view=cover";
	$page0View = $viewSelectorImgSrc."?view=page_0";
	$page1View = $viewSelectorImgSrc."?view=page_1";
	$page2View = $viewSelectorImgSrc."?view=page_2";
	$page3View = $viewSelectorImgSrc."?view=page_3";
	$page4View = $viewSelectorImgSrc."?view=page_4";
	$page5View = $viewSelectorImgSrc."?view=page_5";
	$page6View = $viewSelectorImgSrc."?view=page_6";
	$page7View = $viewSelectorImgSrc."?view=page_7";
	$page8View = $viewSelectorImgSrc."?view=page_8";
	$page9View = $viewSelectorImgSrc."?view=page_9";
	$page10View = $viewSelectorImgSrc."?view=page_10";
	$page11View = $viewSelectorImgSrc."?view=page_11";
	$backView = $viewSelectorImgSrc."?view=back";
	$pp_viewSelectors = <<<EOD
	<div class="viewSelectors">
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=cover';void 0;"><img src="$coverView" alt="Front" title="Front" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=page_0';void 0;"><img src="$page0View" alt="Page 1" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=page_1';void 0;"><img src="$page1View" alt="Page 2" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=page_2';void 0;"><img src="$page2View" alt="Page 3" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=page_3';void 0;"><img src="$page3View" alt="Page 4" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=page_4';void 0;"><img src="$page4View" alt="Page 5" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=page_5';void 0;"><img src="$page5View" alt="Page 6" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=page_6';void 0;"><img src="$page6View" alt="Page 7" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=page_7';void 0;"><img src="$page7View" alt="Page 8" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=page_8';void 0;"><img src="$page8View" alt="Page 9" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=page_9';void 0;"><img src="$page9View" alt="Page 10" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=page_10';void 0;"><img src="$page10View" alt="Page 11" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=page_11';void 0;"><img src="$page11View" alt="Page 12" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=back';void 0;"><img src="$backView" alt="Back" title="Back" width="80" height="80" /></a>
	</div>
EOD;
}

if ($productType=="card") {
	$frontView = $viewSelectorImgSrc."?view=front";
	$inside1View = $viewSelectorImgSrc."?view=inside1";
	$inside2View = $viewSelectorImgSrc."?view=inside2";
	$backView = $viewSelectorImgSrc."?view=back";
	$pp_viewSelectors = <<<EOD
	<div class="viewSelectors">
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=front';void 0;"><img src="$frontView" alt="Front" title="Front" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=inside1';void 0;"><img src="$inside1View" alt="Inside Left" title="Inside Left" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=inside2';void 0;"><img src="$inside2View" alt="Inside Right" title="Inside Right" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=back';void 0;"><img src="$backView" alt="Back" title="Back" width="80" height="80" /></a>
	</div>
EOD;
}

if ($productType=="embroideredhat") {
	$frontView = $viewSelectorImgSrc."?view=angle0";
	$leftView = $viewSelectorImgSrc."?view=angle90";
	$rightView = $viewSelectorImgSrc."?view=angle270";
	$backView = $viewSelectorImgSrc."?view=angle180";
	$pp_viewSelectors = <<<EOD
	<div class="viewSelectors">
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=angle0';void 0;"><img src="$frontView" alt="Front" title="Front" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=angle90';void 0;"><img src="$leftView" alt="Left"  title="Left" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=angle270';void 0;"><img src="$rightView" alt="Right" title="Right" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=angle180';void 0;"><img src="$backView" alt="Back" title="Back" width="80" height="80" /></a>
	</div>
EOD;
}

if ($productType=="embroideredshirt") {
	$frontView = $viewSelectorImgSrc."?view=angle0";
	$backView = $viewSelectorImgSrc."?view=angle180";
	$pp_viewSelectors = <<<EOD
	<div class="viewSelectors">
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=angle0';void 0;"><img src="$frontView" alt="Front" title="Front" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=angle180';void 0;"><img src="$backView" alt="Back" title="Back" width="80" height="80" /></a>
	</div>
EOD;
}

if ($productType=="envelope") {
	$frontView = $viewSelectorImgSrc."?view=angle0";
	$backView = $viewSelectorImgSrc."?view=angle180";
	$backView2 = $viewSelectorImgSrc."?view=angle180_2";
	$pp_viewSelectors = <<<EOD
	<div class="viewSelectors">
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=angle0';void 0;"><img src="$frontView" alt="Front" title="Front" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=angle180';void 0;"><img src="$backView" alt="Back (top flap)" title="Back (top flap)" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=angle180_2';void 0;"><img src="$backView2" alt="Back (bottom)" title="Back (bottom)" width="80" height="80" /></a>
	</div>
EOD;
}


if ($productType=="kedsshoe") {
	$topView = $viewSelectorImgSrc."?view=top";
	$outsideView = $viewSelectorImgSrc."?view=outside";
	$outsideFrontView = $viewSelectorImgSrc."?view=outsidefront";
	$frontView = $viewSelectorImgSrc."?view=front";
	$insideFrontView = $viewSelectorImgSrc."?view=insidefront";
	$insideView = $viewSelectorImgSrc."?view=inside";
	$backView = $viewSelectorImgSrc."?view=back";
	$pp_viewSelectors = <<<EOD
	<div class="viewSelectors">
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=top';void 0;"><img src="$topView" alt="Upper" title="Upper" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=outside';void 0;"><img src="$outsideView" alt="Outside Quarter" title="Outside Quarter" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=outsidefront';void 0;"><img src="$outsideFrontView" alt="Outside Front" title="Outside Front" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=front';void 0;"><img src="$frontView" alt="Tongue" title="Tongue" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=insidefront';void 0;"><img src="$insideFrontView" alt="Inside Front" title="Inside Front" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=inside';void 0;"><img src="$insideView" alt="Inside Quarter" title="Inside Quarter" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=back';void 0;"><img src="$backView" alt="Heel" title="Heel" width="80" height="80" /></a>
	</div>
EOD;
}

if ($productType=="mug") {
	$leftView = $viewSelectorImgSrc."?lon=270";
	$centerView = $viewSelectorImgSrc."?lon=0";
	$rightView = $viewSelectorImgSrc."?lon=90";
	$pp_viewSelectors = <<<EOD
	<div class="viewSelectors">
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?lon=270';void 0;"><img src="$leftView" alt="Left"  title="Left" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?lon=0';void 0;"><img src="$centerView" alt="Center" title="Center" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?lon=90';void 0;"><img src="$rightView" alt="Right" title="Right" width="80" height="80" /></a>
	</div>
EOD;
}

if ($productType=="ornament") {
	$frontView = $viewSelectorImgSrc."?view=angle0";
	$backView = $viewSelectorImgSrc."?view=angle180";
	$sideView = $viewSelectorImgSrc."?view=angle45";
	if (substr($style,0,2)!="pj") {
		$nonPjView = "<a rel=\"nofollow\" href=\"javascript:document.getElementById('mainImage').src='$imageUrl?view=angle180';void 0;\"><img src=\"$backView\" alt=\"Back\" title=\"Back\" width=\"80\" height=\"80\" /></a>";
	}
	$pp_viewSelectors = <<<EOD
	<div class="viewSelectors">
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=angle0';void 0;"><img src="$frontView" alt="Front" title="Front" width="80" height="80" /></a>
		$nonPjView
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=angle45';void 0;"><img src="$sideView" alt="Side" title="Side" width="80" height="80" /></a>
	</div>
EOD;
}

if ($productType=="binder") {
	$backgroundView = $viewSelectorImgSrc."?view=angle0_outside_full";
	$frontInsideView = $viewSelectorImgSrc."?view=angle45_outside_front";
	$frontView = $viewSelectorImgSrc."?view=angle0_outside_front";
	$backView = $viewSelectorImgSrc."?view=angle0_outside_back";
	$spineView = $viewSelectorImgSrc."?view=angle0_outside_spine";
	$frontSpineView = $viewSelectorImgSrc."?view=angle45_outside_spinefront";
	$backSpineView = $viewSelectorImgSrc."?view=angle45_outside_spineback";
	
	$pp_viewSelectors = <<<EOD
	<div class="viewSelectors">
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=angle0_outside_full';void 0;"><img src="$backgroundView" alt="Background" title="Background" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=angle45_outside_front';void 0;"><img src="$frontInsideView" alt="Front/Inside" title="Front/Inside" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=angle0_outside_front';void 0;"><img src="$frontView" alt="Front" title="Front" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=angle0_outside_back';void 0;"><img src="$backView" alt="Back" title="Back" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=angle0_outside_spine';void 0;"><img src="$spineView" alt="Spine" title="Spine" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=angle45_outside_spinefront';void 0;"><img src="$frontSpineView" alt="Front/Spine" title="Front/Spine" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=angle45_outside_spineback';void 0;"><img src="$backSpineView" alt="Back/Spine" title="Back/Spine" width="80" height="80" /></a>
	</div>
EOD;
}


if ($productType=="shirt" || $productType=="postcard" || $productType=="profilecard" || $productType=="invitation" || $productType=="flyer" || $productType=="rackcard") {
	$frontView = $viewSelectorImgSrc."?view=front";
	$backView = $viewSelectorImgSrc."?view=back";
	$pp_viewSelectors = <<<EOD
	<div class="viewSelectors">
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=front';void 0;"><img src="$frontView" alt="Front" title="Front" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=back';void 0;"><img src="$backView" alt="Back" title="Back" width="80" height="80" /></a>
	</div>
EOD;
}

if ($productType=="petshirt") {
	$backView = $viewSelectorImgSrc."?view=back";
	$sideView = $viewSelectorImgSrc."?view=side";
	$pp_viewSelectors = <<<EOD
	<div class="viewSelectors">
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=back';void 0;"><img src="$backView" alt="Back" title="Back" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=side';void 0;"><img src="$sideView" alt="Side" title="Side" width="80" height="80" /></a>
	</div>
EOD;
}

if ($productType=="skateboard") {
	$horzView = $viewSelectorImgSrc."?view=horz";
	$vertView = $viewSelectorImgSrc."?view=vert";
	$angleView = $viewSelectorImgSrc."?view=34";
	$pp_viewSelectors = <<<EOD
	<div class="viewSelectors">
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=horz';void 0;"><img src="$horzView" alt="Horizontal" title="Horizontal" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=vert';void 0;"><img src="$vertView" alt="Vertical" title="Vertical" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=34';void 0;"><img src="$angleView" alt="3/4" title="3/4" width="80" height="80" /></a>
	</div>
EOD;
}

if ($productType=="speckcase") {
	$backView = $viewSelectorImgSrc."?view=angle0_0_90";
	$backLeftView = $viewSelectorImgSrc."?view=angle0_0_135";
	$backRightView = $viewSelectorImgSrc."?view=angle0_0_45";
	$bottomView = $viewSelectorImgSrc."?view=angle45_50_15";
	$topView = $viewSelectorImgSrc."?view=angle315_50_15";
	$backHorizontalView = $viewSelectorImgSrc."?view=angle90_0_0";
	
	$pp_viewSelectors = <<<EOD
	<div class="viewSelectors">
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=angle0_0_90';void 0;"><img src="$backView" alt="Back" title="Back" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=angle0_0_135';void 0;"><img src="$backLeftView" alt="Back Left" title="Back Left" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=angle0_0_45';void 0;"><img src="$backRightView" alt="Back Right" title="Back Right" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=angle45_50_15';void 0;"><img src="$bottomView" alt="Bottom" title="Bottom" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=angle315_50_15';void 0;"><img src="$topView" alt="Top" title="Top" width="80" height="80" /></a>
		<a rel="nofollow" href="javascript:document.getElementById('mainImage').src='$imageUrl?view=angle90_0_0';void 0;"><img src="$backHorizontalView" alt="Back Horizontal" title="Back Horizontal" width="80" height="80" /></a>
		
	</div>
EOD;
}

?>