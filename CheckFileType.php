<?php
/**
 * Created by PhpStorm.
 * User: 随风
 * Date: 2018/10/23
 * Time: 下午2:52
 */

/**
 * 读取文件前几个字节 判断文件类型
 * @param $filename
 * @return string
 */
function checkFileType($filename){
    $fileType='notFound';
    if(!preg_match('/^http(s)?:\/\//i', $filename) && !file_exists($filename)){
        return $fileType;
    }
    $file=fopen($filename, "rb");

    // TODO check file exist OR file open true or false

    $bin=fread($file, 2);   //只读2字节
    fclose($file);
    $strInfo =@unpack("c2chars", $bin);   // 将二进制数转为十进制数字字符串
    $typeCode=intval($strInfo['chars1'].$strInfo['chars2']);

    switch($typeCode){
        case 7790:
            $fileType='exe';
            break;
        case 7784:
            $fileType='midi';
            break;
        case 8297:
            $fileType='rar';
            break;
        case 255216:
            $fileType='jpg';
            break;
        case 7173:
            $fileType='gif';
            break;
        case 6677:
            $fileType='bmp';
            break;
        case 13780:
            $fileType='png';
            break;
        default:
            $fileType='unknown'.$typeCode;
            break;
    }
    //Fix
    if($strInfo['chars1']=='-1' && $strInfo['chars2']=='-40'){
        return 'jpg';
    }
    if($strInfo['chars1']=='-119' && $strInfo['chars2']=='80'){
        return 'png';
    }
    return $fileType;
}