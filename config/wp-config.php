<?php

// Accept both WORDPRESS_DB_* and MYSQL_* env vars to avoid prod misconfiguration.
$db_name = getenv('WORDPRESS_DB_NAME') ?: getenv('MYSQL_DATABASE') ?: 'wordpress';
$db_user = getenv('WORDPRESS_DB_USER') ?: getenv('MYSQL_USER') ?: 'wpuser';
$db_password = getenv('WORDPRESS_DB_PASSWORD') ?: getenv('MYSQL_PASSWORD') ?: '';
$db_host = getenv('WORDPRESS_DB_HOST') ?: 'wordpress-db:3306';

define('DB_NAME', $db_name);
define('DB_USER', $db_user);
define('DB_PASSWORD', $db_password);
define('DB_HOST', $db_host);

define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

$table_prefix = 'wor4898_'; // ⚠️ TON PREFIX IMPORTANT

define('WP_DEBUG', false);

/** URL dynamique (important avec Traefik) */
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
}

// Use HTTP in local Docker dev, HTTPS when behind Traefik/reverse proxy.
$is_https = (
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ||
    (isset($_SERVER['SERVER_PORT']) && (int) $_SERVER['SERVER_PORT'] === 443)
);

$scheme = $is_https ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost:8080';

define('WP_HOME', $scheme . '://' . $host);
define('WP_SITEURL', $scheme . '://' . $host);

/** Sécurité cookies */
define('FORCE_SSL_ADMIN', $is_https);

require_once ABSPATH . 'wp-settings.php';
