<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'portfolio');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '/O5[S%:_$%;)J/0h&qAn<BN)$`Bj=ek*<7d;BPE@;JN]q:1qc_B6Ly<]`_|;sf$/');
define('SECURE_AUTH_KEY',  'b2@B1I0o^~3v9(5$Tckeo,6Jp%PjatmXd~XL2L)~S^-D;u%s^Y@0rJ|Svk_NAfl%');
define('LOGGED_IN_KEY',    'z*V%9A$-xJ(c|E&S6B/tI?,DsW,Sq1<(nQV3+{$OHBOSpX@[Sb[DB`;gK2u#):6a');
define('NONCE_KEY',        '6Dc*H/9p/x6Ii-`uilY!4qL-A#,?r?k>G4]9Z|1LV.6TIgTrrO+wqE&.75LX.FJI');
define('AUTH_SALT',        '_#Yhw/#in;yCnGhNA*_dtlxL`O% S;}w8[p)KW#2G24+>k,4;CO(181]SrCjzm[I');
define('SECURE_AUTH_SALT', 'yFG}N[FAC>Xd^YGT&?q>{tAmdY&q.^v4L+bzy|5IGq?~xskHwH>xOvlx( #|#coC');
define('LOGGED_IN_SALT',   'N`vEqG3Ny6IY#s8h ]ukKTxz>F+cB0m,Br>upW`JbCrowN]sG7n/8!Od(ij}cvz9');
define('NONCE_SALT',       'Kg2*~EF`/9N]G:&;#o*DcULd/+*Q.^Y^*aDFw,+ED/}g#9(/rIVv^nD4n-&77C`d');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
