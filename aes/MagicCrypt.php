<?php
/**
 * Created by PhpStorm.
 * Desc：通过mcrypt进行加密解码
 * User: 随风
 * Date: 2018/11/13
 * Time: 23:49
 */

class MagicCrypt {
    private $iv = "0000000000000000";               //密钥偏移量IV，可自定义

    private $encryptKey = "自定义16位长度key";        //AESkey，可自定义

    public function __construct($iv = '', $encryptKey = '') {
        $iv && $this->setIv($iv);
        $encryptKey && $this->setEncryptKey($encryptKey);
    }


    //加密
    public function encrypt($encryptStr) {
        $localIV = $this->iv;
        $encryptKey = $this->encryptKey;

        //Open module
        $module = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, $localIV);

        mcrypt_generic_init($module, $encryptKey, $localIV);

        //Padding
        $block = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        $pad = $block - (strlen($encryptStr) % $block); //Compute how many characters need to pad
        $encryptStr .= str_repeat(chr($pad), $pad); // After pad, the str length must be equal to block or its integer multiples

        //encrypt
        $encrypted = mcrypt_generic($module, $encryptStr);

        //Close
        mcrypt_generic_deinit($module);
        mcrypt_module_close($module);

        return base64_encode($encrypted);

    }

    //解密
    public function decrypt($encryptStr) {
        $localIV = $this->iv;
        $encryptKey = $this->encryptKey;

        //Open module
        $module = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, $localIV);

        mcrypt_generic_init($module, $encryptKey, $localIV);

        $encryptedData = base64_decode($encryptStr);
        $encryptedData = mdecrypt_generic($module, $encryptedData);

        return $encryptedData;
    }

    public function setIv($iv){
        $this->iv = $iv;
    }

    public function setEncryptKey($encryptKey){
        $this->encryptKey = $encryptKey;
    }
}


## eg.
$iv = 0000000000000000;
$encryptKey = '123456654321';
$encryptString = '这是加密字符串';

$encryptObj = new MagicCrypt($iv, $encryptKey);

$result = $encryptObj->encrypt($encryptString);//加密结果
echo "加密结果：".$result . "<br/>";

$decryptString = $decryptString = $encryptObj->decrypt($result);//解密结果
echo "解密结果：".$decryptString . "<br/>";