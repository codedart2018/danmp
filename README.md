# 使用 Docker 快速搭建 lanmp 环境

运行环境集成了apache + nginx + mysql + php

## 目录结构

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
docker-compose.yml  容器的编排工具
.evn   变量文件

```

### 第一步，获取项目代码

```
git clone https://gitee.com/myxingke/danmp.git
```

### 第二步，启动运行

```
cd danmp
docker-compose up -d   //创建容器
```

### 第四步，启动运行

测试nginx：
- http://localhost
- https://localhost

测试apache：
- http://localhost :8080
- https://localhost:4343

如果访问出现以下内容，说明环境搭建成功成功后将会出现如下内容
```markdown
欢迎使用DANMP！
XXXXX
```

#关于PHP CURL
配置php72 or php56 里的extra_host 关于IP 在.evn的配置里
```
    extra_hosts:
      - "www.wu.cn:192.168.176.3"
      - "www.spread.cn:192.168.176.3"
      - "shop.du.cn:192.168.176.3"
      - "www.lease.cn:192.168.176.3"
```
每次修改后执行
```
    docker-compose restart
```
重启过后 www.site.com ---> curl www.site1.cn


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
暂未安装 请用compose容器服务
//使用php72服务的php命令行工具
docker-compose exec php72 php -v  
```
#portainer
portainer docker的gui管理工具  （localhost:9000）