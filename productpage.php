<?php

/*
  Zazzle Store Builder 1.5 Product Page
*/

// To customize the look and layout of the product page, edit "product.php" located in the default installation folder.
// Please see the README.txt file included in this distribution for more information

require_once 'include/cacheMgr.php';
require_once 'include/lastRSS.php';
require_once 'include/lastRSS.php';
require_once 'include/strings.php';
require_once 'include/configuration.php';

if(isset($useAnalytics) && $useAnalytics != 1 && $useAnalytics != 'true') $useAnalytics = 'false';
if(isset($useAnalytics) && $useAnalytics == 'true') $useAnalytics = 'true';

// generate the analytics link if we are using google analytics
if ( $useAnalytics=="true") {
	$analyticsLink = "onclick=\"pageTracker._link(this.href); return false;\"";
} else {
    $analyticsLink = "";
}

function writeToCache($externalUrl,$localFilename){
		$ch = curl_init(rawurldecode($externalUrl));
		$fh = fopen("c/" . $localFilename, "w");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_HEADER, 0);
		$fdata = curl_exec($ch);
		fwrite($fh, $fdata);
		curl_close( $ch);
		fclose($fh);
}
function curPageURL() {
		$isHTTPS = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on");
		$port = (isset($_SERVER["SERVER_PORT"]) && ((!$isHTTPS && $_SERVER["SERVER_PORT"] != "80") || ($isHTTPS && $_SERVER["SERVER_PORT"] != "443")));
		$port = ($port) ? ':'.$_SERVER["SERVER_PORT"] : '';
		$url = ($isHTTPS ? 'https://' : 'http://').$_SERVER["SERVER_NAME"].$port.$_SERVER["REQUEST_URI"];
		return $url;
}
$curPageURL = curPageURL();

// Process input variables
$productId = isset($_GET['pid']) ? $_GET['pid'] : "";
$associateId = isset($_GET['rf']) ? $_GET['rf'] : $associateId;
// Get product data
$rss = new lastRSS;
$cache = null;
if($useCaching == true) {
	$rss->cache_dir = 'c';
	$rss->cache_time = $cacheLifetime;
	// create a cache manager object for image caching
	$cache = new cacheMgr;
	$cache->set_lifetime($cacheLifetime);
}
$rss->CDATA = 'content';
$rss->items_limit = 0;

