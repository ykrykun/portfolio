# Changelog
======
1.2.8
======
- FIX:	PHP notices
- FIX:	Extra product options Variable product & conditional support

======
1.2.7
======
- NEW:	Added support for WooCommerce Extra Product Options
- NEW:	Added SVG loading icon instead of font awesome
- NEW:	Close quick view after add to cart
- FIX:	Ajax add to cart enabled by default
- FIX:	Variable add to cart
- FIX:	Popup disabled by default now
- FIX:	removed admin bar
- FIX:	Height issue

======
1.2.6
======
- NEW:	Dropped Redux Framework support and added our own framework 
		Read more here: https://www.welaunch.io/en/2021/01/switching-from-redux-to-our-own-framework
		This ensure auto updates & removes all gutenberg stuff
		You can delete Redux (if not used somewhere else) afterwards
		https://www.welaunch.io/updates/welaunch-framework.zip
		https://imgur.com/a/BIBz6kz
- NEW:	2 New open stlyes: Fly out left and right
		https://imgur.com/a/UXFHRmk

======
1.2.5
======
- NEW:	Data to show now respects the sorting order
- FIX:	Add to cart container not working

======
1.2.4
======
- FIX:	Get product title now html escaped
- FIX:	wpautop on short + long description

======
1.2.3
======
- NEW:	Shortcode no longer requires manually ID to be set (tries to get global product id instead)

======
1.2.2
======
- NEW:	Fallback support for variations mainly to support our new 
		single variations plugin: https://welaunch.io/plugins/woocommerce-single-variations/

======
1.2.1
======
- FIX:	Next arrow target wrong product ID

======
1.2.0
======
- NEW:	Arrows to go to next / previous product for Modal View
		See Settings > Styling
- NEW:	AJAX Add to Cart
		See Settings > Data to Show

======
1.1.2
======
- NEW:	Added shortcode support for description
- NEW:	Added an option to enable inline scroll

======
1.1.1
======
- NEW:	Added a scroll to for inline view element
- FIX:	.last Paramter was not correctly for inline view

======
1.1.0
======
- NEW:	Added Popup Field to quick view products
		by SKU or Title
		See Demo bottom Right
- FIX:	Updated Languages folder

======
1.0.1
======
- NEW:	Added Stock Status as an Data Option
- FIX:	Closing Divs

======
1.0.0
======
- Inital release