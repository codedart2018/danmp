# 使用 Docker 快速搭建 danmp 环境

## 本项目不会更新在这里，更新放在gitee上的
https://gitee.com/myxingke/danmp
[点我啊](https://gitee.com/myxingke/danmp "链接地址")

运行环境集成了apache + nginx + mysql + redis + php(5.6/7.2) + composer + portainer：
1. `100%`开源
2. `100%`遵循Docker标准
3. 支持**多版本PHP**共存，可任意切换（PHP5.6、PHP7.2)
4. 支持绑定**任意多个域名**
5. 支持**HTTPS和HTTP/2**
6. 默认安装`pdo_mysql`、`redis`、`xdebug`、`swoole`等常用热门扩展，拿来即用
7. 实际项目中应用，确保`100%`可用
8. 一次配置，**Windows、Linux、MacOs**皆可用

### 目录结构

```markdown
conf   配置文件的目录，包括
conf/apache/extra/httpd-vhosts.conf 配置虚拟主机的文件
conf/apache/extra/httpd-ssl.conf 配置https的主机的文件
conf/nginx/conf.d/demo.conf 配置nginx的主机的文件， 也可以新加文件，但是后缀以.conf结尾

data 数据目录 
    --- mysql mysql数据目录 
    --- portainer portainer数据目录

log 日志目录
    --- apache apache日志目录
    --- nginx  nginx日志目录
    --- php-fpm php-fpm日志目录

www    网站的根目录
docker-compose.yml  容器的编译文件
.evn   变量文件

```

### php7.2.11 dockerfile 编译文件
[链接地址](https://gitee.com/myxingke/php7.2.11-dockerfile "链接地址")

### php5.6.38 dockerfile 编译文件
[链接地址](https://gitee.com/myxingke/php5.6.38-dockerfile "链接地址")

### 关于windows

### 第一步，获取项目代码
```
git clone https://gitee.com/myxingke/danmp.git
```

### 第二步 修改php运行挂载目录
由于是我自己在使用我默认挂载的是我本机地址，你需要修改一下或者换成你本地的www目录

### 第三步，启动运行
```
cd danmp
//创建容器
docker-compose up -d
```

### 第四步，查看结果

测试nginx：
- http://localhost
- https://localhost

测试apache：
- http://localhost :8080
- https://localhost:4343

如果访问出现以下内容，说明环境搭建成功成功后将会出现如下内容
![Demo Image](./images/demo1.png)

### 关于PHP CURL
配置php72 or php56 里的extra_host 关于IP 在.evn的配置里
指定ip为当前运行的apache nginx IP
```
extra_hosts:
  - "www.wu.cn:172.100.0.2"
  - "www.spread.cn:172.100.0.2"
  - "shop.du.cn:172.100.0.2"
  - "www.lease.cn:172.100.0.2"
```
每次修改后执行
```
docker-compose restart
```
重启过后 www.site.com ---> curl www.site1.cn

### PHP 版本切换
vhost配置文件里找到如下内容替换
```
fastcgi_pass   php72:9000; 换成php5.6版本 fastcgi_pass   php56:9000;
fastcgi_pass   fpm56:9000; 换成php72版本  fastcgi_pass   fpm72:9000;
```

### MYSQL
程序连接方式
```
- host：(本项目的MySQL容器网络，默认mysql)
- port：`3306`
- username：`root`
- password：`root`
```

工具连接方式
```
- host：127.0.0.1
- port：`3306`
- username：`root`
- password：`root`
```

### REDIS
程序连接方式
```
- host: redis
- port: 6379
```
工具连接方式
```
- host: 127.0.0.1
- port: 6379
```

### portainer
portainer docker的gui管理工具
```
- localhost: 9000
```

### php 已安装扩展
##### php5.6/7.2基本只有一两个扩展差距，如果觉得有差的你也可以提issues或者在上面提供的地址自己编译
bcmath \
calendar \
Core \
ctype \
curl \
date \
dom \
exif \
fileinfo \
filter \
ftp \
gd \
gettext \
hash \
iconv \
json \
libxml \
mbstring \
memcached \
mongodb \
mysqlnd \
openssl \
pcntl \
pcre \
PDO \
pdo_mysql \
pdo_pgsql \
pdo_sqlite \
Phar \
posix \
readline \
redis \
Reflection \
session \
shmop \
SimpleXML \
soap \
sockets \
sodium \
SPL \
sqlite3 \
standard \
swoole \
sysvmsg \
sysvsem \
sysvshm \
tokenizer \
wddx \
xdebug \
xml \
xmlreader \
xmlrpc \
xmlwriter \
xsl \
Zend OPcache \
zip \
zlib \
[Zend Modules] \
Xdebug \
Zend OPcache

## 容器相关命令管理

1. 查看运行的容器

```
//如果state的状态为up 说明容器启动成功
docker-compose ps
```
2. 启动、重启、停止 服务

```
//启动所有服务
docker-compose  start
//停止所有服务
docker-compose  stop
//重启所有服务
docker-compose restart
```
3. 查看服务的日志

```
//查看所有服务的日志
docker-compose logs
//查看nginx的服务日志
docker-compose logs nginx
//查看apache
docker-compose logs apache
//查看mysql
docker-compose logs mysql
//查看php72
docker-compose logs 72
```

4. 进入到某个服务

```
//进入apache服务的命令
docker-compose exec apache bash
```
5. 使用php的composer和php命令

```
//使用php72服务的composer命令
docker-compose exec php72 composer --version
//使用php72服务的php命令行工具
docker-compose exec php72 php -v  
```