if ($rs = $rss->get('http://feed.'.$zazzleURLBase.'/feed?st=popularity&at='.$associateId.'&isz=400&bg='.$gridCellBgColor.'&pg=1&src=zstore&ps=1&ft=gb&opensearch=true&qs='.str_replace(" ",",",$productId)) ) {
		foreach( $rs as $feedkey=>$feedval ) {
			if ( $feedkey=="items" ) {
				$productType = isset($feedval[0]['g:product_type']) ? htmlentities(str_replace("\"","",$feedval[0]['g:product_type'])) : "";
				$title = urldecode( $feedval[0]['title']);
				$title = str_replace("<![CDATA[", '', $title);
				$title = str_replace("]]>", '', $title);

				if (strpos(strtolower($title),$productType)===false) {
				    $urlTitle = str_replace("bumper sticker","",$title);
				    $urlTitle = str_replace("Bumper Sticker","",$urlTitle);
				    $urlTitle = str_replace("bumper Sticker","",$urlTitle);
				    $urlTitle = str_replace("Bumper sticker","",$urlTitle);
					$title = $urlTitle." ".ucwords($productType);
				}

				$description = isset($feedval[0]['description']) ? urldecode($feedval[0]['description']) : "";
				$description = str_replace("<![CDATA[", '', $description);
				$description = str_replace("]]>", '', $description);
				$imageUrl = isset($feedval[0]['g:image_link']) ? $feedval[0]['g:image_link'] : "";

				if($useCaching == true) {
					$imageUrl = preg_replace( '/amp;/','', $imageUrl);  // un-escape the ampersands
					$imageSrc = ''; // we'll use this to set the image's initial src url

					// build our product image url
					$productImageUrl = $imageUrl;
					$productFile = str_replace("http://rlv.zcache.com/","",$imageUrl);
					$viewSelectorImgSrc = str_replace("_400.jpg","_80.jpg",$imageUrl);


					// do we have this product's images already in the cache?
					if($cache->is_image_cached( 'c/'. $productFile)) {   // yes - override image url with local url
						$productImageUrl = 'c/'. $productFile;
					} else {  // no - go get the image from the server and cache

						// get product image - this will fail if your version of php is not curl-enabled
						writeToCache($productImageUrl,$productFile);
						// override the remote url with the cached versions so we point at the local copies
						$productImageUrl =  "c/$productFile";
					}
					$imageSrc = $productImageUrl;
					
				} else { // no - we are not using caching
					$imageSrc = $imageUrl;
					$viewSelectorImgSrc = str_replace("_400.jpg","_80.jpg",$imageSrc);
				}
				
				$price = isset($feedval[0]['g:price']) ? $feedval[0]['g:price'] : "";
				$pubDate = isset($feedval[0]['pubDate']) ? $feedval[0]['pubDate'] : "";
				$pubDate =  "(".date("F j, Y, g:i a", strtotime($pubDate)).")";
				$artist = isset($feedval[0]['artist']) ? $feedval[0]['artist'] : "";
				$sizes = isset($feedval[0]['g:size']) ? htmlentities(str_replace("\"","",$feedval[0]['g:size'])) : "";
				$color = isset($feedval[0]['g:color']) ? htmlentities(str_replace("\"","",$feedval[0]['g:color'])) : "";
				$style = isset($feedval[0]['g:style']) ? htmlentities(str_replace("\"","",$feedval[0]['g:style'])) : "";
				$tags = isset ($feedval[0]['c:keywords']) ? htmlentities(str_replace("\"","",$feedval[0]['c:keywords'])) : "";
				$link = $feedval[0]['link']."&amp;gl=".$artist;
				$link = str_replace( "&amp;ZCMP=gbase", "", $link);
				$galleryUrl = "http://www.".$zazzleURLBase."/".$artist."?rf=".$associateId."&amp;CMPN=zstore&amp;zbar=1";
				$productTypeUrl = $productTypeLinkToArtist ? "http://www.".$zazzleURLBase."/".$artist."/".$productType."?rf=".$associateId."&amp;CMPN=zstore&amp;zbar=1" : "http://www.".$zazzleURLBase."/".$productType."?rf=".$associateId."&amp;CMPN=zstore&amp;zbar=1";;
				$breadcrumbHome = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "";
				
				// The following line loads up the product views file, which adds the small product view icons under the main product image
				require_once 'include/productviews.php';
			}
		}
}


