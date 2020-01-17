<?php
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7); // "w" accessing week property of datetime object
    $diff->d -= $diff->w * 7; // "d" accessing day property of datetime object

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function norsk_dato($datetime) {
    $month = $datetime->format('m');
    $day = $datetime->format('d');
    $year = $datetime->format('Y');

    $string = array(
        '01' => 'Januar',
        '02' => 'Februar',
        '03' => 'Mars',
        '04' => 'April',
        '05' => 'Mai',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'August',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    );

    foreach ($string as $key => $value) {
        if ($key == $month) {
            $day_no_zero = str_replace("0", "", $day);
            $return_string = $day_no_zero . " " . $value . ", " . $year;
            return $return_string;
        }
    }
}
?>