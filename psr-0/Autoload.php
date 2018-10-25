<?php
namespace PSR0;
/**
 * Created by PhpStorm.
 * User: 随风
 * Date: 2018/10/25
 * Time: 下午4:29
 */

function autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';

    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    $fileName = __DIR__."/../".$fileName;   // 注意，app应用的根路径

    require $fileName;
}
spl_autoload_register('\PSR0\autoload');
