<?php
/**
 * 邮件模板绑定数据
 *
 * @author ciogao@gmail.com
 * Date: 14-5-25
 */
namespace constant;

class mailTpl
{

    static public function processMail($noticeHeader, $notice)
    {
        $str = '<table>';
        foreach ($noticeHeader as $key => $header) {
            $str .= '<tr>';
            $str .= '<td>' . $header . '</td>';
            $str .= '<td>' . $notice[$key] . '</td>';
            $str .= '<tr>';
        }

        $str .= '</table>';

        return $str;
    }
}