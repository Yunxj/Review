# 第五天 PHP操作MySQL

## 每日目标 

- 能够使用php连接MySQL数据库
- 能够使用php对MySQL进行查询操作
- 能够使用php检测非查询操作的受影响行数
- 能够断开与数据库的连接
- 综合案例：**能够完成用户管理案例**

  ​


## PHP 操作数据库

如何在 PHP 代码中操作数据库是我们能否在自己的程序中使用数据库的核心。

> 数据库扩展：http://php.net/manual/zh/refs.database.php

如果需要使用 MySQLi 扩展，需要在 php.ini 文件中打开这个扩展（解除注释）

```php
// 假定数据库用户名：root，密码：123456，数据库：baixiu
$connection = mysqli_connect("localhost", "root", "123456", "baixiu");

if (!$connection) {
  // 如果连接失败报错
  die('<h1>Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error() . '</h1>');
}

$sql = "select * from users";
$result = mysqli_query($connection, $sql);

// 查询数据填充到关联数组
while ($row = mysqli_fetch_assoc($result)) {
  echo $row["id"] . " - " . $row["username"];
}

// 释放结果集
mysqli_free_result($result);

mysqli_close($connection);
```

### 执行查询语句

### 执行非查询语句

> - mysqli：
>   - http://php.net/manual/zh/book.mysqli.php
>   - http://www.runoob.com/php/php-ref-mysqli.html



## 用户管理案例

基于数据库的增删改查

### 用户查询与删除功能

![user](media/user.png)

### 用户新增与修改功能

![user-add](media/user-add.png)

## php函数补充

### 字符串处理函数

- 字符串截取
  - string substr ( string $string , int $start [, int $length ] )
  - string mb_substr ( string $str , int $start [, int $length = NULL [, string $encoding = mb_internal_encoding() ]] )
- 字符串长度
  - int strlen ( string $string )
  - mixed mb_strlen ( string $str [, string $encoding = mb_internal_encoding() ] )
- 大小写转换
  - string strtolower ( string $string )
  - string strtoupper ( string $string )
- 去除首尾空白字符
  - string trim ( string $str [, string $character_mask = " \t\n\r\0\x0B" ] )
- 查找字符串中某些字符首次出现位置
  - mixed strpos ( string $haystack , mixed $needle [, int $offset = 0 ] )
  - int mb_strpos ( string $haystack , string $needle [, int $offset = 0 [, string $encoding = mb_internal_encoding() ]] )
- 字符串替换
  - mixed str_replace ( mixed $search , mixed $replace , mixed  \$subject [, int &  $count ] )
- 重复字符串
  - string str_repeat ( string $input , int $multiplier )
- 字符串分割
  - array explode( string $char, string $input )

### 数组处理

- 获取关联数组中全部的键 / 值
  - array_keys() / array_values()
- 判断关联数组中是否存在某个键
  - array_key_exists()
- 将一个或多个元素追加到数组中
  - array_push()
  - $arr[] = 'new value'
- 删除数组中最后一个元素
  - array_pop()
- 数组长度
  - count()
- 检测存在
  - in_array()
- 获取元素在数组中的下标
  - array_search()

