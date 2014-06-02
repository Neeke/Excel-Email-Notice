<?php
/**
 * @author ciogao@gmail.com
 * Date: 14-5-25 下午7:53
 */
namespace core;

class confirm
{

    static public function confirm()
    {
        notices::getFilesList();
        notices::printFileList();

        echo "\n";
        echo "\n";

        echo "请选择使用以上哪个文件：";
        $fnameNo = self::getRead();
        $fname   = notices::choiceFile($fnameNo);

        echo "已选择: $fname \n";

        echo "该Excel有如下表格: \n";

        notices::getSummary();
        echo "\n\n请选择采用以上哪个表格:";
        $sheetNo   = self::getRead();
        $sheetName = notices::choiceSheet($sheetNo);
        echo "已选择: $sheetName \n";

        notices::getSheetHeader();

        echo "请按照以上表头,选择以下列号：\n";

        echo "请选择姓名列：\n";
        $iNameCol = self::getRead();
        notices::setNameCol($iNameCol);

        echo "请选择Email列：\n";
        $iEmailCol = self::getRead();
        notices::setEmailCol($iEmailCol);

        echo "\n\n";
        echo "请确认以上设置：y(是) n(否) \n";
        $confirm = self::getRead();
        if ($confirm == 'y') {
            echo "您已确认，即将开始处理，请稍候…… \n";

            notices::processNotices();

        } else {
            echo "已退出。\n";
            die;
        }
    }

    static public function getRead()
    {
        $fp = fopen("php://stdin", "r");
        $s  = fgets($fp, 255);
        fclose($fp);
        return rtrim($s);
    }
}
