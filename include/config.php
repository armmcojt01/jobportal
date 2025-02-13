<?php
defined('server') ? null : define("server", "localhost");
defined('user') ? null : define("user", "root");
defined('pass') ? null : define("pass", "");
defined('database_name') ? null : define("database_name", "db_jobportal");

$this_file = str_replace('\\', '/', __FILE__);
$doc_root = $_SERVER['DOCUMENT_ROOT'];

$web_root = str_replace(array($doc_root, "include/config.php"), '', $this_file);
$server_root = str_replace('include/config.php', '', $this_file);

// defined('web_root') ? null : define('web_root', 'http://' . $_SERVER['HTTP_HOST'] . $web_root);
// defined('server_root') ? null : define('server_root', $server_root);
?>
