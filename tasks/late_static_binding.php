<?php

class First
{
    public static function printMessage()
    {
        echo __CLASS__."\n";
    }
    public static function needMessage()
    {
        static::printMessage();
    }
}

class Second extends First
{
    public static function printMessage()
    {
        echo __CLASS__."\n";
    }
}

First::needMessage();

Second::needMessage();