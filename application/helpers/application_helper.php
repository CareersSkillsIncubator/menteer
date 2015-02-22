<?php

/**
 * Menteer
 *
 * Original Code is Menteer, Released January 2015
 *
 * The initial developer of the Original Code is CSCI (CareerSkillsIncubator) with
 * the generous support from CIRA.ca (Community Investment Program)
 *
 *
 */

/**
 * @param $str
 * @param int $n_words
 * @return string
 */
function brief($str, $n_words = 10) {
    return word_limiter(strip_tags($str), $n_words);
}

/**
 * @param $str
 * @return string
 */
function clean($str) {
    return htmlspecialchars($str);
}

/**
 * @param $in
 * @param int $width
 * @param int $height
 * @param bool $auto_play
 * @return bool|string
 */
function _embed($in, $width = 350, $height = 350, $auto_play = FALSE){

    $dom = new DOMDocument();
    @$dom->loadHTML($in);

    foreach ($dom->getElementsByTagName('iframe') as $item) {

        $item->setAttribute('width', $width);
        $item->setAttribute('height', $height);
        $src 	= $item->getAttribute('src');
        $q 		= strpos($src, '?') === FALSE ? '?' : '&';
        $auto 	= $auto_play ? 'auto_play=1&autoplay=1' : '';
        $item->setAttribute('src', $src.$q.$auto);

        return $dom->saveHTML();
    }

    return false;
}

/**
 * @param $num
 * @return string
 */
function addOrdinalNumberSuffix($num) {
    if (!in_array(($num % 100),array(11,12,13))){
        switch ($num % 10) {
            // Handle 1st, 2nd, 3rd
            case 1:  return $num.'st';
            case 2:  return $num.'nd';
            case 3:  return $num.'rd';
        }
    }
    return $num.'th';
}

/**
 * @param $date
 * @return bool|string
 */
function to_alt_date($date)
{
    $timestamp = strtotime($date);

    return date("l, F j, Y",$timestamp);
}

// get time ago
function get_timeago( $ptime )
{
    $estimate_time = time() - $ptime;

    if ($estimate_time < 1) {
        return 'less than 1 second ago';
    }

    $condition = array(
        12 * 30 * 24 * 60 * 60 => 'year',
        30 * 24 * 60 * 60 => 'month',
        24 * 60 * 60 => 'day',
        60 * 60 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($condition as $secs => $str) {
        $d = $estimate_time / $secs;

        if ($d >= 1) {
            $r = round($d);
            return $r . '~' . $str;
        }
    }
}

/**
 * @param int $seconds
 * @return string
 */
function days_ago($seconds = 1) {
    if (!is_numeric($seconds)) {
        $seconds = strtotime($seconds);
    }
    $seconds = now() - $seconds;

    if ($seconds < 0) {
        return 'Just now';
    }

    $days = floor($seconds / 86400);
    if ($days > 0) {
        return $days . ' days ago';
    }

    $hours = floor($seconds / 3600);
    if ($hours > 0) {
        if ($hours == 1) {
            return '1 hour ago';
        }
        return $hours . ' hours ago';
    }

    $minutes = floor($seconds / 60);
    if ($minutes > 52) {
        return '1 hour ago';
    } elseif ($minutes > 38) {
        return '45 minutes ago';
    } elseif ($minutes > 2) {
        return $minutes.' minutes ago';
    } else {
        return 'Just now';
    }
}

/**
 * @param $string
 * @return string
 */
function encrypt_url($string) {
    $key = "MAL_979805"; //key to encrypt and decrypts.
    $result = '';
    $test = "";
    for($i=0; $i<strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key))-1, 1);
        $char = chr(ord($char)+ord($keychar));

        $test[$char]= ord($char)+ord($keychar);
        $result.=$char;
    }

    return urlencode(base64_encode($result));
}

/**
 * @param $string
 * @return string
 */
function decrypt_url($string) {
    $key = "MAL_979805"; //key to encrypt and decrypts.
    $result = '';
    $string = base64_decode(urldecode($string));
    for($i=0; $i<strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key))-1, 1);
        $char = chr(ord($char)-ord($keychar));
        $result.=$char;
    }
    return $result;
}

/**
 * @param $array
 */
function printer($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}