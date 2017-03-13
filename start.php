<?php
/**
 * Created by PhpStorm.
 * User: Arsen Bespalov
 * Date: 13.03.2017
 * Time: 12:52
 */

if (PHP_SAPI != 'cli') die('Скрипт надо запустить из коммандрной строки.');

$msg = [
    'Введите последовательность символов через запятую:',
    'В введенной последовательности (',
    ') прогрессия найдена.',
    ') прогрессия не найдена.',
];

if (PHP_OS == 'WINNT') {
    foreach ($msg as $i => $v)
        $msg[$i] = iconv('UTF-8', 'CP866', $msg[$i]);
    echo $msg[0] , PHP_EOL;
    $line = stream_get_line(STDIN, 1024, PHP_EOL);
} else {
    $line = readline($msg[0] . PHP_EOL);
}

$symbols = explode(',', trim($line));

$progress = true;

if (count($symbols) > 2) {
    $a = [0];
    $dMainAri = $symbols[1] - $symbols[0];
    $dMainGeo = $symbols[1] / $symbols[0];

    for ($i = 1; $i < count($symbols); $i++) {
        $dNext = $symbols[$i] - $symbols[$i - 1];
        if ($dMainAri != $dNext) {
            $dNext = $symbols[$i] / $symbols[$i - 1];
            if ($dMainGeo != $dNext) {
                $progress = false;
                break;
            }
        }
    }
} else $progress = false;


echo $msg[1], $line, $progress ? $msg[2] : $msg[3];