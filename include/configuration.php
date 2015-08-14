<?php
/* *****************************************************/
/*  USER CONFIGURABLE VARIABLES FOR ZSTORE 1.5        */
/* ***************************************************/

/********************************************************************************/
/*    REQUIRED VARIABLES                                                       */
/*  You must replace the values for these variables with your own information */
/*****************************************************************************/
// Your Zazzle contributor name
$contributorHandle = "wethepeopleiterum";

// Your Zazzle Associate ID
$associateId = "";

/**************************************************************/
/*   OPTIONAL VARIABLES                                      */
/* You may change these variables to suit your store design */
/***********************************************************/

// The numeric code for the Zazzle store category (formerly known as "product line") to display.
// If you want to show all products from a store, leave this blank. To get a store category number,
// click on a store category in a store. In the URL you will see something like this:
// http://www.zazzle.com/coatsofarms/products/cg-196595220567583981. The string of numbers at
// the end is the store category ID. (leave blank for marketplace search or to pull entire store)
$productLineId = "";

// Product type filter. Use to limit display to only one product type (t-shirts, mugs, etc)
// Enter one of the numeric Product Codes below. Leave this blank to show all product types:

// 106 Labels
// 121 Envelopes
// 127 Avery Custom Binders
// 128 Bumper Stickers
// 137 Greeting/note Cards
// 144 Mousepads
// 145 Buttons
// 146 Keychains
// 147 Magnets
// 148 Trucker Hats
// 149 Printed Bags
// 151 Ties
// 153 Photo Sculptures
// 154 Aprons
// 155 Pet Apparel
// 156 Photo Prints
// 158 Calendars
// 161 Invitations
// 166 Doodle Speakers
// 167 Keds Shoes
// 168 Mugs
// 172 Zazzle Custom Postage
// 174 Coasters
// 175 Ornaments
// 176 Speck iPhone, iPod & iPad Cases
// 177 Zazzle Custom Necklaces
// 179 Case-Mate Phone and Device Cases
// 186 Skateboards
// 190 Photo Enlargements
// 192 Wrapped Canvas
// 199 Letterhead
// 217 Stickers
// 228 Posters
// 229 Stationery
// 231 Embroidered Shirts
// 232 Embroidered Bags
// 233 Embroidered Hats
// 235 T-shirts/Apparel
// 239 Postcards
// 240 Profile Cards/Business Cards
// 243 Photocards
// 244 Flyers
// 245 Rackcards

$productType = "";

// Search terms.  Comma separated keywords you can use to select products for your store.
// Use this for marketplace searches as well as store specific searches.
$keywords = "";

// The size you want each product thumbnail:  (tiny, small, medium, large or huge)
$gridCellSize = "large";

// Grid cell spacing: The space between products in the product grid (in pixels).
$gridCellSpacing = "9";

// Background color of grid images in HEX (without the #, for example, "FFFFFF" for white)
$gridCellBgColor = "FFFFFF";

// If you want to use Google Analytics in your store, say true. Otherwise false.
$useAnalytics = false;

// Your Google Analytics code.  This variable is ignored if useAnalytics is set to false.
$analyticsId = "YOUROWNANALYTICSCODENUMBERHERE";

// How many products do you want to display per row in products grid?
$productsPerRow = "5";

// Fluid layout will allow your product grid to expand to the full width of the browser.
// This setting ignores $productsPerRow
$useFluidLayout = "";

// This is how many total results you want to display per page.
$showHowMany = "5";

// Shows a specific page of products if more than one page is returned.
// For example, start showing products from page 5 of 200
$startPage = "1";

// Show pagination controls (true or false).
// These are the page numbers, <-- Prev and Next --> used to move around in a Zazzle Store.
$showPagination = true;

// Show sorting controls (true or false).
// If true, links are shown that allow sorting products by Newest or Popular.
// If false, no sort links are shown and sortingis done according to the
// value of defaultSort.
$showSorting = true;

// How should we be sorting by default? options are 'date_created' or 'popularity'.
$defaultSort = 'date_created';

// Show product description beneath the product image in products grid (true or false).
// Note: the description appears beneath the title if the title is enabled.
$showProductDescription = true;

// If showing description, true = short description, false = long description
// Ignored if $showProductDescription = false
$useShortDescription = true;

// Show product title in products grid. (true or false).
$showProductTitle = true;

// Show artist name in products grid.  (true or false).
$showByLine = true;

// Show product price in products grid. (true or false).
$showProductPrice = true;

/* ******************** Product Page Specific Options ******************* */

