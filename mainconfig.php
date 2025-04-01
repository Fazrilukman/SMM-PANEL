<?php
date_default_timezone_set('Asia/Jakarta');
ini_set('memory_limit', '128M');

/* CONFIG */
$config['web'] = array(
    'maintenance' => 0, // 1 = yes, 0 = no
    'short_title' => 'Zaynflazz ',
    'title' => 'Smm Panel Indonesia Termurah - Terbaik',
    'meta' => array(
        'description' => 'Medanpedia - SMM Panel indonesia adalah sebuah website penyedia layanan sosial media terlengkap, termurah, dan berkualitas.',
        'keywords' => 'smm panel',
        'author' => 'Zaynflazz  - SMM Panel indonesia'
    ),
    'base_url' => 'https://boostsmmindo.com/',
    'register_url' => 'https://boostsmmindo.com/auth/register.php'
);

$config['register'] = array(
    'price' => array(
        'member' => 10000,
        'reseller' => 30000,
    ),
    'bonus' => array(
        'member' => 5000,
        'reseller' => 10000,
    )
);

$config['db'] = array(
    'host' => 'localhost',
    'name' => 'kingspe1_boostsmmindo',
    'username' => 'kingspe1_boostsmmindo',
    'password' => 'kingspe1_boostsmmindo'
);
/* END - CONFIG */

require 'lib/db.php';
require 'lib/model.php';
require 'lib/function.php';

session_start();
$model = new Model();
