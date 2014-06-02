<?php
/**
 * seaslog_analyzer
 *
 * @author ciogao@gmail.com
 * Date: 14-3-8 ����5:10
 */
namespace core;

use constant\config as config;
use core\analyzer as coreRun;
use core\confirm as coreConfirm;

class analyzer
{
    //��ǰ�汾
    const SEASLOG_ANALYZER_VERSION = 0.1;

    static public function run()
    {
        config::getConfig();

        coreConfirm::confirm();

        if ($forkCount = config::getForkCount()) {
            coreRun\pcntl::setForkCount($forkCount);
            coreRun\pcntl::run();
        } else {
            coreRun\single::run();
        }
    }
}