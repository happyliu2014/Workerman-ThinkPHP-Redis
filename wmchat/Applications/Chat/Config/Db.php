<?php
namespace Config;
/**
 * mysql配置
 * @author walkor
 */
class Db
{
    /**
     * 数据库的一个实例配置，则使用时像下面这样使用
     * $user_array = Db::instance('user')->select('name,age')->from('users')->where('age>12')->query();
     * 等价于
     * $user_array = Db::instance('user')->query('SELECT `name`,`age` FROM `users` WHERE `age`>12');
     * @var array
     */
    public static $pdo= array(
        'host'    => '127.0.0.1',
        'port'    => 3306,
        'user'    => 'your_user_name',
        'password' => 'your_password',
        'dbname'  => 'user',
        'charset'    => 'utf8',
    );
	
	// Redis连接配置
	public static $redis = array(			
        'host'    => '127.0.0.1',
        'port'    => 6379,	
	);


}