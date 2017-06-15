<?php
include_once "bootstrap.php";
use Project\files\ContentGetter;
use Project\files\CinemaParser;

$url = 'http://gorod.dp.ua/afisha/tema/type/1';
$file = __DIR__ . DIRECTORY_SEPARATOR . 'result.txt';
//$contentGetter = new ContentGetter($url, $file);
$parser = new CinemaParser(
    (new ContentGetter($url, $file))->getContent()
);
$schedule = $parser->getSchedule();
print_r($schedule);