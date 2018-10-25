## 根据文件前两个字节来判断文件类型
[CheckFileType.php ](https://github.com/suifeng412/php-lib/blob/master/file/CheckFileType.php)   
优点：精准  
缺点：每次都要fopen文件流，当文件不存在时会报错，因此需要特别地去校验

## PSR-0实现
[Autoload.php ](https://github.com/suifeng412/php-lib/blob/master/psr-0/Autoload.php)   
PSR-0规范了指定自动加载，目前该规范已经弃用，采用了PSR-4替代。    
PSR-0所要遵守的规范有：
* 一个完全标准的命名空间(namespace)和类(class)的结构是这样的：\<Vendor Name>\(<Namespace>\)*<Class Name>
* 每个命名空间(namespace)都必须有一个顶级的空间名(namespace)("组织名(Vendor Name)")。
* 每个命名空间(namespace)中可以根据需要使用任意数量的子命名空间(sub-namespace)。
* 从文件系统中加载源文件时，空间名(namespace)中的分隔符将被转换为 DIRECTORY_SEPARATOR（操作系统的分隔符）。
* 类名(class name)中的每个下划线_都将被转换为一个DIRECTORY_SEPARATOR。下划线_在空间名(namespace)中没有什么特殊的意义。
* 完全标准的命名空间(namespace)和类(class)从文件系统加载源文件时将会加上.php后缀。
* 组织名(vendor name)，空间名(namespace)，类名(class name)都由大小写字母组合而成。



