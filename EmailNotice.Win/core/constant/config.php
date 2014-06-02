<?php
/**
 * ��������
 * @author ciogao@gmail.com
 * Date: 14-5-25
 */
namespace constant;

class config
{
    static private $config = array();

    /**
     * ȡ��������
     * @throws \Exception
     * @return array
     */
    static public function getConfig()
    {
        if (count(self::$config) > 1) return self::$config;

        $ini    = BASE_PATH . '/../config/config.ini';
        $config = @parse_ini_file($ini, TRUE);

        if (!is_array($config) || count($config) < 1) {
            throw new \Exception($ini . ' is null');
        }

        self::$config = $config;

        return self::$config;
    }

    /**
     * �Ƿ������߳�
     * @return bool|int
     */
    static public function getForkCount()
    {
        if (!array_key_exists('fork', config::$config) || !array_key_exists('fork_open', config::$config['fork'])) {
            return FALSE;
        }

        if (!config::$config['fork']['fork_open'] || intval(config::$config['fork']['fork_count']) < 1) {
            return FALSE;
        }

        return intval(config::$config['fork']['fork_count']);
    }

    /**
     * ȡ��email����
     * @return array
     */
    static public function getNoticeEmail()
    {
        if (!array_key_exists('notice', config::$config) || !array_key_exists('email', config::$config['notice'])) return array();

        $emailConfig             = config::$config['notice']['email'];
        $emailConfig['mail_cc']  = explode(',', $emailConfig['mail_cc']);
        $emailConfig['mail_bcc'] = explode(',', $emailConfig['mail_bcc']);

        return $emailConfig;
    }

    /**
     * @return mixed
     */
    static public function getNoticePath()
    {
        $path = dirname(BASE_PATH) . '/' .(string)config::$config['base']['wait_notice_path'];
        return $path;
    }
}