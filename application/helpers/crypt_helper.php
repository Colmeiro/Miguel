<?php

function encrypt($string, $key='')
{
    if(empty($key)) {
        $ci=& get_instance();
        $key = $ci->config->item('crypt_key');
    }

    $result = '';
    for ($i = 0; $i < strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key)) - 1, 1);
        $char = chr(ord($char) + ord($keychar));
        $result .= $char;
    }

    return base64_encode($result);
}

function decrypt($string, $key='')
{
    if(empty($key)) {
        $ci=& get_instance();
        $key = $ci->config->item('crypt_key');
    }

    $result = '';
    $string = base64_decode($string);

    for ($i = 0; $i < strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key)) - 1, 1);
        $char = chr(ord($char) - ord($keychar));
        $result .= $char;
    }

    return $result;
}

function getIdFromToken($token)
{
    $token = urldecode($token);
    $tokenArr = explode('-', decrypt($token));
    if(count($tokenArr) != 2) {
        return FALSE;
    }
    $id = $tokenArr[1];
    $id = id_clean($id);
    return $id;
}
