<?php

/*
  Zazzle Store Builder 1.5 - a Zazzle.com product publishing tool
*/

// Please see the README.txt file included in this distribution for
// troubleshooting, installation and customization instructions

// import our external class libraries
require_once 'cacheMgr.php';
require_once 'lastRSS.php';
require_once 'configuration.php';
require_once 'strings.php';

/*

Copyright (c) 2008, Zazzle.com

All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:
     * Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
     * Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer
     in the documentation and/or other materials provided with the distribution.
     * Neither the name of Zazzle.com nor the names of its contributors may be used to endorse or promote products
     derived from this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY Zazzle.com  "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL Zazzle.com BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

*/

// if we have any of these params set in $_GET, they override our config file settings
$keywordParam = "";

if(isset($_GET['contributorHandle'])) $contributorHandle = $_GET['contributorHandle'];
if(isset($_GET['associateId'])) $associateId = $_GET['associateId'];
if(isset($_GET['productLineId'])) $productLineId = $_GET['productLineId'];
if(isset($_GET['useProductPage'])) {
    $useProductPage = $_GET['useProductPage']=="true" ? true : false;
}

if(isset($_GET['useFluidLayout'])) {
    $useFluidLayout = $_GET['useFluidLayout']=="true" ? true : false;
}

if(isset($_GET['productType'])) {
    $productType = is_numeric($_GET['productType']) ? $_GET['productType'] : "";
    if ($productType != "") {
        $keywordParam .= "&amp;productType=".$productType;
    }
}

if(isset($_GET['keywords'])) {
    $keywords = htmlspecialchars($_GET['keywords'],ENT_QUOTES);
    $keywordParam .= "&amp;keywords=".urlencode($keywords);
}

if(isset($_GET['gridCellSize'])) $gridCellSize = $_GET['gridCellSize'];
if(isset($_GET['gridCellSpacing'])) $gridCellSpacing =  htmlspecialchars($_GET['gridCellSpacing'],ENT_QUOTES);
if(isset($_GET['gridCellBgColor'])) $gridCellBgColor = htmlspecialchars($_GET['gridCellBgColor'],ENT_QUOTES);
if(isset($_GET['analyticsId'])) $analyticsId = htmlspecialchars($_GET['analyticsId'],ENT_QUOTES);

if(isset($_GET['showHowMany']) || isset($_GET['ps'])) {
    $showHowMany = !isset($_GET['ps']) ? $_GET['showHowMany'] : $_GET['ps'];
    $showHowMany = is_numeric($showHowMany) ? $showHowMany : "20";
}

if(isset($_GET['startPage']) || isset($_GET['pg'])) {
    $startPage = !isset($_GET['pg']) ? $_GET['startPage'] : $_GET['pg'];
    $startPage = is_numeric($startPage) ? $startPage : "1";
}

if(isset($_GET['useCaching'])) $useCaching = $_GET['useCaching'];
if(isset($_GET['cacheLifetime'])) $cacheLifetime = $_GET['cacheLifetime'];

if(isset($_GET['defaultSort'])) {
    $defaultSort  = $_GET['defaultSort'] == "date_created" ? $_GET['defaultSort'] : "popularity";
}

$currentSort = isset($_GET['currentSort']) ?  $_GET['currentSort'] : "";
$_GET['gridPage'] = isset($_GET['gridPage']) ?  htmlspecialchars($_GET['gridPage'],ENT_QUOTES) : "";
$_GET['gridSort'] = isset($_GET['gridSort']) ?  htmlspecialchars($_GET['gridSort'],ENT_QUOTES) : "";

if(isset($_GET['productsPerRow'])) {
    $productsPerRow  = is_numeric($_GET['productsPerRow']) ? $_GET['productsPerRow'] : 5;
}

if(isset($_GET['useAnalytics'])) {
    $_GET['useAnalytics'] == 'true' ? $useAnalytics = true : $useAnalytics = false;
}

