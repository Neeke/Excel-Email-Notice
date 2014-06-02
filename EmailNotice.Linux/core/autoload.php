<?php
/**
 * @author ciogao@gmail.com
 * Date: 14-3-8 下午4:30
 */
function EmailNotice_autoloader($class)
{
    if (class_exists($class)) return FALSE;

    if (strstr($class, 'PHPExcel')) {

        $filename = BASE_PATH . '/' . str_replace(array('_', '\\', 'core'), array(DIRECTORY_SEPARATOR, '/', 'lib'), $class) . '.php';

        if (!file_exists($filename)) {
            $filename = BASE_PATH . '/lib/' . str_replace(array('_', '\\', 'core'), array(DIRECTORY_SEPARATOR, '/', 'lib'), $class) . '.php';
        }

    } else {
        $filename = BASE_PATH . '/' . str_replace('\\', '/', $class) . '.php';
    }

    include_once "$filename";
}

spl_autoload_register('EmailNotice_autoloader');
