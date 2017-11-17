<?php

function get_real_filename($headers, $url)
{
    $filename = '';
    $content = get_headers($url, 1);
    $content = array_change_key_case($content, CASE_LOWER);

    if ($content['content-disposition']) {
        $tmp_name = explode('=', $content['content-disposition']);
        if ($tmp_name[1]) $filename = trim($tmp_name[1], '";\'');
    } else {
        $stripped_url = preg_replace('/\\?.*/', '', $url);
        $filename = basename($stripped_url);
    } 

    return $filename;
}