// PRODUCT RECOMMENDATIONS
if ($showRecommendations) {
	$tagRecs = explode(",",$tags);
	
	// Get product data
	$recRss = new lastRSS;
	$recRss->CDATA = 'content';
	$recRss->items_limit = 0;
	$randomTag = rand(0,count($tagRecs)-1);
	$queryString = str_replace(" ",",",trim($tagRecs[$randomTag]));
	$recommendations = "<div id=\"productRecommendationsShell\">$recommendationsTitle (".str_replace(",","+",$queryString).")<div id=\"productRecommendationsCenter\">";
	if ($recRs = $recRss->get('http://feed.'.$zazzleURLBase.'/feed?st=popularity&at='.$associateId.'&isz=98&bg='.$gridCellBgColor.'&pg=1&src=zstore&ps='.$numRecs.'&ft=gb&opensearch=true&qs='.$queryString)) {
		foreach( $recRs as $recFeedkey=>$recFeedval ) {
			if ( $recFeedkey=="items" ) {
				foreach ($recFeedval as $thisrec) {
					if ($thisrec['g:id']!=$productId){
						$recSpecificProductType = htmlentities(str_replace("\"","",$thisrec['g:product_type']));
						$recProductId = $thisrec['g:id'];
						$recTitle = urldecode($thisrec['title']);
						$recTitle = preg_replace( "/<[^>]+>/", '', $recTitle);
						$recUrlTitle = str_replace('...', '_', $recTitle);
						$recUrlTitle = str_replace(array('!', '\'', '.', ',', ';', ':', '"', '&quot', '?', '_', '(', ')', '`', '~', '@', '#', '$', '^', '&', '*', '+', '=', '[', ']', '{', '}', '|', '<', '>'), '', $recTitle);
						$recUrlTitle = str_replace(" ","_",$recUrlTitle);
						$recUrlTitle = str_replace("___","_",$recUrlTitle);
						$recUrlTitle = str_replace("__","_",$recUrlTitle);
						$recUrlTitle = strtolower($recUrlTitle);
						$recUrlTitle = str_replace("_bumper_sticker","",$recUrlTitle);
						$recUrlTitle = strtolower($recUrlTitle);
	
						if (strpos(strtolower($recTitle),$recSpecificProductType)===false) {
							$recSpecificProductType = $recSpecificProductType == "bumpersticker" ? "bumper_sticker" : $recSpecificProductType;
							$recUrlTitle = $recUrlTitle."_".$recSpecificProductType;
						} else {
							$recUrlTitle = $recUrlTitle;
						}
						$recLink = "product.php?title=".$recUrlTitle."&amp;pid=".$recProductId."&amp;rf=".$associateId;
						if ($useFriendlyUrls) {
							$recUrlTitle = str_replace("/", '_', $recUrlTitle);
							$recUrlTitle = str_replace("-", '_', $recUrlTitle);
							$recUrlTitle = str_replace("___","_",$recUrlTitle);
							$recUrlTitle = str_replace("__","_",$recUrlTitle);
							$recLink = $recUrlTitle."-".$recProductId.".html";
						}
						$recommendations .= "<a href=\"".$recLink."\"><img src=\"".$thisrec['g:image_link']."\" alt=\"".$thisrec['title']."\" title=\"".$thisrec['title']."\" class=\"relatedProduct\"/></a>";
					}
				}
			}
		}
	}
	$recommendations .="</div></div>";
}


$metaDescription = sprintf($metaDescription, $productType);

// Main Store Link
if (!empty($mainStoreLink) && !empty($mainStoreLinkText)) {
	$pp_mainStoreLink = <<<EOD
	<div class="storeLink">
		<a href="$mainStoreLink">$mainStoreLinkText</a>
	</div>
EOD;
}

// Breadcrumb Trail
$pp_breadCrumbTrail = "<div class=\"breadcrumbShell\">";
if (!empty($breadcrumbHome)) {
	$pp_breadCrumbTrail .= "<a rel=\"nofollow\" href=\"$breadcrumbHome\" title=\"".sprintf($breadcrumbHomeTitle,$breadcrumbHome)."\">".$goBack."</a>&nbsp;<span class=\"breadcrumbSeparator\">".$breadcrumbSeparator."</span>&nbsp;";
}
$pp_breadCrumbTrail .= "<a rel=\"nofollow\" href=\"$galleryUrl\" $analyticsLink title=\"".sprintf($artistStoreTitle,$artist)."\">".$artist."</a>&nbsp;<span class=\"breadcrumbSeparator\">".$breadcrumbSeparator."</span>&nbsp;";
if ($productTypeLinkToArtist) {
	$productTypeSearchDestination = sprintf($tagArtist,$artist);
} else {
	$productTypeSearchDestination = $tagMarketplace;
}
$pp_breadCrumbTrail .= "<a rel=\"nofollow\" href=\"".$productTypeUrl."\" ".$analyticsLink."title=\"".sprintf($productTypeTitle,$productType, $productTypeSearchDestination)."\">".$productType."s</a>&nbsp;";
$pp_breadCrumbTrail .= "<span class=\"breadcrumbSeparator\">".$breadcrumbSeparator."</span>";
$pp_breadCrumbTrail .="</div>";


