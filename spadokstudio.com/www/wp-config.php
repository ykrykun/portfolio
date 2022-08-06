<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'un462850_db' );

/** Database username */
define( 'DB_USER', 'un462850_db' );

/** Database password */
define( 'DB_PASSWORD', 'VAmdp8GaV383' );

/** Database hostname */
define( 'DB_HOST', 'un462850.mysql.tools' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ',N}8-/3|v,0]-(J_?BCHL[UCd|6:-Kez rHd9~$S2nME+WW8|D<+2hm%iT4O:L8s');
define('SECURE_AUTH_KEY',  'Q_o_23vxNpMKt>e:#+IHX0_B:$ur??F:T22I-pI%I+d#`c;kGi^/%bQmCzH[|Et9');
define('LOGGED_IN_KEY',    'IpKn49&LL.L_:I3c-,IS7K{rc+Fr750Lh4F&=};H5DIg<[h>`7a#Xxkcp7P!zgE-');
define('NONCE_KEY',        'w}*/j0*QXSeoQv-*;d;z$GyE,_m?aGYVIo,}emTb|yC!/u-z#]l/|S]OjV_4(5,/');
define('AUTH_SALT',        'Yjnq+-Z%}l=fKhDcqV]kBwnZ]_${h#`;P9W|x%Nd]4IL)~-fgFm;rjR.7*}t&]Jm');
define('SECURE_AUTH_SALT', 'PK=5.0a-I1<tGIvz+=^xv&3a<N%;+2$EXIO|vUd+{K&BExZzpNN#7.[w_~-4kRI@');
define('LOGGED_IN_SALT',   'j:|&@b{4m1hHzhoC;C!-TrB{S~}!lcl~3d)7|[vSB%rxu&9mL]dbt2!%W+A,pGS(');
define('NONCE_SALT',       '7UY>hmt; M5qIa.e!?e>vlM!LM$(3v[{Zh=qi7eaj0g]:N{*<$0P|>dA}zxD>h:i');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

define('ALLOW_UNFILTERED_UPLOADS', true);


define('WP_MEMORY_LIMIT', '256M');