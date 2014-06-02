<?php
/**
 * EmailNotice
 *
 * @author ciogao@gmail.com
 * Date: 14-5-25
 */
//setlocale(LC_ALL, "chs");
define('BASE_PATH', realpath(dirname(__FILE__)));
include_once "autoload.php";

use core\analyzer;

analyzer::run();