if(isset($_GET['showPagination']))  {
     $_GET['showPagination'] == 'true' ? $showPagination = true : $showPagination = false;
}

if(isset($_GET['showSorting']))  {
    $_GET['showSorting'] == 'true' ? $showSorting = true : $showSorting = false;
}

if(!empty($_GET['customFeedUrl'])) {
    $customFeedUrl = htmlspecialchars($_GET['customFeedUrl'],ENT_QUOTES);
    $showSorting = 'false';
    $showPagination = 'false';
}


if(isset($_GET['showProductDescription'])) {
    $_GET['showProductDescription'] == 'true' ? $showProductDescription = true : $showProductDescription =  false;
}

if(isset($_GET['useShortDescription'])) {
    $_GET['useShortDescription'] == 'true' ? $useShortDescription = true : $useShortDescription = false;
}

if(isset($_GET['showByLine'])) {
    $_GET['showByLine'] == 'true' ? $showByLine = true : $showByLine =  false;
}

if(isset($_GET['showProductTitle']))  {
    $_GET['showProductTitle'] == 'true' ? $showProductTitle = true : $showProductTitle = false;
}

if(isset($_GET['showProductPrice'])) {
    $_GET['showProductPrice'] == 'true' ? $showProductPrice = true : $showProductPrice = false;
}

// Standardize values to booleans if they are set as strings

if(isset($useCaching) && $useCaching != 1 && $useCaching != 'true') $useCaching = false;
if(isset($useCaching) && $useCaching == 'true') $useCaching = true;

// use analytics is a special case because we use the value as a string literal in javascript
if(isset($useAnalytics) && $useAnalytics != 1 && $useAnalytics != 'true') $useAnalytics = 'false';
if(isset($useAnalytics) && $useAnalytics == 'true') $useAnalytics = 'true';

if(isset($showPagination) && $showPagination != 1 && $showPagination != 'true') $showPagination = false;
if(isset($showPagination) && $showPagination == 'true') $showPagination = true;

if(isset($showSorting) && $showSorting != 1 && $showSorting != 'true') $showSorting = false;
if(isset($showSorting) && $showSorting == 'true') $showSorting = true;

if(isset($showProductDescription) && $showProductDescription != 1 && $showProductDescription != 'true') $showProductDescription = false;
if(isset($showProductDescription) && $showProductDescription == 'true') $showProductDescription = true;

if(isset($useShortDescription) && $useShortDescription != 1 && $useShortDescription != 'true') $useShortDescription = false;
if(isset($useShortDescription) && $useShortDescription == 'true') $useShortDescription = true;

if(isset($showByLine) && $showByLine != 1 && $showByLine != 'true') $showByLine = false;
if(isset($showByLine) && $showByLine == 'true') $showByLine = true;

if(isset($showProductTitle) && $showProductTitle != 1 && $showProductTitle != 'true') $showProductTitle = false;
if(isset($showProductTitle) && $showProductTitle == 'true') $showProductTitle = true;

if(isset($showProductPrice) && $showProductPrice != 1 && $showProductPrice != 'true') $showProductPrice = false;
if(isset($showProductPrice) && $showProductPrice == 'true') $showProductPrice = true;


if(isset($_GET['clean_cache'])) {
    if($_GET['clean_cache'] == 'true') {
        // clean up
            $cache = new cacheMgr;
            $cache->clean_cache();
    }
}

// $gridNumber lets zstore.php keep track of individual grids in a multi-grid setup
if (!isset($gridNumber)) {
    $gridNumber = 0;
}

if($gridNumber >= 1) {
    $gridNumber++;
}
else {
    $gridNumber = 1;
}

