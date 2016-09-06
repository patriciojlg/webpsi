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
define('AUTH_KEY', '6a()r b2qR|xOq|v5L4]H=S CXS:u? mvz3u$,6Vh&nE0Wr>Mwh5o!$Sa#b{[~u|');
define('SECURE_AUTH_KEY', 'pjc@G8j`j.2mzPLm7r-)/el{IZo@.uO.}mm8tco-f!;:e]%<(-qxTHY55gMkNyV7');
define('LOGGED_IN_KEY', 'g30yv=hG-WB..q.MC}aCB4&{b[`)|Y}bA9%x#/].F<v}o;az{Ti1hpN?Qj-Ejq)5');
define('NONCE_KEY', '/^JK%iL_xii<S?)d?Le!C?b}|}no9c66~pcbmW^q,ynw!NcK,F.UiW]DB(pH:y)Y');
define('AUTH_SALT', ' )/#x75%zf&@/bkHCQape]X3?f_Q_E][i/_1GS-*g.M*!Lc_Tc!~k7Ol`IT]5oqV');
define('SECURE_AUTH_SALT', '%@f>9|UI>3mD3G`H.z!`zRB[AJQ7=BU]HTmubn==:fzu8T0eHp!=6Slos//wrAGq');
define('LOGGED_IN_SALT', 's-/mH,^ixvQ;oe^:xD~-t8FH`/zVT8~9zC5Z/t2KX`1j^>DJ:8FWOWsy+u.|Y8$b');
define('NONCE_SALT', 'hi5Sl=a7v!$O^L-P_bU5JwL.<WG?dvoC)XJ^(Ty<a6M|%You`yMPqCW{dajj$k(B');

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


