<?php 

function input_filter($text, $html = true) {
    $e_s = array('\\', '\'', '"');
    $d_s = array('', '', '');
    $text = preg_replace("'<script[^>]*>.*?</script>'si", '', $text);
    $text = preg_replace('/<a\s+.*?href="([^"]+)"[^>]*>([^<]+)<\/a>/is', '\2 (\1)', $text);
    $text = preg_replace('/<!--.+?-->/', '', $text);
    $text = preg_replace('/{.+?}/', '', $text);
    $text = preg_replace('/&nbsp;/', ' ', $text);
    $text = preg_replace('/&amp;/', '', $text);
    $text = str_replace($e_s, $d_s, $text);
    $text = strip_tags($text);
    $text = preg_replace("/\r\n\r\n\r\n+/", " ", $text);
    $text = $html ? htmlspecialchars($text) : $text;
    return $text;
}

?>