<?php
/**
 * Configuración básica de WordPress.
 *
 * Este fichero contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, y ABSPATH. Para obtener más información visite la página del Codex
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editando wp-config.php}.
 * Los ajustes de MySQL se los proporcionará su proveedor de alojamiento web.
 * 
 * Este fichero es usado por el script de creación de wp-config.php durante la
 * instalación. Usted no tiene que utilizarlo en su sitio web, simplemente puede guardar este fichero
 * como "wp-config.php" y completar los valores.  
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solcite esta información a su proveedor de alojamiento web. ** //
/** El nombre de la base de datos de WordPress */
define('DB_NAME', 'animedb');

/** Nombre de usuario de la base de datos de MySQL */
define('DB_USER', 'root');

/** Contraseña del usuario de la base de datos de MySQL */
define('DB_PASSWORD', '');

/** Nombre del servidor de MySQL (generalmente es localhost) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para usar en la creación de las tablas de la base de datos. */
define('DB_CHARSET', 'utf8');

/** El tipo de cotejamiento de la base de datos. Si tiene dudas, no lo modifique. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autenticación y salts.
 *
 * ¡Defina cada clave secreta con una frase aleatoria distinta!
 * Usted puede generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress.org}
 * Usted puede cambiar estos valores en cualquier momento para invalidar todas las cookies existentes. Esto obligará a todos los usuarios a iniciar sesión nuevamente. 
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'wgIYXU-?]gg*N@$>RgpH-SG)1!-6Y}1(dxfm@Z;z]p+h6KNGO:EpDv`$bb;|FFqq');
define('SECURE_AUTH_KEY',  '_cmB8h([id-xVd}i0=TpVK_G`7D`PeU${U2Ptv!vaSQ)_C;@i2S474=pgYi%-Dt?');
define('LOGGED_IN_KEY',    '^@,6cV(3z>WVY`+?4 _|-e>ot|KB1IbSOD)D]T0v_t)#4-aWz+9c09,wpmgZ&c,j');
define('NONCE_KEY',        't5@.3+,W(|_Y-hWs&Hti|ELHNT?z6z76Y?]<0K39IT[q@ Wp@tB ~1qcGn>>E{!A');
define('AUTH_SALT',        '#qfx}AqcB+|*Xn.hlQI};-keVF2rTQc_B:Bd/F24BC[ TQ1[qJsj86[.O9zs/B}3');
define('SECURE_AUTH_SALT', ',`Td](Am?sl^ognDP]U9gk< KXEaz 5JA$Jbw1JY$/~FxGdq&Tg%<n+6btzniya;');
define('LOGGED_IN_SALT',   '6TQPAn.^:)3hvw@B<]vu|U{4vn7p*bL-/cmN%;ontrd`F2aed* `CI-nagpY@IbE');
define('NONCE_SALT',       'T}{F#|Tvr|2ne9K@MN7sXKQvHQN0V&w?/CJxb~^D,4OEZ:AvAUi:R*^b(riAhp-5');

/**#@-*/

/**
 * Prefijo de las tablas de la base de datos de WordPress. 
 *
 * Usted puede tener múltiples instalaciones en una sóla base de datos si a cada una le 
 * da un único prefijo. ¡Por favor, emplee sólo números, letras y guiones bajos!
 */
$table_prefix  = 'wp_';

/**
 * Para los desarrolladores: modo de depuración de WordPress.
 *
 * Cambie esto a true para habilitar la visualización de noticias durante el desarrollo.
 * Se recomienda encarecidamente que los desarrolladores de plugins y temas utilicen WP_DEBUG 
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', true);

/* ¡Eso es todo, deje de editar! Disfrute de su sitio. */

/** Ruta absoluta al directorio de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Establece las vars de WordPress y los ficheros incluidos. */
require_once(ABSPATH . 'wp-settings.php');
