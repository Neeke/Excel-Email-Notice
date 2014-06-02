<?php
/**
 * @author ciogao@gmail.com
 * Date: 14-3-31 下午5:39
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

        $subject = notices::getNoticeName($config) . ' 您好，您的工资明细，请查收';

        $content = mailTpl::processMail(notices::getNoticeHeader(), $config);

        echo notices::getNoticeName($config) . " --- ";
        alarmer::instanse()->SendEmail($subject, $content, notices::getNoticeEmail($config));
        echo "发送完成 \n";
    }
}