// If $useProductPage is true, clicking a product thumbnail in your zStore opens a local product page,
// otherwise it links directly to the product page on Zazzle.com
$useProductPage = true;

// The breadcrumb trail has product type (e.g. "shirts") as a link. It can either link to a search on the artist's store,
// or to the Zazzle marketplace. Set this to true if you want to link to the artist's store.
// Associates (a.k.a. Affiliates) should consider setting to false to get a larger search result in the marketplace.
$productTypeLinkToArtist = false;

// Meta Description tag. Search engine crawlers look at this.
// Enter a short sentence or two describing your site. Use %s to represent the current product type.
// Shows up on product pages.
$metaDescription = "Check out this %s which can be customized and shipped worldwide!";

// Meta Keywords tag. Search engine crawlers look at this.
// Enter a comma separated list of relevant keywords for your site.
// Shows up on product pages.
$metaKeywords = "eagle,lion,political,patriotic,freedom,goverment";

// Set this to true if you want your product pages to display a Twitter stream. The Twitter Stream shows up under the
// description and displays the latest 10 tweets based on the product's first tag. This is good for SEO.
$showTwitterStream = true;

// The URL of the site where you have Store Builder installed.
// This link appears at the top of every product page.
// Examples:
// 	"http://www.myzstore.com"
// 	"http://www.myzstore.com/store"
// 	"/store"
// 	"/"
$mainStoreLink = "";

// The text you want your main store link to display.
$mainStoreLinkText = "Find more creative custom products!";

// This displays a small text field with HTML code that visitors can use to copy and paste into their blogs.
// The URL in the HTML is your product page URL on your site.
$showEmbedCode = true;

// Embed code store URL. This is the full URL of your store that will appear in the generated embed code for blogs.
// This must be fully qualified, e.g. "http://www.myzstore.com" or "http://www.myzstore.com/store"
$embedCodeStoreUrl = "";

// Embed code URL text. This is what you want the text to say in the embed code for blogs.
// Use %s to represent the product type (shirt, card, mug, etc)
$embedCodeText = "Find other great %ss at My ZStore!";

// Each product page has the ability to show up to 5 other related products based on a randomly selected tag.
// Enable that by setting this value to true
$showRecommendations = true;

// Up to how many recommendations do you want to show?
$numRecs = 4;

// What you want to label the related products section
$recommendationsTitle = "We The People Iterum";

/* ******************** ADVANCED OPTIONS ******************* */

// This creates SEO friendly URL's of your product pages (must have $useProductPage set to true)
// A friendly URL looks like this: http://www.yourdomain.com/Super_Dad-235218747223170413.html
// To use this feature your web host must allow you to create .htaccess files.
// Contact your host if you're unsure.
//
// Create a text file named ".htaccess" (without quotes) in the same folder you installed Store Builder.
// Include the following two lines in that file:
//
// 			RewriteEngine On
// 			RewriteRule ^([^/]*)-([^/]*)\.html$ /product.php?title=$1&pid=$2 [L]
//
// NOTE: If you enable this and do not have a correct .htaccess file, your links will break.
// A sample .htaccess file (.htaccess_sample) is located in the root of your Store Builder installation.
$useFriendlyUrls = false;

// Enable or disable image caching (true or false). The 'c' folder on your server
// requires full write permissions if this is set to true.
$useCaching = false;

// How long to keep cached resources (if useCaching is enabled) in seconds.
// 3600 seconds = 1 hour
$cacheLifetime = 7200;

// Custom Feed Url points to a local XML file of a feed of products to load.
// This allows you to customize a feed manually and display it in your store.
// Product Type narrowing and pagination/sorting are disabled if this is used.
// ex: http://www.yourdomain.com/myfeed.xml
// A sample feed file (sample_feed.xml) is located in the root of your Store Builder installation.
// Note: This is usually set in a PHP file. See the file sample_feed.php in the root of your Store Builder installation.
$customFeedUrl = "";


// *****IMPORTANT!!! DO NOT CHANGE THIS RIGHT NOW SINCE OUR FEEDS ARE NOT YET INTERNATIONALIZED!*****
// *****YOUR STORE WILL BREAK! WHEN WE GET INTERNATIONAL FEEDS UP, THEN THIS CAN BE CHANGED. THANK YOU!*****
// This is the base URL of Zazzle. Only change if you use zazzle.co.uk, zazzle.au, zazzle.ca, or any of our
// other international domains.
$zazzleURLBase = "zazzle.com";

/* ******************************************* */
?>
