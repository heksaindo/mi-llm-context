<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755); // Sesuai file lama Anda

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb');
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b');
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0);
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1);
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3);
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4);
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5);
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6);
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7);
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8);
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9);
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125);

/*
|--------------------------------------------------------------------------
| Konstanta Kustom Aplikasi
|--------------------------------------------------------------------------
*/

// Environment Detection
if (isset($_SERVER['SERVER_NAME'])) {
    if(strpos($_SERVER['SERVER_NAME'], 'local.') !== FALSE || strpos($_SERVER['SERVER_NAME'], '.local') !== FALSE || $_SERVER['SERVER_NAME'] == 'localhost') {
        defined('ENV') OR define('ENV', 'local');
    } elseif(strpos($_SERVER['SERVER_NAME'], 'dev.') === 0) {
        defined('ENV') OR define('ENV', 'dev');
    } elseif(strpos($_SERVER['SERVER_NAME'], 'qa.') === 0) {
        defined('ENV') OR define('ENV', 'qa');
    } else {
        defined('ENV') OR define('ENV', 'live');
    }
} else {
    defined('ENV') OR define('ENV', 'development'); // Default untuk CLI
}

// Base URL dan Path Kustom
// Dianjurkan mengatur base_url di application/config/config.php untuk CI3
$_detected_base_url = 'http://localhost/';
$_detected_base_uri = '/';

if(isset($_SERVER['HTTP_HOST'])) {
    $_detected_base_url = (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on' ? 'https' : 'http');
    $_detected_base_url .= '://'. $_SERVER['HTTP_HOST'];
    $_detected_base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

    $_detected_base_uri = parse_url($_detected_base_url, PHP_URL_PATH);
    if(substr($_detected_base_uri, 0, 1) != '/') $_detected_base_uri = '/'.$_detected_base_uri;
    if(substr($_detected_base_uri, -1, 1) != '/') $_detected_base_uri .= '/';
}

defined('BASE_URL') OR define('BASE_URL', $_detected_base_url);
defined('BASE_URI') OR define('BASE_URI', $_detected_base_uri);

// APPPATH didefinisikan oleh CI di index.php. FCPATH adalah root folder CI3.
if (defined('APPPATH') && defined('FCPATH')) {
    defined('APP_URI') OR define('APP_URI', BASE_URI . basename(APPPATH) . '/');
    defined('APP_PATH') OR define('APP_PATH', FCPATH); // Menggunakan FCPATH sebagai pengganti ROOTPATH
}

defined('APP_URL') OR define('APP_URL', BASE_URL); // Sesuai file lama Anda

unset($_detected_base_url, $_detected_base_uri);

// Konstanta Aplikasi Spesifik
defined('APP_NAME') OR define('APP_NAME', "Sistem Informasi Layanan Administrasi Kepegawaian");
defined('HEADER_CV') OR define('HEADER_CV', "KEMENTERIAN KESEHATAN REPUBLIK INDONESIA");

// Define Ajax Request
defined('IS_AJAX') OR define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

/* End of file constants.php */
/* Location: ./application/config/constants.php */