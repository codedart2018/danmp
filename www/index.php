<?php

session_start();
$date = date("Y-m-d H:i:s");
echo '<h1 style="text-align: center; padding-top: 20px">欢迎使用DANMP！</h1>';
echo '<h1 style="text-align: center;">本环境集成APACHE NGINX PHP MYSQL REDIS COMPOSE PORTAINER镜像环境！</h1>';
echo '<h2>版本信息</h2>';
echo '<ul>';
echo '<li>当前日期：'. $date .'</li>';
echo '<li>PHP版本：', PHP_VERSION, '</li>';
echo '<li>Nginx版本：', $_SERVER['SERVER_SOFTWARE'], '</li>';
echo '<li>MySQL服务器版本：', getMysqlVersion(), '</li>';
echo '<li>Redis服务器版本：', getRedisVersion(), '</li>';
echo '<li>SESSION_ID：'.session_id().'</li>';
echo '</ul>';

//获取MySQL版本
function getMysqlVersion()
{
    if (extension_loaded('PDO_MYSQL')) {
        try {
            $dbh = new PDO('mysql:host=mysql;dbname=mysql', 'root', '123456');
            $sth = $dbh->query('SELECT VERSION() as version');
            $info = $sth->fetch();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        return $info['version'];
    } else {
        return 'PDO_MYSQL 扩展未安装 ×';
    }

}

//获取Redis版本
function getRedisVersion()
{
    if (extension_loaded('redis')) {
        try {
            $redis = new Redis();
            $redis->connect('redis', 6379);
            $info = $redis->info();
            return $info['redis_version'];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    } else {
        return 'Redis 扩展未安装 ×';
    }
}

//phpinfo信息
phpinfo();