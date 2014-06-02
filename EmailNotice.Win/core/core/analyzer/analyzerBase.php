<?php
/**
 * @author ciogao@gmail.com
 * Date: 14-3-31 ????5:39
 */
namespace core\analyzer;

use core\notices;
use lib\alarmer;
use constant\mailTpl as mailTpl;

class analyzerBase
{

    static public function analyzerRun($configKey = NULL, $config = array())
    {
        if (empty($configKey) || !is_array($config) || count($config) < 1) {
            return FALSE;
        }

        $subject = notices::getNoticeName($config);

        $content = mailTpl::processMail(notices::getNoticeHeader(), $config);

        echo notices::iconv(notices::getNoticeName($config)) . " --- ";
        alarmer::instanse()->SendEmail($subject, $content, notices::getNoticeEmail($config));
        echo "·¢ËÍ³É¹¦ \n";
    }
}