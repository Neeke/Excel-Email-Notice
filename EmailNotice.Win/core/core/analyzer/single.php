<?php
/**
 * �����̴���
 *
 * @author ciogao@gmail.com
 * Date: 14-3-10 ����9:48
 */
namespace core\analyzer;

use constant\config as config;
use core\notices;

class single extends analyzerBase
{
    static public function run()
    {
        $analyz = notices::getNotices();

        if (!is_array($analyz) || count($analyz) < 1) return '';

        foreach ($analyz as $rName => $config) {
            self::analyzerRun($rName, $config);
        }
    }
}