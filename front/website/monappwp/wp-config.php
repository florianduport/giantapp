<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur 
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */
define('WP_TEMP_DIR', ABSPATH . 'wp-content/');
// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'mon_app_dentiste');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'Answer&&pigeon2010');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');

/** Type de collation de la base de données. 
  * N'y touchez que si vous savez ce que vous faites. 
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant 
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '<!Yo+umEUPx[Y%4<WI=$k5P%Hcwd.$`DL5Twi=}1!fI<lWAa~GB[j:x:Xb3:s/7D');
define('SECURE_AUTH_KEY',  '|4Ne.`kRXCc,%LYA0W+.WxK:o<[WJ*U&yr`Wo)v*UoPoy;6m3-r$oeZ#1wIgO<o{');
define('LOGGED_IN_KEY',    ']DyEm/ux;,rs)QP+-PX,B+sDp!zb%T@+~]C&mi-E hZ(3BE8xvV4/}q ;Z5Pah,H');
define('NONCE_KEY',        'dm430tdprC`6QNP+M-Tzvb$}}G#5[VKCM:lG -oJ]/Nc>Br<2IK!4+3My1I{VR2w');
define('AUTH_SALT',        'aNr}!h*-ee-YkP~d&UEer!f]Qo-UYO*%P}Qp!Zz0d?w{{1N-MPAY6;S%^j22e4%V');
define('SECURE_AUTH_SALT', '2/< P]3!1yKE%@$<s|901SeT1h7sslrfq@+.?vQ*I.b (|Q:Rwvdtl,[B~4vQc``');
define('LOGGED_IN_SALT',   '}p7d+)tuzD}KD$t:w)5_r )/]>OQNQI-jo{E;{![n|4&-/qpS_1an IPPOj7uUr[');
define('NONCE_SALT',       'N+cUZU&)3s*?J]cA<6NQjoh3trc<sB6<:7 >,=8Mg|s}n*w+O8^y;;[{$(k#AH4x');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique. 
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wp_';

/**
 * Langue de localisation de WordPress, par défaut en Anglais.
 *
 * Modifiez cette valeur pour localiser WordPress. Un fichier MO correspondant
 * au langage choisi doit être installé dans le dossier wp-content/languages.
 * Par exemple, pour mettre en place une traduction française, mettez le fichier
 * fr_FR.mo dans wp-content/languages, et réglez l'option ci-dessous à "fr_FR".
 */
define('WPLANG', 'fr_FR');

/** 
 * Pour les développeurs : le mode deboguage de WordPress.
 * 
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant votre essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de 
 * développement.
 */ 
define('WP_DEBUG', false); 

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
