<?php
/**
 * @author ciogao@gmail.com
 * Date: 14-5-25 ����7:53
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

        echo "��ѡ��ʹ�������ĸ��ļ���";
        $fnameNo = self::getRead();
        $fname   = notices::choiceFile($fnameNo);

        echo "��ѡ��: $fname \n";

        echo "��Excel�����±��: \n";

        notices::getSummary();
        echo "\n\n��ѡ����������ĸ����:";
        $sheetNo   = self::getRead();
        $sheetName = notices::choiceSheet($sheetNo);
        echo "��ѡ��: $sheetName \n";

        notices::getSheetHeader();

        echo "�밴�����ϱ�ͷ,ѡ�������кţ�\n";

        echo "��ѡ�������У�\n";
        $iNameCol = self::getRead();
        notices::setNameCol($iNameCol);

        echo "��ѡ��Email�У�\n";
        $iEmailCol = self::getRead();
        notices::setEmailCol($iEmailCol);

        echo "\n\n";
        echo "��ȷ���������ã�y(��) n(��) \n";
        $confirm = self::getRead();
        if ($confirm == 'y') {
            echo "����ȷ�ϣ�������ʼ�������Ժ򡭡� \n";

            notices::processNotices();

        } else {
            echo "���˳���\n";
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
