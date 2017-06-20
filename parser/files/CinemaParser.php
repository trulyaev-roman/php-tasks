<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 09.06.17
 * Time: 11:33
 */

namespace Project\files;


class CinemaParser
{
    protected $content; // содержимое файла result.txt
    protected $schedule = []; // содержит график показа по отдельным фильмам

    public function __construct($content)
    {
        $this->content = $content;
    }

    protected function makeScheduleByFilms()
    {
        $startPos = strpos($this->content, 'block_afisha');
        $endPos = strpos($this->content, 'block_skyblue');
        $needPart = substr($this->content, $startPos, $endPos - $startPos);
        $blocks = preg_split('/block\_afisha/', $needPart, NULL, PREG_SPLIT_NO_EMPTY);
        $pattern_title = "/class=k>(.*?)\s*<\/a>/u";
        $pattern_date = "/>\s*([\w\,\s\d]+)\s*<br>/u";
        $schedule = [];
        foreach ($blocks as $elements) {
            preg_match_all($pattern_title, $elements, $titles);
            preg_match_all($pattern_date, $elements, $dates);
            $film_name = array_shift($titles[1]);
            $schedule[$film_name] = array_combine($titles[1], $dates[1]);
        }
        return $schedule;
    }

    public function getSchedule()
    {
        array_walk(
            $this->makeScheduleByFilms(),
            [$this, 'addToSchedule']
        );
        return $this->schedule;
    }

    protected function addToSchedule($timetable, $film)
    {
        foreach ($timetable as $cinema => $date) {
            if (!array_key_exists($cinema, $this->schedule)) {
                $this->schedule[$cinema] = [];
            }
            if (!array_key_exists($date, $this->schedule[$cinema])) {
                $this->schedule[$cinema][$date] = [];
            }
            if (!in_array($film, $this->schedule[$cinema][$date])) {
                $this->schedule[$cinema][$date][] = $film;
            }
        }
    }
}