// Embed Code Textbox
if ($showEmbedCode) {
	$pp_embedCode = "<div class=\"embedCode\">";
	$storeInfo = !empty($embedCodeStoreUrl) && !empty($embedCodeText) ? "<br/><a href=\"".$embedCodeStoreUrl."\">".sprintf($embedCodeText,$productType)."</a>" : "";
	$embedImgSrc = str_replace("_400.jpg", "_210.jpg",$imageSrc);
	$embedCode = <<<EOD
<div style="text-align:center;line-height:150%;font-size:12px;"><a href="$curPageURL"><img src="$embedImgSrc" alt="$title" title="$title" style="border:0px;" /></a><br /><a href="$curPageURL" style="font-size:16px;">$title</a>$storeInfo</div>
EOD;
	$pp_embedCode .= $embedTitle."<input type=\"text\" readonly=\"readonly\" id=\"productEmbedCode\" onclick=\"javascript:this.focus();this.select();\" value=\"".htmlentities($embedCode)."\"/></div>";
}



// Twitter Stream

if ($showTwitterStream) {
		$pp_twitterStream = "";
		$tagArray = explode(",",$tags);
		$twitterQuery = str_replace(" ","+",$tagArray[0]);
		$search = "http://search.twitter.com/search.atom?q=$twitterQuery&rpp=10";
		$tw = curl_init();
		curl_setopt($tw, CURLOPT_URL, $search);
		curl_setopt($tw, CURLOPT_RETURNTRANSFER, TRUE);
		$twi = curl_exec($tw);
		curl_close($tw);
		preg_match_all("/<entry>(.*)<\/entry>/smU",$twi, $itemsArray);
		if (!empty($itemsArray[0])) {
			$pp_twitterStream .= <<<EOD
				<h3>&nbsp;$twitterTitle (searched on "<a href="http://search.twitter.com/search?q=$twitterQuery" rel="nofollow">$twitterQuery</a>")</h3>
				<div class="twitterStream">
EOD;
				$itemList = "";
				$entryCount = 0;
				$twiEntryAuthorUrl = "";
				$twiEntryAuthor = "";
				$twiEntryText = "";
				$twiEntryDate = "";
				foreach($itemsArray[0] as $itemVal) {
					$entryCount++;
					preg_match_all("/(<([\w]+)[^>]*>)(.*)(<\/\\2>)/",$itemVal, $entryArray);
					preg_match_all("/<published>(.*)<\/published>/smU",$entryArray[0][0], $dateArray);
					preg_match_all("/<content type=\"html\">(.*)<\/content>/smU",$entryArray[0][0], $contentArray);
					preg_match_all("/<name>(.*)<\/name>/smU",$entryArray[0][0], $nameArray);
					preg_match_all("/<uri>(.*)<\/uri>/smU",$entryArray[0][0], $uriArray);
								
					if (isset($dateArray[1][0])) {
						$twiEntryDate = $dateArray[1][0];
						$twiEntryDate = date("F j, Y, g:i a", strtotime($twiEntryDate));
					}
					if (isset($contentArray[1][0])) {
						$twiEntryText  = str_replace("<a href","<a rel=\"nofollow\" href",html_entity_decode($contentArray[1][0]));
					}
					if (isset($nameArray[1][0])) {
						$twiEntryAuthor  = $nameArray[1][0];
					}
					if (isset($uriArray[1][0])) {
						$twiEntryAuthorUrl  = $uriArray[1][0];
					}
					$pp_twitterStream .= <<<EOD
						<span class="twitterText">$twiEntryText</span>
						<div class="twitterAuthorDate">
							<a href="$twiEntryAuthorUrl" class="twitterAuthor" rel="nofollow">$twiEntryAuthor</a> <span class="twitterDate">($twiEntryDate)</span>
						</div>
EOD;
					if ($entryCount!=count($itemsArray[0])) {
						$pp_twitterStream .= "<div class=\"hr\"></div>";
					}
				}
			$pp_twitterStream .= "</div>";
		}
	}
/*?>*/