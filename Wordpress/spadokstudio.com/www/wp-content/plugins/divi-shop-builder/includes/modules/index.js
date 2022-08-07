/* @license
See the license.txt file for licensing information for third-party code that may be used in this file.
Relative to the scripts/ directory, the license.txt file is located at ../license.txt.
Contents of this file (or the corresponding source JS file) have been modified by Ahamed Arshad Azmi, Jonathan Hall, Anna Kurowska and/or others.
Contents of this file (or the corresponding source JS file) were last modified 2021-02-17
*/

import ModuleShop from './WooShop/WooShop';
import ModuleShopChild from './WooShop-child/WooShop-child';
import DSWCP_WooCartList from './WooCartList/WooCartList';
import DSWCP_WooCartTotals from './WooCartTotals/WooCartTotals';
import DSWCP_WooCheckoutCoupon from './WooCheckoutCoupon/WooCheckoutCoupon';
import DSWCP_WooCheckoutBillingInfo from './WooCheckoutBillingInfo/WooCheckoutBillingInfo';
import DSWCP_WooCheckoutShippingInfo from './WooCheckoutShippingInfo/WooCheckoutShippingInfo';
import DSWCP_WooCheckoutOrderReview from './WooCheckoutOrderReview/WooCheckoutOrderReview';
import DSWCP_WooNotices from './WooNotices/WooNotices';
import DSWCP_WooThankYou from './WooThankYou/WooThankYou';
import DSWCP_WooAccountUserImage from './WooAccountUserImage/WooAccountUserImage';
import DSWCP_WooAccountUserName from './WooAccountUserName/WooAccountUserName';
import DSWCP_WooAccountNav from './WooAccountNav/WooAccountNav';
import DSWCP_WooAccountNavItem from './WooAccountNavItem/WooAccountNavItem';
import DSWCP_WooAccountDashboard from './WooAccountDashboard/WooAccountDashboard';
import DSWCP_WooAccountOrders from './WooAccountOrders/WooAccountOrders';
import DSWCP_WooAccountViewOrder from './WooAccountViewOrder/WooAccountViewOrder';
import DSWCP_WooAccountDownloads from './WooAccountDownloads/WooAccountDownloads';
import DSWCP_WooAccountAddresses from './WooAccountAddresses/WooAccountAddresses';
import DSWCP_WooAccountDetails from './WooAccountDetails/WooAccountDetails';
import DSWCP_WooAccountContent from './WooAccountContent/WooAccountContent';
import DSWCP_WooAccountContentItem from './WooAccountContentItem/WooAccountContentItem';

export default [
	ModuleShop,
	ModuleShopChild,
	DSWCP_WooCartList,
	DSWCP_WooCartTotals,
	DSWCP_WooCheckoutCoupon,
	DSWCP_WooCheckoutBillingInfo,
	DSWCP_WooCheckoutShippingInfo,
	DSWCP_WooCheckoutOrderReview,
	DSWCP_WooNotices,
	DSWCP_WooThankYou,
	DSWCP_WooAccountUserImage,
	DSWCP_WooAccountUserName,
	DSWCP_WooAccountNav,
	DSWCP_WooAccountNavItem,
	// DSWCP_WooAccountDashboard,
	// DSWCP_WooAccountOrders,
	// DSWCP_WooAccountViewOrder,
	// DSWCP_WooAccountDownloads,
	// DSWCP_WooAccountAddresses,
	// DSWCP_WooAccountDetails,
	DSWCP_WooAccountContent,
	DSWCP_WooAccountContentItem
];
