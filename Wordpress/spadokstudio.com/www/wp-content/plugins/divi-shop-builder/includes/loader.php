<?php

if ( ! class_exists( 'ET_Builder_Element' ) ) {
	return;
}


//$module_files = glob( __DIR__ . '/modules/*/*.php' );
/*
// Load custom Divi Builder modules
foreach ( (array) $module_files as $module_file ) {
	if ( $module_file && preg_match( "/\/modules\/\b([^\/]+)\/\\1\.php$/", $module_file ) ) {
		require_once $module_file;
	}
}
*/

// ** Disabled default module load code because load order matters for this plugin **
require_once __DIR__ . '/modules/WooShop/WooShop.php';
require_once __DIR__ . '/modules/WooShop-child/WooShop-child.php';
require_once __DIR__ . '/modules/WooCartList/WooCartList.php';
require_once __DIR__ . '/modules/WooCartTotals/WooCartTotals.php';
require_once __DIR__ . '/modules/WooCheckoutBillingInfo/WooCheckoutBillingInfo.php';
require_once __DIR__ . '/modules/WooCheckoutCoupon/WooCheckoutCoupon.php';
require_once __DIR__ . '/modules/WooCheckoutOrderReview/WooCheckoutOrderReview.php';
require_once __DIR__ . '/modules/WooCheckoutShippingInfo/WooCheckoutShippingInfo.php';
require_once __DIR__ . '/modules/WooNotices/WooNotices.php';
require_once __DIR__ . '/modules/WooThankYou/WooThankYou.php';
require_once __DIR__ . '/modules/Abstracts/WooAccountBase.php';
require_once __DIR__ . '/modules/WooAccountUserImage/WooAccountUserImage.php';
require_once __DIR__ . '/modules/WooAccountUserName/WooAccountUserName.php';
require_once __DIR__ . '/modules/WooAccountNav/WooAccountNav.php';
require_once __DIR__ . '/modules/WooAccountNavItem/WooAccountNavItem.php';
// require_once __DIR__ . '/modules/WooAccountDashboard/WooAccountDashboard.php';
// require_once __DIR__ . '/modules/WooAccountOrders/WooAccountOrders.php';
// require_once __DIR__ . '/modules/WooAccountViewOrder/WooAccountViewOrder.php';
// require_once __DIR__ . '/modules/WooAccountDownloads/WooAccountDownloads.php';
// require_once __DIR__ . '/modules/WooAccountAddresses/WooAccountAddresses.php';
// require_once __DIR__ . '/modules/WooAccountDetails/WooAccountDetails.php';
require_once __DIR__ . '/modules/WooAccountContent/WooAccountContent.php';
require_once __DIR__ . '/modules/WooAccountContentItem/WooAccountContentItem.php';