// URLS used by the Zazzle Store Builder
$poweredByZazzleButton = "http://www.".$zazzleURLBase."/assets/graphics/logos/poweredByZazzle_v2.png";
$dataURLBase = $contributorHandle!="" ? 'http://feed.'.$zazzleURLBase.'/'.$contributorHandle.'/feed' : 'http://feed.'.$zazzleURLBase.'/feed';
//$zazzleURLBase = 'http://www.zazzle.com';


// tiny, small, medium, large, huge.
switch( $gridCellSize) {
    case 'tiny':
        $gridCellSize = 50;
        break;
    case 'small':
        $gridCellSize = 92;
        break;
    case 'medium':
        $gridCellSize = 152;
        break;
    case 'large':
        $gridCellSize = 210;
        break;
    case 'huge':
        $gridCellSize = 328;
        break;
    default:
        if (is_numeric($gridCellSize)) {
            $gridCellSize = $gridCellSize;
        } else {
            $gridCellSize = 152;
        }
}

$gridCellWidth = $gridCellSize + 6;
$gridCellHeight = $gridCellSize + 4;
$associateIdParam = $associateId != "" && $associateId != "YOURASSOCIATEIDHERE" ? "?rf=".$associateId : "";
$associateId = $associateId != "YOURASSOCIATEIDHERE" ? $associateId : "";

$productsPerRow = $productsPerRow < 1 ? 1 : floor($productsPerRow);

$gridWidth = ((($gridCellSpacing*2) + $gridCellWidth)*($productsPerRow));
$rowWidth = ($gridWidth - ($gridWidth - ($gridCellWidth * $productsPerRow))/2);
$countRowWidth = $rowWidth-$gridCellSpacing;

if ($useFluidLayout){
    $rowWidth = "100%";
    $countRowWidth = "100%";
} else {
    $rowWidth = $rowWidth."px";
    $countRowWidth = $countRowWidth."px";
}
?>

<!-- Powered by Zazzle. For more information, please visit http://www.zazzle.com  // -->
<div class="allGrids clearfix">
    <div class="centerGrids" style="width:<?php echo $rowWidth?>">
