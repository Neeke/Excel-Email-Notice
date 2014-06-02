<?php
/**
 * @author ciogao@gmail.com
 * Date: 14-5-25 ????7:47
 */
namespace core;

use constant\config as config;

class notices
{
    static private $fileName;
    static private $realFileName;
    static private $fileList;
    static private $directory;

    static private $aSheets;
    static private $realSheet;

    static private $rows; //??
    static private $columns; //??

    static private $iNameCol;
    static private $iEmailCol;

    static private $aSheetHeader;
    static private $aNotices;

    /**
     * @var \PHPExcel_Reader_Excel5
     */
    static private $oExcel;

    /**
     * @var \PHPExcel
     */
    static private $oThisExcel;

	static public function iconv($value)
	{
	    return iconv("UTF-8", "GBK", $value);
	}
	
    static public function getFilesList()
    {
        self::$directory = config::getNoticePath();

        $i     = 0;
        $mydir = dir(self::$directory);
        while ($file = $mydir->read()) {

            if ($file == '.' || $file == '..') continue;

            if (is_dir(self::$directory . "/$file")) {
                self::$fileList[] = $file;
                //self::getFilesList(self::$directory . "/$file");
            } else {
                ++$i;
                self::$fileList[$i] = $file;
            }
        }
        $mydir->close();
    }
	
	static public function printFileList()
	{
		echo "待处理的文件有 \n";
		foreach (notices::$fileList as $k => $v) {
			echo "$k :" . $v . "\n";
		}
	}

    static public function choiceFile($fileNo)
    {
        self::$fileName     = self::$fileList[$fileNo];
        self::$realFileName = self::$directory . '\\' . self::$fileName;
        return self::$fileName;
    }

    static public function getFileName()
    {
        return self::$fileName;
    }

    static public function loadExcel()
    {
        if (!self::$oExcel) {
            include_once(BASE_PATH . '/lib/PHPExcel.php');

            self::$oExcel = new \PHPExcel_Reader_Excel5();
            self::$oExcel->setReadDataOnly(TRUE);
        }
        self::$oThisExcel = self::$oExcel->load(self::$realFileName);
    }

    static public function getSummary()
    {
        self::loadExcel();

        self::$aSheets = self::$oThisExcel->getSheetNames();
        foreach (self::$aSheets as $k => $v) {
            echo $k + 1 . " :" . self::iconv($v) . "\n";
        }
    }

    static public function choiceSheet($sheetNo)
    {
        self::$realSheet = self::$oThisExcel->getSheet($sheetNo - 1);
        self::$rows      = self::$realSheet->getHighestRow();
        self::$columns   = \PHPExcel_Cell::columnIndexFromString(self::$realSheet->getHighestColumn());
        return self::$aSheets[$sheetNo - 1];
    }

    static public function getSheetHeader()
    {
        echo "列号  --  列名  --  示例\n";

        for ($col = 0; $col < self::$columns; ++$col) {
            echo $col;
            echo ' -- ';
            self::$aSheetHeader[$col] = self::$realSheet->getCellByColumnAndRow($col, 1)->getCalculatedValue();
            echo self::iconv(self::$aSheetHeader[$col]);
            echo ' -- ';
            echo self::iconv(self::$realSheet->getCellByColumnAndRow($col, 2)->getCalculatedValue());

            echo "\n";
        }

        echo "\n\n";

    }

    static public function setNameCol($colNo)
    {
        self::$iNameCol = $colNo;
    }

    static public function setEmailCol($colNo)
    {
        self::$iEmailCol = $colNo;
    }

    static public function processNotices()
    {
        for ($row = 2; $row <= self::$rows; ++$row) {
            for ($col = 0; $col < self::$columns; ++$col) {
                $val                        = self::$realSheet->getCellByColumnAndRow($col, $row)->getCalculatedValue();
                self::$aNotices[$row][$col] = $val;
            }
        }
    }

    static public function getNoticeHeader()
    {
        return self::$aSheetHeader;
    }

    static public function getNotices()
    {
        return self::$aNotices;
    }

    static public function getNoticeName(&$notice)
    {
        return $notice[self::$iNameCol];
    }

    static public function getNoticeEmail(&$notice)
    {
        return $notice[self::$iEmailCol];
    }

    static public function setNoticesConfig($aConfig)
    {

    }
}
