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
define( 'DB_NAME', 'wpdb' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '{yA/omMq02Vu?K+1BaxVDZ`Xv`^6W>~FQX(G%vD;7DRNB-aSB@d6zLhK,c/k:rOU' );
define( 'SECURE_AUTH_KEY',  'vvUTJ,zlVOG/gzckI7lN|h#^U$]0v{|81*Ea-dH_AM&<#O9JA}&tF6gv=Ly$h|:M' );
define( 'LOGGED_IN_KEY',    '%,<S%7yLf!-@h?fIRxOc.w7zZkN&=;g$UF2a2xV1|RmEIuq lkVy-G?Uk|{)rk!.' );
define( 'NONCE_KEY',        '{:AG_Gv/W-3Hb3]Yf7%mr$tc%?-J3p:.+WcvsSO@)1^J{He[XvP0H #pqA8P:D_G' );
define( 'AUTH_SALT',        'ECB(]+bIBwr/V~{{Ey*Dy$|$D*C1tX`6m#nk!Cdk,y(/lbs%)Okxi1%IIR`4DT#9' );
define( 'SECURE_AUTH_SALT', 'ZZyfE>($lIwtB9qk`*G(M7 /)=KWhvLV$.tP72]#@c-7~e_!ue_)D-A:++BcL*K4' );
define( 'LOGGED_IN_SALT',   'mJkK2GU~SMX+ao89R+T32Pwq-.Gia5VNsTgCvLG7YNqO{,p(12D++rr+g``PiE++' );
define( 'NONCE_SALT',       's*$s(mP]m6L+qtlKFss#aAX%har0diJ?<gX#y>X)=z`5&`SSm#F2 RhD|~~I<qoL' );

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
