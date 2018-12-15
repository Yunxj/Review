# 第四天 Cookie、Session 与 MySQL

## 每日目标
- 能够完成登录案例
- 能够在服务端设置一个Cookie
- 能够在服务端设置一个Session
- 能够说出Cookie与Session的关系与区别
- 能够使用SQL语句对表进行增删改查操作
- 能够使用数据库可视化工具对表进行增删改查操作

## HTTP 会话

### Cookie

HTTP 很重要的一个特点就是**无状态**（每一次见面都是“初次见面”），如果单纯的希望通过我们的服务端程序去记住每一个访问者是不可能的，所以必须借助一些手段或者说技巧让服务端记住客户端，这种手段就是 **Cookie**。

![cookie](media/cookie.png)

Cookie 就像是在超级市场买东西拿到的小票，由超市（Server）发给消费者（Browser），超市方面不用记住每一个消费者的脸，但是他们认识消费者手里的小票（Cookie），可以通过小票知道消费者之前的一些消费信息（在服务端产生的数据）。

#### PHP 中操作 Cookie

> http://php.net/manual/zh/function.setcookie.php

```php
// 设置 cookie
setcookie("TestCookie", "hello", time() + 1 * 60 * 60);  /* 1 小时过期  */
// 获取 cookie
echo $_COOKIE["TestCookie"];
```

##### 记住登录名案例

###### 登录功能实现流程

```sequence
客户端->服务端: Request GET /login.php
服务端->客户端: Response 空白表单页面
Note left of 客户端: 用户填写表单
客户端->服务端: Request POST /login.php 表单数据
Note right of 服务端: 服务端对提交过来的数据进行校验
服务端->客户端: Response Location: /main.php\n跳转到 main.php
客户端-->服务端: Request GET /main.php
服务端-->客户端: Response Welcome
Note over 客户端,服务端: ..........
客户端->服务端: Request GET /login.php
服务端->客户端: Response 空白表单页面
```



#### JavaScript 中操作 Cookie

##### Pure JavaScript

> 参考：http://www.runoob.com/js/js-cookies.html

```javascript
// 新增一条 cookie，注意：cookie 是有大小限制，约为 4k
//   格式固定：<key>=<value>[; expires=<GMT格式时间>][; path=<作用路径>][; domain=<作用域名>]
//   除了键值以外其余属性均有默认值，可以省略
//   expires 表示 cookie 失效的时间，默认为关闭浏览器时
//   path 表示 cookie 生效的路径，默认为当路径
//       /   /foo.php   /abc/foo.php
//       /foo     /bar/abc.php
//   domain 表示 cookie 生效的域名，默认为当前域名

document.cookie = 'name=value; expires=Tue, 10 Oct 2017 16:14:47 GMT; path=/; domain=zce.me'
// 获取全部 cookie
console.log(document.cookie)
// => 'key1=value1; key2=value2'
// 得到的结果是字符串，需要自己通过字符串操作解析
```

##### jQuery plugin

https://github.com/carhartl/jquery-cookie

##### without jQuery

https://github.com/js-cookie/js-cookie

### Session

由于 Cookie 是服务端下发给客户端**由客户端本地保存**的。换而言之客户端可以在本地对其随意操作，包括删除和修改。如果客户端随意伪造一个 Cookie 的话，对于服务端是无法辨别的，就会造成服务端被蒙蔽，构成安全隐患。

于是乎就有了另外一种基于 Cookie 基础之上的手段：**Session**：

![session-structure](media/session-structure.png)

Session 区别于 Cookie 一个很大的地方就是：Session 数据存在了服务端，而 Cookie 存在了客户端本地，存在服务端最大的优势就是，不是用户想怎么改就怎么改了。

Session 这种机制会更加适合于存放一些属于用户而又不能让用户修改的数据，因为客户端不再保存具体的数据，只是保存一把“钥匙”，伪造一把可以用的钥匙，可能性是极低的，所以不需要在意。

![session-flow](media/session-flow.png)

> http://php.net/manual/zh/session.examples.basic.php


## MySQL

### 准备工作

#### 简介

> 目标：
>
> - 搞明白什么是数据库
> - 如何通过工具操作数据库
> - 如何通过代码操作数据库

数据库就是数据的仓库，用来按照特定的结构去组织和管理我们的数据，有了数据库我们就可以更加方便、便捷的操作（C / R / U / D）我们需要保存的数据。

不管是什么数据库，最终都是将数据存到文件（硬盘）中，只是存储的格式不同于文本文件。

一个 Excel 文件就可以看做一个数据库：

![excel-files](media/excel-files.png)

一个 Excel 文件中可以包含多个数据表：

![excel-tables](media/excel-tables.png)

### 基础操作

#### 数据库管理工具

数据库管理工具本质上就是一个使用数据库服务器软件（Server）提供的服务的数据库客户端（Client）。

##### 命令行工具

一般如果只是简单操作数据库，推荐使用 MySQL 内置的命令行工具完成：

进入 MySQL 客户端的 REPL 环境过后，可以通过标准的 SQL 语句操作数据库。

常见的操作指令：

```sql
mysql> show databases;  -- 显示全部数据库
mysql> create database <db-name>;  -- 创建一个指定名称的数据库
mysql> use <db-name>;  -- 使用一个数据库，相当于进入指定的数据库
mysql> show tables;  -- 显示当前数据库中有哪些表
mysql> create table <table-name> (id int, name varchar(20), age int);  -- 创建一个指定名称的数据表，并添加 3 个列
mysql> desc <table-name>;  -- 查看指定表结构
mysql> source ./path/to/sql-file.sql  -- 执行本地 SQL 文件中的 SQL 语句
mysql> drop table <table-name>;  -- 删除一个指定名称的数据表
mysql> drop database <db-name>;  -- 删除一个指定名称的数据库
mysql> exit|quit;  -- 退出数据库终端
```

##### 可视化工具

如果需要复杂的操作，推荐 Navicat Premium

> 下载地址：http://www.navicat.com.cn/download/navicat-premium
>
> 这是一个付费软件，可以免费试用 14 天

#### 基本概念

- 数据库
- 表
- 字段 —— 指的就是列
- 字段类型 —— 指的就是列能够存储的数据种类
  - int
  - char(<length>)
  - varchar(<length>)
  - date
  - decimal
- 数据库查询：指的是操作数据库的过程（查、增、删、改）
- 数据库查询语言：SQL

#### 基本查询语句

##### 查询

```sql
-- 查询数据
-- select 字段[, 字段2] from 表名
select id, name, birthday from users;

-- 通配 * 找到表中所有列
select * from users;
```

##### 增加

```sql
-- 新增数据
-- 插入全部字段
insert into users values (null, '王五', 0, '2020-12-12', '12312');
-- 指定字段
insert into users (name, gender, avatar) values ('王五', 0, '12312');
```

##### 修改

```sql
-- 更新数据
update users set name = '麻子', gender = 0
```

##### 删除

```sql
-- 删除
-- 删除语句必须指定条件
delete from users 
```

##### 筛选条件

子语句

```sql
delete from users where id = 6
delete from users where id = 6 and gender = 0
delete from users where id = 6 or gender = 0
delete from users where id > 6
delete from users where id in (4, 5)
```

#### 常见查询函数

- 总条数 —— count 分页功能，查询总页数
- 最大值、最小值 —— max/min
- 平均值 —— avg

```sql
select fn(field1) from table
```