<?php

    // This section of code fetches the Rss data from cache or fresh from the server, parses it, converts the data into
    // a product data grid cell, caches the product and desigin images and outputs the grid cell html to the user's
    // browser for display.  You should not need to modify this section unless you wish to modify the grid cell html itself

    // create lastRSS object and set up its params
    $rss = new lastRSS;
    $cache = null;

    if($useCaching == true) {

        $rss->cache_dir = 'c';
        $rss->cache_time = $cacheLifetime;
        // create a cache manager object for image caching
        $cache = new cacheMgr;
        $cache->set_lifetime( $cacheLifetime);
    }

    $rss->CDATA = 'content';
    $rss->items_limit = 0;

    // init sort variable and some 'showing' variables we use later for pagination
    $sortMethod = !isset($_GET['st']) ? "st=date_created" : 'st=popularity';

    if($defaultSort == 'popularity') {
        $sortMethod = 'st=popularity';
        $sortMode = 'popularity';
    }
    if($defaultSort == 'date_created') {
        $sortMethod = 'st=date_created';
        $sortMode = 'date_created';
    }
    if($currentSort == 'popularity') {
        $sortMethod = 'st=popularity';
        $sortMode = 'popularity';
    }
    if($currentSort == 'date_created') {
        $sortMethod = 'st=date_created';
        $sortMode = 'date_created';
    }

    $cg = '';
    if($productLineId) {
        $cg = "&cg=$productLineId";
    }

    $gridPages = array();
    //$startPage = 1;

    if($_GET['gridPage'] != '') {
        $_GET['gridPage'] = preg_replace('~[^0-9,_]+~i', '', $_GET['gridPage']); // removes XSS characters from gridPage
        if(!strstr( $_GET['gridPage'],  ',')) {  // only one grid page passed
            $gridPages[] = $_GET['gridPage'];
        }
        else { // list of multiple grid pages
            $gridPages = split( ',' , $_GET['gridPage']);
        }

        foreach( $gridPages as $gridPage) {

            // Is this our gridNumber request?
            $gridNumberParts = split( '_', $gridPage);

            if($gridNumberParts[0] == $gridNumber) {

                // yes - this is our gridPage request - override
                $startPage = $gridNumberParts[1];
            }
        }
    }

    if(!$startPage) $startPage = 1;
    $showing = (( $showHowMany * $startPage) - $showHowMany)+1;
    $showingEnd = $showHowMany * $startPage;

    // Get our grid sort values
    $gridSort = array();
    if($_GET['gridSort'] != '') {
        $_GET['gridSort'] = preg_replace('~[^a-z0-9,_]+~i', '', $_GET['gridSort']); // removes XSS characters
        if(!strstr($_GET['gridSort'], ',')) {
            $gridSort = array( $_GET['gridSort']);
        }
        else {
            $gridSort = split(',', $_GET['gridSort']);
        }
    }

    foreach( $gridSort as $gridSortVal) {
        $gridSortValueParts = split('_', $gridSortVal);
        if($gridSortValueParts[0] == $gridNumber) {
            switch( $gridSortValueParts[1]) {
                case 'date':
                    $sortMethod = 'st=date_created';
                    $sortMode = 'date_created';
                    break;
                case 'popularity':
                 default:
                     $sortMethod = 'st=popularity';
                    $sortMode = 'popularity';
            }
        }
    }
    //Handle keyword entry
    $keywords = strtolower($keywords);
    if (strpos($keywords,"+")) {
        $keywords = str_replace(" ","",$keywords);
        $keywords = str_replace("+",",and,",trim($keywords));
    } else {
        if (strpos($keywords,",")) {
            $keywords = str_replace(" ","",$keywords);
            $keywords = str_replace(",",",or,",$keywords);
        } else {
            if (strpos($keywords," or ")) {
                $keywords = str_replace(" or ",",or,",$keywords);
            } else {
                if (strpos($keywords," and ")) {
                    $keywords = str_replace(" and ",",and,",$keywords);
                } else {
                    if (strpos($keywords," ")) {
                        $keywords = str_replace(" ",",or,",$keywords);
                    }
                }
            }
        }
    }

    // Custom feed support
    if (!empty($customFeedUrl)) {
        $feedUrl = $customFeedUrl;
    } else {
        $feedUrl = $dataURLBase . '?'.$sortMethod.'&at='.$associateId.'&isz='.$gridCellSize.'&bg='.$gridCellBgColor.'&src=zstore&pg='.$startPage . $cg . '&ps='.$showHowMany.'&ft=gb&opensearch=true&qs='.$keywords.'&pt='.$productType;
    }

    // Get our RSS data
    if ( $rs = $rss->get( $feedUrl)) {

    // Get the total number of results from the opensearch: namespace in RSS
    $totalNum = isset($rs['opensearch:totalResults']) ? $rs['opensearch:totalResults'] : "";
    if ( $showingEnd > $totalNum) {
        $showingEnd = $totalNum;  // can't show more results than we have
    }

    $pagination = '';
    $paginationText = '';
    $paginationText2 = '';

      // Figure out how many pages we have for pagination, use this to generate pagination control html
    if ( $rs['items_count'] > 0) {

        $totalPages = ceil( $totalNum/$showHowMany);
        if($totalPages > 1) {
            $pagination = $paginationText;
        }

        // Figure out where to start and stop the pagination page listing
        $paginationStart = $startPage - 5;
        $paginationEnd = $startPage + 5;

        $paginationBack = $startPage - 1;
        $paginationFwd = $startPage + 1;

        if($paginationStart < 1) $paginationStart = 1;
        if($paginationBack < 1) $paginationBack = 1;

        if($paginationEnd > $totalPages) $paginationEnd = $totalPages;
        if($paginationFwd > $totalPages) $paginationFwd = $totalPages;

        // prepare the states of the other gridPages
        $gridPageHist = '';

        foreach( $gridPages as $pg) {
            $gridNumberParts = split( '_', $pg);
            if($gridNumberParts[0] != $gridNumber) {
                $gridPageHist .= ',' . $pg;
            }
        }

        $gridSortHist = '';
        foreach( $gridSort as $sort) {
            if($sort == '') continue;
            $gridSortNumberParts = split( '_', $sort);
                if($gridSortHist != '') $gridSortHist .= ',';
                $gridSortHist .= $sort;
        }

        // strip any leading commas
        $gridSortHist = preg_replace("/\,+$/", '', $gridSortHist);

        if($startPage > 1) {
            $pagination .= "<small><a class=\"paginationArrows\" title=\"$paginationBackToFirstPage\" href=\"?gridPage={$gridNumber}_1{$gridPageHist}&amp;gridSort={$gridSortHist}$keywordParam\">&lt;&lt;</a></small> "; // back to start

            $pagination .= "<small><a class=\"paginationArrows\" title=\"$paginationBackOnePage\" href=\"?gridPage={$gridNumber}_$paginationBack{$gridPageHist}&amp;&amp;gridSort={$gridSortHist}$keywordParam\">&lt;</a></small> "; // back one page
        }

        for ( $i=$paginationStart; $i<=$paginationEnd; $i++) {
            if($totalPages <= 1) continue;
            if($i == $startPage) $pagination .= '<span class="current" ><strong>' . $i . '</strong> </span>';
            else $pagination .= "<a title=\"$jumpToPage $i $ofResults\" href=\"?gridPage={$gridNumber}_{$i}{$gridPageHist}&amp;gridSort={$gridSortHist}$keywordParam\" class=\"default\">".$i."</a> ";
        }

        if($startPage < $totalPages ) {
            $pagination .= "<small><a class=\"paginationArrows\" title=\"$advanceOnePageOfResults\" href=\"?gridPage={$gridNumber}_" . $paginationFwd . "{$gridPageHist}&amp;gridSort={$gridSortHist}$keywordParam\">&gt;</a></small> ";
            $pagination .= "<small><a class=\"paginationArrows\" title=\"$advanceToLastPageOfResults\" href=\"?gridPage={$gridNumber}_" .  $totalPages  . "{$gridPageHist}&amp;gridSort={$gridSortHist}$keywordParam\">&gt;&gt;</a></small> ";
        }

    echo "<div class=\"clearMe\"></div>";
    if ( $showPagination == 'true' || $showSorting == 'true') {
        echo "<div class='count' style='width:".$countRowWidth."'>";
    }

      $gridSortHist = '';

      // Add the sorting controls if we are showing sorting
    if ( $showSorting == 'true') {

        foreach( $gridSort as $sort) {
            $gridSortNumberParts = split( '_', $sort);
            if($gridSortNumberParts[0] == '') continue;
            if($gridSortNumberParts[0] != $gridNumber) {
                if($gridSortHist != '') $gridSortHist .= ',';
                $gridSortHist .= $sort;
            }
        }

        $gridSortHistDate = $gridSortHist . ",{$gridNumber}_date";
        $gridSortHistPopularity = $gridSortHist . ",{$gridNumber}_popularity";

        // strip any leading commas
        $gridSortHistDate = preg_replace("/^[\,]*/", '', $gridSortHistDate);
        $gridSortHistPopularity = preg_replace("/^[\,]*/", '', $gridSortHistPopularity);

        if ( $sortMode == 'date_created') {
            echo "<span class=\"sortLinks\">$sortBy: <a href=\"?gridPage={$gridNumber}_$startPage{$gridPageHist}&amp;gridSort={$gridSortHistDate}$keywordParam\" class=\"selectedSort\" title=\"{$sortByDateTooltip}\" rel=\"nofollow\"><strong>$dateCreated</strong></a> | <a href=\"?st=1&amp;gridPage={$gridNumber}_$startPage{$gridPageHist}&amp;gridSort={$gridSortHistPopularity}$keywordParam\" title=\"{$sortByPopularityTooltip}\" rel=\"nofollow\">$popularity</a></span>";
        } else {
            echo "<span class=\"sortLinks\">Sort by: <a href=\"?gridPage={$gridNumber}_{$startPage}{$gridPageHist}&amp;gridSort={$gridSortHistDate}$keywordParam\" title=\"{$sortByDateTooltip}\" rel=\"nofollow\">$dateCreated</a> | <a href=\"?st=1&amp;gridPage={$gridNumber}_{$startPage}{$gridPageHist}&amp;gridSort={$gridSortHistPopularity}$keywordParam\" class=\"selectedSort\" title=\"{$sortByPopularityTooltip}\" rel=\"nofollow\"><strong>$popularity</strong></a></span>";
        }
    }

    // Complete the pagination text initialization
    $paginationText = "&nbsp;&nbsp;&nbsp;&nbsp;<span>$showingXofY  $showing - $showingEnd $of ".$totalNum." products.</span>&nbsp;&nbsp;".$pagination;
    $paginationText2 = "&nbsp;&nbsp;&nbsp;&nbsp;<span>$showingXofY $showing - $showingEnd $of ".$totalNum." products.</span>&nbsp;&nbsp;".$pagination;

    // Add the pagination control html if we are showing pagination
    if ( $showPagination == 'true') { echo $paginationText; }
    if ( $showPagination == 'true' || $showSorting == 'true') {echo "</div>";}
    echo "<div class=\"clearMe short\"></div>";

    // Iterate through the RSS items and extract their data, cache their images if required and output their grid cells
    foreach( $rs as $key=>$val) {
          if ( $key=="items") {    // we only care about the <item> nodes in this case
              $numIteration = 0;
            if (!$useFluidLayout) {
                echo "<div class=\"gridRow clearfix\" style=\"width:".$rowWidth.";margin-bottom:".$gridCellSpacing."px;\">";
            }
            foreach( $val as $index => $value) {
                $numIteration++;
                if (!$useFluidLayout) {
                    if ($numIteration > $productsPerRow) {
                        echo "</div>";
                        $numIteration = 1;
                        echo "<div class=\"gridRow clearfix\" style=\"width:".$rowWidth.";margin-bottom:".$gridCellSpacing."px;\">";
                    }
                }
//print_r($value);
                // tidyup, initialize product data
                $title = urldecode( $value['title']);
                $description = isset($value['description']) ? urldecode( $value['description']) : "";
                $imageUrl = $value['g:image_link'];
                $productId = $value['g:id'];
                $price = $value['g:price'];
                $pubDate = $value['pubDate'];
                $artist = $value['artist'];

                if (isset($value['g:size'])) {
                    $availableSizes = htmlentities(str_replace("\"","",$value['g:size']));
                }
                if (isset($value['g:color'])){
                    $colorShown = htmlentities(str_replace("\"","",$value['g:color']));
                }
                if (isset($value['g:style'])) {
                    $style = htmlentities(str_replace("\"","",$value['g:style']));
                }
                $specificProductType = htmlentities(str_replace("\"","",$value['g:product_type']));
                if (isset($value['c:keywords'])) {
                    $tags = htmlentities(str_replace("\"","",$value['c:keywords']));
                }

                $link = $value['link'];
                $link = str_replace( "&amp;ZCMP=gbase", "", $link);

                $shortdescription = '';
                // strip any html from the description
                $description = preg_replace( "/<[^>]+>/", '', $description);

                $title = preg_replace( "/<[^>]+>/", '', $title);

                $shortdescription = preg_replace( "/<[^>]+>/", '', $shortdescription);
                if($showProductDescription == true) {
                    $description = preg_replace( "/\.\.\./", '... ', $description);
                    $description = preg_replace( "/\,/", ', ', $description);
                    $descriptionWords = preg_split("/[\s]+/", $description);

                    for( $i = 0; $i <= 10; ++$i) {
                        if (isset($descriptionWords[$i])){
                            $shortdescription .= $descriptionWords[$i] . ' ';
                        }
                    }

                    if(sizeof( $descriptionWords) > 10) $shortdescription .= '...';
                }

                // generate the analytics link if we are using google analytics
                  if ( $useAnalytics=="true") {
                    $analyticsLink = "onclick=\"pageTracker._link(this.href); return false;\"";
                }
                else {
                    $analyticsLink = "";
                }
                if ($useProductPage) {
                    $nofollow = "";
                    $analyticsLink = "";
                    $urlTitle = str_replace('...', '_', $title);
                    $urlTitle = str_replace(array('!', '\'', '.', ',', ';', ':', '"', '&quot', '?', '_', '(', ')', '`', '~', '@', '#', '$', '^', '&', '*', '+', '=', '[', ']', '{', '}', '|', '<', '>'), '', $title);
                    $urlTitle = str_replace(" ","_",$urlTitle);
                    $urlTitle = str_replace("___","_",$urlTitle);
                    $urlTitle = str_replace("__","_",$urlTitle);
                    $urlTitle = strtolower($urlTitle);
                    $urlTitle = str_replace("_bumper_sticker","",$urlTitle);
                    $urlTitle = strtolower($urlTitle);

                    if (strpos(strtolower($title),$specificProductType)===false) {
                        $specificProductType = $specificProductType == "bumpersticker" ? "bumper_sticker" : $specificProductType;
                        $urlTitle = $urlTitle."_".$specificProductType;
                    } else {
                        $urlTitle = $urlTitle;
                    }
                    $link = "productpage.php?title=".$urlTitle."&amp;pid=".$productId."&amp;rf=".$associateId;
                    if ($useFriendlyUrls) {
                        $urlTitle = str_replace("/", '_', $urlTitle);
                        $urlTitle = str_replace("-", '_', $urlTitle);
                        $urlTitle = str_replace("___","_",$urlTitle);
                        $urlTitle = str_replace("__","_",$urlTitle);
                        $link = $urlTitle."-".$productId.".html";
                    }
                } else {
                    $nofollow = "rel=\"nofollow\"";                    
                }
                $galleryUrl = "http://www.".$zazzleURLBase."/".$artist.$associateIdParam;

                if($useCaching == true) {
                    $imageUrl = preg_replace( '/amp;/','', $imageUrl);  // un-escape the ampersands
                    $imageSrc = ''; // we'll use this to set the image's initial src url

                    // build our product image url
                    $productImageUrl = $imageUrl;
                    $productFile = str_replace("http://rlv.zcache.com/","",$imageUrl);

                    // do we have this product's images already in the cache?
                    if($cache->is_image_cached($productFile)) {   // yes - override image url with local url
                        $productImageUrl = 'c/'. $productFile;
                    } else {  // no - go get the image from the server and cache
                        // get product image - this will fail if your version of php is not curl-enabled
                        $ch = curl_init( rawurldecode( $productImageUrl));
                        $fh = fopen( "c/" . $productFile, "w");
                        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt ($ch, CURLOPT_HEADER, 0);
                        $fdata = curl_exec( $ch);
                        fwrite( $fh, $fdata);
                        curl_close( $ch);
                        fclose( $fh);

                        // override the remote url with the cached versions so we point at the local copies
                        $productImageUrl =  "c/$productFile";
                        $imageSrc = $productImageUrl;
                    }
                } else { // no - we are not using caching
                    $imageSrc = $imageUrl;
                }

            $displaytitle = '';
            $desc = '';
            $displayprice = '';
            $byline = '';



            if($showProductTitle == 'true') {
                $displaytitle = "<a href=\"$link\" $analyticsLink $nofollow class=\"productTitle\" title=\"$title\" style=\"width: ".$gridCellWidth."px;\">$title</a>";
            }

            if($showProductDescription  == 'true') {
                if ($useShortDescription == 'true') {
                    $desc =  "<div class=\"productDescription\" title=\"$description\">$shortdescription</div>";
                } else {
                    $desc =  "<div class=\"productDescription\">$description</div>";
                }
            }

            if ( $showByLine == 'true') {
                $byline = "$by <a rel=\"nofollow\" href=\"$galleryUrl\" title=\"$viewMoreProductsFrom $artist\">$artist</a>";
            }

            if($showProductPrice == 'true') {
                $displayprice = "<div class=\"productPrice\">$$price</div>";
            }
            $fluidGridCellSpacing = $useFluidLayout ? $gridCellSpacing : "0";

            // output the product's grid cell
            echo <<<EOD
                <div class="gridCell" style="width: {$gridCellWidth}px;margin:0 {$gridCellSpacing}px {$fluidGridCellSpacing}px 0;min-height:{$gridCellHeight}px;">
                    <a href="$link" $analyticsLink $nofollow class="realviewLink" style="height:{$gridCellHeight}px;"><img src="$imageSrc" class="realviewImage" alt="$title" title="" style="border:2px solid #$gridCellBgColor;width: {$gridCellSize}px;height: {$gridCellSize}px;" /></a>
                    <div class="gridCellInfo">
                        $displaytitle
                        $desc
                        $byline
                        $displayprice
                    </div>
                </div>
EOD;
            }
          }
      }

    echo "<div class=\"clearMe\"></div><br />";
    if ( $showPagination == 'true' || $showSorting == 'true') {
        echo "<div class='count' style='width:".$countRowWidth."'>\n\n";
    } else {
        echo "<div class='count' style='width:100%;'>";
    }

    // if we have sort controls enabled, show them
    if ( $showSorting == 'true') {
        if ( $sortMode == 'date_created') {
            echo "<span class=\"sortLinks\">$sortBy: <a href=\"?gridPage={$gridNumber}_{$startPage}{$gridPageHist}&amp;gridSort={$gridSortHistDate}$keywordParam\" class=\"selectedSort\" rel=\"nofollow\"><strong>$dateCreated</strong></a> | <a href=\"?st=1&amp;gridPage={$gridNumber}_{$startPage}{$gridPageHist}&amp;gridSort={$gridSortHistPopularity}$keywordParam\" rel=\"nofollow\">$popularity</a></span>";
        }
        else {
            echo "<span class=\"sortLinks\">Sort by: <a href=\"?gridPage={$gridNumber}_{$startPage}{$gridPageHist}&amp;gridSort={$gridSortHistDate}$keywordParam\" rel=\"nofollow\">$dateCreated</a> | <a href=\"?st=1&amp;gridPage={$gridNumber}_{$startPage}{$gridPageHist}&amp;gridSort={$gridSortHistPopularity}$keywordParam\" class=\"selectedSort\" rel=\"nofollow\"><strong>$popularity</strong></a></span>";
        }
    }

    // if we have pagination enbled, show pager control
    if ( $showPagination == 'true') { echo $paginationText2; }

    echo "<div class=\"pbimg\"><a href=\"http://www.".$zazzleURLBase.$associateIdParam."\" rel=\"nofollow\"><img src=\"$poweredByZazzleButton\" alt=\"$poweredByZazzle\" /></a></div></div><div class=\"clearMe\"></div>";


?>
<br />
<?php
}
else {  // no - rss socket is not responding
    echo "<br /><div class=\"error\">$errorStringProductsUnavailable</div>";
}
  }
  else {  // fatal error - no cached RSS, no socket
      die ( $errorStringRSSNotFound);
  }

?>

    </div>
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
</div>