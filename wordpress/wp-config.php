<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'wordpress');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'narcisismo');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', ']$go5D: -ut|3U zrJ)4O~IOFhV2/HhcxP@@-}}|12a6.B!`IPP1# A+JJ!4pfUq');
define('SECURE_AUTH_KEY', 'q<%W/nG_ZFxBZ{z]t0hHmCGRsN>.`^(c)wp~F8x{4.vnYl6#E[R;5y!Kax^gp>j3');
define('LOGGED_IN_KEY', 'zW(J&EgWXJl?)/JSwd)5}(v![TVT-1<be2iTjRbes+6E,gkoYwsk&#F-?W7Q7crF');
define('NONCE_KEY', '-D*0keME/(Ysrawc4fCF3,Q_gj`q~1+EU9NL*l[oSfV-w&jYCqV??$#<l:s~/<+m');
define('AUTH_SALT', 'P<^#>zvPC#<9(t$?9u*@GpY~05/Fc*t-BtO+T_i/JMPsmL!LqiS%*C8XPN$frgwH');
define('SECURE_AUTH_SALT', '_Y~E}J@aXtmk})*~pT!8a(Y=.T?:F93?,=rk.a<rc@G~$9=$$ZUG[jx a[7kX1m}');
define('LOGGED_IN_SALT', ']%yuWSxYOUq8gBMs9Lvlgwy.snS:nPg*fY@S3T-B4qkG ypbTs<<%)#W~@v ASO;');
define('NONCE_SALT', '_scBj9MsMWQjwQs^:kAO7~VVz^uK_@y7o=Tkdf&UksSJu%t-WHqabD-B&h>t2O{]');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

