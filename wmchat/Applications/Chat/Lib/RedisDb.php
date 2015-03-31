<?php
namespace Lib;
/**
 * 缓存Redis
 * @author HappyLiu<543509783@qq.com>
 */
class RedisDb
{
    /**
     * 实例数组
     * @var array
     */
    protected static $instance = array();

    
    /**
     * 获取实例
     * @param string $config_name
     * @throws \Exception
     */
    public static function instance($config_name)
    {
        if(!isset(\Config\Db::$$config_name))
        {
            echo "\\Config\\Db::$config_name not set\n";
            throw new \Exception("\\Config\\Db::$config_name not set\n");
        }
        
        if(empty(self::$instance[$config_name]))
        {
            $config = \Config\Db::$$config_name;
            self::$instance[$config_name] = new \Redis();
			self::$instance[$config_name]->pconnect($config['host'], $config['port']);
        }
        return self::$instance[$config_name];
    }
    
    /**
     * 关闭数据库实例
     * @param string $config_name
     */
    public static function close($config_name)
    {
        if(isset(self::$instance[$config_name]))
        {
            self::$instance[$config_name]->close();
            self::$instance[$config_name] = null;
        }
    }
    
    /**
     * 关闭所有数据库实例
     */
    public static function closeAll()
    {
        foreach(self::$instance as $connection)
        {
            $connection->close();
        }
        self::$instance = array();
    }
}
