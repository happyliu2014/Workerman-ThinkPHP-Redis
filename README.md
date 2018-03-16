# Workerman-ThinkPHP-Redis
Workerman+ThinkPHP+Redis

## 程序说明
此程序由workerman-chat改写；
workerman版本：3.0.7
ThinkPHP版本：3.2.3

## 服务器环境
* 1.能够运行workerman框架
* 2.支持php-cli模式下的redis扩展

## 安装说明

上传到linux服务器WEB目录，可以通过URL地址访问前端测试
http://xxxx/test.php
也可以直接使用workerman官方的聊天WEB

## 运行后端框架:

```shell
  cd /wmchat/
  php start.php start
```

## 使用方法
* 1.在Event.php中或其他业务中使用ThinkPHP
R('Home/Index/index'); //传递参数请查看TP手册R方法

* 2.在Event.php或其他业务中使用Redis
RedisDb::instance('redis')->get('key');
